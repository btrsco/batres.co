<template>
    <component
        :is="as"
        v-bind="$attrs">
        <slot />
    </component>
</template>

<script>
import { useIntersectionObserver } from '@vueuse/core';
import anime from 'animejs';

export default {
    name:  'Animate',
    props: {
        as:         {
            type:    [String, Object],
            default: 'div',
        },
        translateY: {
            type:     [ Number, Array ],
            required: false,
        },
        translateX: {
            type:     [ Number, Array ],
            required: false,
        },
        opacity:    {
            type:     [ Number, Array ],
            required: false,
        },
        duration:   {
            type:    Number,
            default: 1000,
        },
        easing:     {
            type:    String,
            default: 'easeOutElastic(1, .5)',
            // more info: https://animejs.com/documentation/#linearEasing
        },
        delay:      {
            type:    Number,
            default: 0,
        },
        endDelay:   {
            type:    Number,
            default: 0,
        },
        intersecting: {
            type:    Boolean,
            default: false,
        },
        intersectingDelay: {
            type:    Number,
            default: 0,
        },
        once:       {
            type:    Boolean,
            default: false,
        },
    },
    data() {
        return {
            intersectingOnRender: false,
            mountedTimestamp:   null,
        };
    },
    methods: {
        animate() {
            anime( {
                targets:    this.$el,
                duration:   this.duration,
                easing:     this.easing,
                delay:      this.computedDelay,
                endDelay:   this.endDelay,
                opacity:    this.opacity || 1,
                translateX: this.translateX || 0,
                translateY: this.translateY || 0,
            } );
        },
    },
    computed: {
        computedDelay() {
            return this.intersecting
                ? this.intersectingOnRender
                    ? this.intersectingDelay
                    : this.delay
                : this.delay;
        },
    },
    mounted() {
        this.mountedTimestamp = Date.now();

        if ( this.opacity instanceof Array  && this.opacity[0] === 0 ) {
            this.$el.style.opacity = 0;
        } else if ( this.opacity === 0 ) {
            this.$el.style.opacity = 0;
        }

        if (this.intersecting) {
            useIntersectionObserver( this.$el, ([{ isIntersecting }], observerElement) => {
                if (isIntersecting) {
                    if ( this.mountedTimestamp < Date.now() - 100 ) {
                        this.intersectingOnRender = true;
                    }

                    this.$nextTick(() => {
                        this.animate();
                    });

                    if (this.once) {
                        observerElement.disconnect();
                    }
                }
            });
        } else {
            this.animate();
        }
    },
};
</script>

<style scoped>

</style>
