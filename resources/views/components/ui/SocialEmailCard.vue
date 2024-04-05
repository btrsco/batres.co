<template>
    <Card
        class="order-3 sm:order-4 md:order-2 col-span-2 group cursor-pointer @container"
        @click="mailTo">
        <div class="absolute inset-0 flex flex-col justify-center items-center z-[1] ransition-all duration-200 ease-in-out transform sm:group-hover:-translate-y-5">
            <h1 class="font-display uppercase text-2xl/[0.75] @md:text-3xl/[0.75] sm:group-hover:opacity-25 dark:sm:group-hover:opacity-50 transition-all duration-200 ease-in-out bg-gradient-to-b from-zinc-400 to-zinc-300 dark:from-zinc-500 dark:to-zinc-800 inline-block text-transparent bg-clip-text px-2 py-1 w-[16.25rem] @md:w-80">
                Let's Work <br>
                Together
            </h1>
            <h1 class="font-display uppercase text-2xl/[0.75] @md:text-3xl/[0.75] bg-gradient-to-b from-zinc-800 to-zinc-500 dark:from-zinc-300 dark:to-zinc-400 sm:group-hover:from-zinc-800 sm:group-hover:to-black dark:sm:group-hover:from-zinc-100 dark:sm:group-hover:to-white inline-block text-transparent bg-clip-text px-2 py-1 w-[16.25rem] @md:w-80 transition-all duration-200 ease-in-out">
                Miguel <br>
                @Batres.co
            </h1>
        </div>
        <div class="absolute inset-0 flex justify-center items-center">
            <MetalLogo
                class="mt-8"
                style="width: 85%" />
        </div>
    </Card>
</template>

<script>
import Card from '@/views/components/Card';
import MetalLogo from '@/views/components/MetalLogo';

export default {
    name: 'SocialEmailCard',
    components: { MetalLogo, Card },
    methods: {
        mailTo() {
            const email = 'miguel@batres.co';
            const subject = 'Let\'s Work Together';
            window.location.href = `mailto:${email}?subject=${subject}`;
        },
    },
};
</script>
