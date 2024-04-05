<template>
    <Card as="li">
        <div class="relative z-10 flex flex-col gap-5 p-3 sm:p-6 sm:w-80 border-r border-zinc-200 dark:border-zinc-800 bg-white sm:bg-white/85 dark:bg-black dark:sm:bg-black/85 sm:backdrop-blur-lg">
            <div class="flex justify-between items-center w-full">
                <slot name="icon" />
                <button class="inline-flex sm:hidden px-4 py-2 rounded-lg text-sm gap-2 w-max font-semibold"
                        type="button"
                        :class="[ctaClasses]"
                        @click="openLink">
                    {{ cta }}
                    <ClockWaitIcon
                        v-if="!link"
                        class="w-5 h-5" />
                    <ArrowRightIcon
                        v-else
                        class="w-5 h-5" />
                </button>
            </div>

            <div>
                <h3 class="text-lg font-sans-expanded tracking-condensed text-black dark:text-white">{{ title }}</h3>
                <p class="text-sm text-zinc-400 dark:text-zinc-600 tracking-tight">{{ subtitle }}</p>
            </div>


            <p class="text-sm text-zinc-600 dark:text-zinc-400 tracking-tight sm:h-[3.75rem]">{{ description }}</p>

            <button class="hidden sm:inline-flex px-4 py-2 rounded-lg text-sm gap-2 w-max font-semibold transition-all duration-300 ease-in-out"
                    type="button"
                    :class="[ctaClasses, { 'cursor-not-allowed': !link, 'shadow-md sm:hover:shadow-lg': link }]"
                    @click="openLink">
                {{ cta }}
                <ClockWaitIcon
                    v-if="!link"
                    class="w-5 h-5" />
                <ArrowRightIcon
                    v-else
                    class="w-5 h-5" />
            </button>
        </div>

        <div class="relative sm:absolute sm:inset-0">
            <div
                class="flex justify-center items-center absolute right-0 top-0 bottom-0 z-10 p-3 bg-gradient-to-r from-transparent to-zinc-100 dark:to-zinc-900 transform transition-all duration-300 ease-in-out"
                :class="[canScrollMedia ? 'translate-x-0' : 'translate-x-full']"
                @click="scrollRight">
                <div class="rounded-full p-1 bg-white/85 dark:bg-black/85 backdrop-blur-xl border border-white dark:border-black">
                    <ChevronRightIcon class="w-6 h-6 text-zinc-400 dark:text-white" />
                </div>
            </div>

            <div
                ref="media"
                class="sm:absolute sm:inset-0 flex gap-4 bg-zinc-100 dark:bg-zinc-900 p-3 sm:p-6 sm:pl-[21.5rem] overflow-y-scroll">
                <slot name="media" />
            </div>
        </div>
    </Card>
</template>

<script>
import Card from '@/views/components/Card';
import ArrowRightIcon from '@/views/components/icons/ArrowRightIcon';
import ChevronRightIcon from '@/views/components/icons/ChevronRightIcon';
import ClockWaitIcon from '@/views/components/icons/ClockWaitIcon';
import { useResizeObserver, useScroll } from '@vueuse/core';

export default {
    name:       'WorkCard',
    components: { ChevronRightIcon, ArrowRightIcon, ClockWaitIcon, Card },
    props:      {
        title:       {
            type:    String,
            default: 'Project Title',
        },
        description: {
            type:    String,
            default: 'Project Description',
        },
        subtitle:    {
            type:    String,
            default: 'Project Subtitle',
        },
        link:        {
            type:    String,
            default: null,
        },
        cta:         {
            type:    String,
            default: 'Learn More',
        },
        ctaClasses:  {
            type:    String,
            default: 'bg-zinc-200 text-zinc-500',
        },
    },
    data() {
        return {
            canScrollMedia: false,
        };
    },
    methods: {
        onScroll( arrivedState ) {
            this.canScrollMedia = !arrivedState.right;
        },
        initScroll( arrivedState ) {
            let scrollWidth = this.$refs.media.scrollWidth;
            let clientWidth = this.$refs.media.clientWidth;

            if ( scrollWidth > clientWidth ) {
                this.canScrollMedia = !arrivedState.right;
                return;
            }

            this.canScrollMedia = false;
        },
        onResize(entries) {
            let scrollWidth = this.$refs.media.scrollWidth;
            let clientWidth = this.$refs.media.clientWidth;

            this.canScrollMedia = scrollWidth > clientWidth;
        },
        scrollRight() {
            this.$refs.media.scrollBy( { left: 240, behavior: 'smooth' } );
        },
        openLink( event ) {
            event.preventDefault();

            if ( this.link && !this.link.startsWith( '#' ) ) {
                window.open( this.link, '_blank' );
            }
        },
    },
    mounted() {
        const { arrivedState } = useScroll( this.$refs.media, {
            onScroll: () => this.onScroll( arrivedState ),
            offset:   { right: 20 },
        } );

        this.initScroll( arrivedState );

        useResizeObserver( this.$refs.media, this.onResize)
    },
};
</script>

<style scoped>

</style>
