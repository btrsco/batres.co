<template>
    <div class="grid grid-cols-2 gap-2 max-h-[7.875rem]">
        <a
            v-for="shot in recentShots"
            :href="shot.html_url"
            class="block border border-zinc-200 dark:border-zinc-800 rounded-lg aspect-shot object-cover overflow-hidden max-w-[4.875rem]">
            <img
                :src="shot.images.normal"
                :alt="shot.title + ' By Miguel Batres'">
        </a>
    </div>
</template>

<script>
export default {
    name: 'RecentShotsGrid',
    data() {
        return {
            shots: this.$page.props.recentShots,
        };
    },
    computed: {
        recentShots() {
            return this.shots.slice(0, 4);
        },
    },
};
</script>
