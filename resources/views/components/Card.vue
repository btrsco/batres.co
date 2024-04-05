<template>
    <component
        :is="as"
        class="bg-white dark:bg-black w-full rounded-3xl p-[1px] bg-gradient-to-br from-zinc-100 to-zinc-300 dark:from-zinc-800 dark:to-zinc-700 shadow-lg sm:hover:shadow-xl transition-all duration-200 ease-in-out">
        <div
            class="relative w-full h-full rounded-[1.4375rem] bg-white dark:bg-black overflow-hidden"
            :class="[innerClass]">
            <slot />
        </div>
    </component>
</template>

<script>
export default {
    name: 'Card',
    props: {
        as: {
            type:    String,
            default: 'div',
        },
        innerClass: {
            type:    String|Array|Object,
            required: false,
        },
    }
};
</script>
