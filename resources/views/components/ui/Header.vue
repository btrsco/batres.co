<template>
    <Container
        as="header"
        class="sticky top-4 z-20 flex items-center gap-2 sm:gap-4 px-3 sm:px-6 py-2 rounded-xl border border-white bg-white/85 backdrop-blur-lg">
        <div class="text-black sm:w-full order-2 sm:order-1">
            <Logo class="hidden sm:block" />
            <ShortLogo class="sm:hidden" />
        </div>
        <div class="w-12 h-12 flex-shrink-0 order-1 sm:order-2 rounded-full border-2 border-white bg-black object-cover overflow-hidden">
            <img src="/images/avatar.jpg"
                 alt="Miguel Batres' Photo">
        </div>
        <div class="text-black flex flex-col items-end w-full text-xs font-mono order-3">
            <div class="flex gap-2 italic">
                <strong>{{ weekDay }}</strong>
                <span class="text-black/25">{{ currentTime }}</span>
            </div>
            <a
                :href="nowPlaying.url || '#now-playing'"
                class="flex gap-2 max-w-32"
                :target="nowPlaying.url ? '_blank' : '_self'">
                <MusicNote
                    class="flex-shrink-0"
                    ref="musicNote" />
                <vue3-marquee
                    :duration="8"
                    :delay="1">
                    <strong>{{ nowPlaying.artist }}</strong>
                    <span class="text-black/25 mx-2">&mdash;</span>
                    <span
                        class="text-black/25 transition-all duration-300 ease-in-out"
                        :class="[{ 'blur-[1.5px] mr-1': nowPlaying.is_explicit, 'mr-8': !nowPlaying.is_explicit }]">
                        {{ nowPlayingName }}
                    </span>
                    <ExplicitIcon
                        v-if="nowPlaying.is_explicit"
                        class="mr-8" />
                </vue3-marquee>
            </a>
        </div>
    </Container>
</template>

<script>
import Container from '@/views/components/Container';
import ExplicitIcon from '@/views/components/icons/ExplicitIcon';
import MusicNote from '@/views/components/icons/MusicNote';
import Logo from '@/views/components/Logo';
import MetalLogo from '@/views/components/MetalLogo';
import ShortLogo from '@/views/components/ShortLogo';
import { useResizeObserver } from '@vueuse/core';

export default {
    name:       'Header',
    components: { ExplicitIcon, ShortLogo, MetalLogo, MusicNote, Logo, Container },
    data() {
        return {
            currentTime:        this.dayjs().tz( 'America/Phoenix', true ).format( 'h:mm A' ),
            currentTimeTimeout: null,
            nowPlaying:         this.$page.props.nowPlaying,
            nowPlayingTimeout:  null,
            musicNote: {
                timeout: null,
                x:       0,
                y:       0,
                cloned:  [],
            }
        };
    },
    emits: ['mounted'],
    computed: {
        weekDay() {
            return this.dayjs().tz( 'America/Phoenix', true ).format( 'ddd' ).toUpperCase();
        },
        nowPlayingName() {
            return this.nowPlaying.is_explicit
                ? this.nowPlaying.name.replace( /[aeiou]/gi, '*' )
                : this.nowPlaying.name;
        },
    },
    watch: {
        'nowPlaying.is_playing'() {
            if ( this.nowPlaying.is_playing ) {
                this.animateMusicNote();
            }
        },
    },
    methods:  {
        initializeLiveTime() {

            this.currentTimeTimeout = setInterval( () => {
                this.currentTime = this.dayjs().tz( 'America/Phoenix', true ).format( 'h:mm A' );
            }, 500 );
        },
        initializeNowPlayingPolling() {
            this.nowPlayingTimeout = setInterval( () => {
                this.$axios.get( '/api/spotify/now-playing' )
                    .then( response => {
                        this.nowPlaying = response.data;
                    } )
                    .catch( error => {
                        console.error( error );
                    } );
            }, 30 * 1000 );
        },
        initializeAnimation() {
            if ( this.nowPlaying.is_playing ) {
                this.animateMusicNote();
            }
        },
        async animateMusicNote() {
            while ( this.nowPlaying.is_playing ) {
                // randomize wait time between 350ms and 750ms
                let waitTime = Math.random() * 400 + 350;
                await new Promise( resolve => setTimeout( resolve, waitTime ));
                this.iconParticleEmitter();
            }
        },
        headerCoords() {
            let { x, y } = this.$el.getBoundingClientRect();
            return {
                headerX: x,
                headerY: y,
            };
        },
        musicNoteCoords() {
            let { x, y } = this.$refs.musicNote.$el.getBoundingClientRect();
            return {
                iconX: x,
                iconY: y,
            };
        },
        iconParticleEmitter() {
            const { headerX, headerY } = this.headerCoords();
            const { iconX, iconY }     = this.musicNoteCoords();

            const x = iconX - headerX;
            const y = iconY - headerY;
            const randomRotation = Math.random() * 90 - 45;
            const randomY = Math.random() * 32 + 32;
            const randomX = Math.random() * 64 - 32;
            const offsetY = 8;

            const iconStyles = {
                position: 'fixed',
                left: `${x}px`,
                top: `${y - offsetY}px`,
                zIndex: 50,
                opacity: 0.5,
                transform: `scale(0.0) rotate(${randomRotation}deg)`
            };

            const clonedIcon = this.$refs.musicNote.$el.cloneNode(true);
            Object.assign(clonedIcon.style, iconStyles);
            clonedIcon.classList.add('transition-all', 'duration-[2s]', 'ease-in');

            this.$el.appendChild(clonedIcon);
            this.musicNote.cloned.push({
                element: clonedIcon,
                timestamp: Date.now(),
            });

            setTimeout(() => {
                Object.assign(clonedIcon.style, {
                    top: `${y - randomY}px`,
                    left: `${x + randomX}px`,
                    opacity: 0,
                    transform: 'scale(1.5)',
                    filter: 'blur(2px)'
                });
            }, 100);
        },
        cleanUpMusicNotes() {
            setInterval(() => {
                const now = Date.now();
                this.musicNote.cloned = this.musicNote.cloned.filter(({ timestamp, element }) => {
                    if (now - timestamp > 2000) {
                        element.remove();
                        return false;
                    }
                    return true;
                });
            }, 1000);
        },
        updateMusicNotePosition() {
            const { x, y } = this.$refs.musicNote.$el.getBoundingClientRect();
            this.musicNote.x = x;
            this.musicNote.y = y;
        },
    },
    mounted() {
        this.$emit('mounted');

        this.initializeLiveTime();

        setTimeout(() => {
            this.initializeNowPlayingPolling();
            this.initializeAnimation();
            this.updateMusicNotePosition();
            this.cleanUpMusicNotes();
        }, 3000);

        useResizeObserver(document.body, () => {
            this.updateMusicNotePosition();
        });
    },
    beforeDestroy() {
        clearInterval( this.currentTimeTimeout );
        clearInterval( this.nowPlayingTimeout );
    },
};
</script>

<style scoped>

</style>
