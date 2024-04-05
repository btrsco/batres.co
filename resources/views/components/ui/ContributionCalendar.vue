<template>
    <div class="grid grid-cols-7 grid-rows-8 w-[7.5rem] gap-1">
        <div
            v-for="(contribution, index) in contributions"
            class="border rounded w-3 h-3"
            :class="[contributionClass(contribution)]">

        </div>
    </div>
</template>

<script>
export default {
    name: 'ContributionCalendar',
    data() {
        return {
            weeklyContributions: [
                1, 1, 0, 0, 0, 3, 1,
                1, 0, 0, 3, 0, 3, 0,
                0, 0, 0, 3, 0, 3, 0,
                1, 1, 3, 0, 1, 1, 3,
                1, 0, 0, 1, 1, 2, 2,
                0, 0, 0, 1, 1, 1, 2,
                1, 3, 0, 1, 2, 2, 1,
                1, 0, 2, 3, 3, 3, 2,
            ],
        };
    },
    computed: {
        contributions() {
            const chunked = this.weeklyContributions.reduce((acc, curr, i) => {
                if (i % 7 === 0) acc.push([]);
                acc[acc.length - 1].push(curr);
                return acc;
            }, []).flat().reverse();
            const offset = (this.dayOfTheYear + 1) % 56;

            return chunked.slice(-offset).concat(chunked.slice(0, -offset)).reverse();
        },
        dayOfTheYear() {
            const now = new Date();
            const startOfYear = new Date(now.getFullYear(), 0, 0);
            const diff = now - startOfYear;
            const oneDay = 1000 * 60 * 60 * 24;
            return Math.floor(diff / oneDay);
        }
    },
    methods: {
        contributionClass(contribution) {
            return {
                'bg-zinc-100 border-zinc-200 dark:bg-zinc-800 dark:border-zinc-700': contribution === 0,
                'bg-green-200 border-green-300 dark:bg-green-900 dark:border-green-700': contribution === 1,
                'bg-green-400 border-green-500 dark:bg-green-600 dark:border-green-400': contribution === 2,
                'bg-green-500 border-green-600 dark:bg-green-400 dark:border-green-300': contribution === 3
            }
        }
    }
};
</script>

<style scoped>

</style>
