<template>
    <PageHead :title="title || $page.props.app.meta.title.default"></PageHead>
    <GrainOverlay />

    <Animate
        :as="Navigation"
        :translateY="[64, 0]"
        :opacity="[0, 1]"
        :duration="2000"
        :delay="3000"
        easing="easeOutExpo"
        once />

    <div class="md:h-24"></div>

    <slot />

    <div class="h-24"></div>
</template>

<script>
import Animate from '@/views/components/Animate';
import GrainOverlay from '@/views/components/GrainOverlay';
import Navigation from '@/views/components/ui/Navigation';
import PageHead from '@/views/components/utils/PageHead';

export default {
    name:       'AppLayout',
    props:      {
        title: {
            type: String,
            required: false,
        },
    },
    computed:   {
        Navigation() {
            return Navigation
        }
    },
    components: { Animate, GrainOverlay, PageHead },
};
</script>
