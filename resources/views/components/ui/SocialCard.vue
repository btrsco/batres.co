<template>
    <Card class="@container">
        <div class="flex h-full w-full"
             :class="[{ 'flex-row': $slots.content, 'flex-col': !$slots.content }]"
        >
            <div class="flex flex-col p-6 justify-between h-full max-h-[10.75rem]">
                <div
                    class="p-1 rounded-lg w-8 h-8 flex items-center justify-center"
                    :class="[iconBg, iconColor]">
                    <slot name="icon" />
                </div>

                <div class="text-sm/[1.125rem]">
                    <div class="text-zinc-600 dark:text-zinc-400 font-semibold">{{ title }}</div>
                    <div class="text-zinc-400 dark:text-zinc-600">{{ subtitle }}</div>
                </div>

                <a
                    class="px-3 py-1.5 text-sm leading-4 font-semibold rounded-lg w-max cursor-pointer"
                    :class="[iconBg, iconColor]"
                    :href="link"
                    target="_blank">
                    {{ cta }}
                </a>
            </div>

            <div v-if="$slots.content" class="hidden @xs:flex justify-end flex-1 p-6 pl-0">
                <slot name="content" />
            </div>
        </div>
    </Card>
</template>

<script>
import Card from '@/views/components/Card';
import ReadCvIcon from '@/views/components/icons/ReadCvIcon';

export default {
    name:       'SocialCard',
    components: { ReadCvIcon, Card },
    props:      {
        title:     {
            type:    String,
            default: 'Social Title',
        },
        subtitle:  {
            type:    String,
            default: 'Social Subtitle',
        },
        cta:       {
            type:    String,
            default: 'Learn More',
        },
        link:      {
            type:    String,
            default: null,
        },
        icon:      {
            type:    String,
            default: 'SocialIcon',
        },
        iconBg:    {
            type:    String,
            default: 'bg-zinc-200',
        },
        iconColor: {
            type:    String,
            default: 'text-zinc-500',
        },
    },
};
</script>
