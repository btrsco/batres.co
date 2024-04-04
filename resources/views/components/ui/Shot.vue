<template>
    <img
        :src="image"
        class="flex-shrink-0 aspect-shot max-w-64 w-full sm:max-w-[21rem] sm:w-auto rounded-lg overflow-hidden border border-zinc-300"/>
</template>

<script>
export default {
    name: 'Shot',
    props: {
        image: {
            type: String,
            required: true,
        },
    },
};
</script>
