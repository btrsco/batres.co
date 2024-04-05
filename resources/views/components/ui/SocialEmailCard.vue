<template>
    <Card class="order-3 sm:order-4 md:order-2 col-span-2 group cursor-pointer" @click="mailTo">
        <div class="transform transition-all duration-200 ease-in-out absolute inset-0 hidden sm:flex flex-col justify-center items-center z-[2] bg-gradient-to-b from-zinc-950 to-zinc-700 scale-110 group-hover:scale-100 group-hover:opacity-100 opacity-0">
            <h1 class="font-display uppercase text-3xl/[0.75] text-white z-[1]">
                Let's Work <br>
                Together
            </h1>
            <div class="absolute inset-0 flex justify-center items-center">
                <MetalLogo
                    class="opacity-5 mt-8"
                    style="width: 85%" />
            </div>
        </div>
        <div class="absolute inset-0 flex flex-col justify-center items-center z-[1]">
            <h1 class="block sm:hidden font-display uppercase text-3xl/[0.75] bg-gradient-to-b from-zinc-400 to-zinc-300 inline-block text-transparent bg-clip-text px-2 py-1 w-80">
                Let's Work <br>
                Together
            </h1>
            <h1 class="font-display uppercase text-3xl/[0.75] bg-gradient-to-b from-zinc-800 to-zinc-500 inline-block text-transparent bg-clip-text px-2 py-1 w-80">
                Miguel <br>
                @Batres.co
            </h1>
        </div>
        <div class="absolute inset-0 flex justify-center items-center opacity-50">
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
