<template>
    <transition
        enter-active-class="transition-opacity ease-in duration-300"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity ease-out duration-300"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0">
        <div
            v-if="supported"
            class="fixed inset-0 w-full h-full bg-repeat bg-fixed opacity-40 z-[100] pointer-events-none mix-blend-overlay"
            :style="{backgroundImage: 'url(/images/grain-overlay.gif)', backgroundSize: '100px 100px'}">
        </div>
    </transition>
</template>

<script>
export default {
    name: 'GrainOverlay',
    data() {
        return {
            supported: false,
        };
    },
    mounted() {
        if ( 'CSS' in window && 'supports' in window.CSS ) {
            this.supported = window.CSS.supports( 'mix-blend-mode', 'overlay' );
        }
    },
};
</script>
