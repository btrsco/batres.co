<template>
    <section class="flex flex-col gap-12 relative">
        <h2 class="sm:absolute left-0 top-0 px-3 sm:px-6 py-1 z-[-1] font-display uppercase text-5xl/[0.75] md:text-6xl/[0.75] bg-gradient-to-b from-zinc-200 to-zinc-100 inline-block text-transparent bg-clip-text">
            {{ title }}
        </h2>
        <component
            :is="as"
            class="list-none flex flex-col gap-3 sm:gap-6 -mt-[4rem] sm:mt-9 md:mt-10">
            <slot />
        </component>
    </section>
</template>

<script>
export default {
    name: 'TitledSection',
    props: {
        title: {
            type: String,
            required: true,
        },
        as: {
            type: String,
            default: 'ul',
        },
    },
};
</script>
