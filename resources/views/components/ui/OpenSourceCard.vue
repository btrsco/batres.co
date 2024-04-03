<template>
    <Card as="li">
        <div class="flex flex-col sm:flex-row sm:items-center gap-5 sm:gap-4 p-3 sm:p-6">
            <div class="flex justify-between items-center">
                <slot name="icon" />

                <div class="flex items-center gap-4">
                    <a
                        v-if="showDownloads"
                        :href="packagistUrl"
                        class="flex sm:hidden p-1.5 gap-1 justify-center items-center rounded-lg w-max bg-zinc-200 text-zinc-500 text-xs font-semibold"
                        target="_blank">
                        <span
                            v-if="!fetching"
                            class="pl-1">
                            {{ downloadCount }}
                        </span>
                        <div
                            v-else
                            class="p-1">
                            <LoadingIcon class="w-4 h-4 animate-spin" />
                        </div>
                        <DownloadIcon />
                    </a>
                    <a
                        :href="link"
                        class="flex sm:hidden px-4 py-1.5 gap-2 justify-center items-center rounded-lg w-max bg-zinc-800 text-white text-sm font-semibold"
                        target="_blank">
                        <span>View Code</span>
                        <GithubIcon />
                    </a>
                </div>
            </div>
            <a
                :href="link"
                class="block w-full pb-2 sm:pb-0"
                target="_blank">
                <h3 class="text-base font-sans-expanded tracking-condensed">{{ vendor }}/{{ package }}</h3>
                <p class="text-sm text-zinc-600 tracking-tight">{{ description }}</p>
            </a>
            <a
                v-if="showDownloads"
                :href="packagistUrl"
                class="hidden sm:flex items-center gap-1 p-1.5 rounded-lg w-max bg-zinc-200 text-zinc-500 text-xs font-semibold"
                target="_blank">
                <span
                    v-if="!fetching"
                    class="pl-1">
                    {{ downloadCount }}
                </span>
                <div
                    v-else
                    class="p-1">
                    <LoadingIcon class="w-4 h-4 animate-spin" />
                </div>
                <DownloadIcon />
            </a>
            <a
                :href="link"
                class="hidden sm:flex p-1.5 rounded-lg w-max bg-zinc-800 text-white"
                target="_blank">
                <GithubIcon />
            </a>
        </div>
    </Card>
</template>

<script>
import Card from '@/views/components/Card';
import DownloadIcon from '@/views/components/icons/DownloadIcon';
import GithubIcon from '@/views/components/icons/GithubIcon';
import LoadingIcon from '@/views/components/icons/LoadingIcon';

export default {
    name: 'OpenSourceCard',
    components: { LoadingIcon, DownloadIcon, Card, GithubIcon },
    props: {
        vendor: {
            type: String,
            required: true,
        },
        package: {
            type: String,
            required: true,
        },
        description: {
            type: String,
            required: true,
        },
        link: {
            type: String,
            required: true,
        },
        showDownloads: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            downloads: 0,
            fetching: true,
        };
    },
    computed: {
        downloadCount() {
            return this.downloads > 999
                ? `${(this.downloads / 1000).toFixed(1)}K`
                : this.downloads;
        },
        packagistUrl() {
            return `https://packagist.org/packages/${this.vendor}/${this.package}`;
        },
    },
    methods: {
        fetchDownloads() {
            fetch(`https://repo.packagist.org/packages/${this.vendor}/${this.package}/stats.json`)
                .then(response => response.json())
                .then(data => {
                    this.downloads = data.downloads.total;
                    this.fetching = false;
                })
                .catch(() => console.error(`Failed to fetch downloads for ${this.vendor}/${this.package}`));
        },
    },
    mounted() {
        if ( this.showDownloads ) {
            this.fetchDownloads();
        }
    },
};
</script>

<style scoped>

</style>
