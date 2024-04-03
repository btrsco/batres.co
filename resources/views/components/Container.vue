<template>
    <component
        :is="as"
        class="max-w-3xl mx-auto">
        <slot />
    </component>
</template>

<script>
export default {
    name: 'Container',
    props: {
        as: {
            type: String,
            default: 'div',
        },
    },
};
</script>
