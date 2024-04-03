<template>
    <div class="flex-shrink-0 aspect-shot max-w-64 w-full sm:max-w-none sm:w-auto rounded-lg overflow-hidden border border-zinc-300"
         style="background-size: cover;"
         :style="{backgroundImage: `url(${image})`}">
    </div>
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
