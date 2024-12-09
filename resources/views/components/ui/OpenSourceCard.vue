<template>
    <Card as="li">
        <div class="flex flex-col sm:flex-row sm:items-center gap-5 sm:gap-4 p-3 sm:p-6">
            <div class="flex justify-between items-center">
                <slot name="icon" />

                <div class="flex items-center gap-4">
                    <a
                        v-if="showDownloads"
                        :href="packagistUrl"
                        class="flex sm:hidden p-1.5 gap-1 justify-center items-center rounded-lg w-max bg-blue-500 text-white dark:bg-blue-400 text-xs font-semibold shadow-md sm:hover:shadow-lg transition-all duration-200 ease-in-out"
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
                        class="flex sm:hidden px-4 py-1.5 gap-2 justify-center items-center rounded-lg w-max bg-zinc-800 text-white dark:text-black dark:bg-white text-sm font-semibold shadow-md sm:hover:shadow-lg transition-all duration-200 ease-in-out"
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
                <h3 class="text-base text-black dark:text-white font-sans-expanded tracking-condensed">{{ vendor }}/{{ package }}</h3>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 tracking-tight">{{ description }}</p>
            </a>
            <a
                v-if="showDownloads"
                :href="packagistUrl"
                class="hidden sm:flex items-center gap-1 p-1.5 rounded-lg w-max bg-blue-500 text-white dark:bg-blue-400 text-xs font-semibold shadow-md sm:hover:shadow-lg transition-all duration-200 ease-in-out"
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
                class="hidden sm:flex p-2 rounded-lg w-max bg-zinc-800 text-white dark:text-black dark:bg-white shadow-md sm:hover:shadow-lg transition-all duration-200 ease-in-out"
                target="_blank">
                <GitHubIcon class="size-5" />
            </a>
        </div>
    </Card>
</template>

<script>
import Card from '@/views/components/Card';
import DownloadIcon from '@/views/components/icons/DownloadIcon';
import LoadingIcon from '@/views/components/icons/LoadingIcon';
import { GitHubIcon } from 'vue3-simple-icons';

export default {
    name: 'OpenSourceCard',
    components: { LoadingIcon, DownloadIcon, Card, GitHubIcon },
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
