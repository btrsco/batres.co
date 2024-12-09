<template>
    <AppLayout>
        <KinesisContainer>
            <KinesisElement
                class="absolute z-[-1] md:-top-24 left-0 right-0 flex justify-center items-start w-full h-auto animate__animated animate__fadeIn animate__slow"
                :strength="4"
                type="depth_inv">
                <div class="flex justify-center items-start max-w-7xl mx-auto w-full">
                    <MetalLogo class="opacity-75" />
                </div>
            </KinesisElement>

            <Animate
                :as="Header"
                :translateY="[-64, 0]"
                :opacity="[0, 1]"
                :duration="2000"
                :delay="3000"
                easing="easeOutExpo"
                once />

            <div class="h-16 sm:h-20 md:h-24"></div>
            <Container
                as="main"
                class="flex flex-col gap-20 sm:gap-24">
                <section
                    id="home"
                    class="flex flex-col gap-6 sm:gap-12 p-3 sm:p-6">
                    <Animate
                        :as="HeroHeading"
                        :translateY="[32, 0]"
                        :opacity="[0, 1]"
                        :duration="2000"
                        :delay="500"
                        easing="easeOutExpo"
                        once />
                    <Animate
                        class="flex flex-col gap-3 sm:gap-6 text-2xl sm:text-[2rem] sm:leading-[3rem] tracking-condensed text-zinc-700 dark:text-zinc-400"
                        :translateY="[128, 0]"
                        :opacity="[0, 1]"
                        :duration="2000"
                        :delay="1000"
                        easing="easeOutExpo"
                        once>
                        <p>
                            Designing
                            <IconStack>
                                <FigmaIcon />
                                <PhotoshopIcon />
                                <IllustratorIcon />
                            </IconStack>
                            and building
                            <IconStack>
                                <LaravelIcon />
                                <TypeScriptIcon />
                                <!--<JavaScriptIcon />-->
                                <TailwindCssIcon />
                                <VueJsIcon />
                            </IconStack>
                            great products
                            from scratch without compromising on form or function.
                            Moving fast, while ensuring the highest level of quality,
                            detail and performance.
                        </p>
                        <p>
                            Available for work
                            <IconStack>
                                <AvailableIcon />
                                <OdessoIcon />
                                <FewIcon />
                                <NotaryLiveIcon />
                            </IconStack>
                            ,
                            <span
                                class="underline cursor-pointer text-black dark:text-white"
                                @click="scrollToBottom"
                            >let's work together</span>.
                        </p>
                    </Animate>
                </section>
                <Animate
                    title="Work"
                    id="work"
                    :as="TitledSection"
                    :translateY="[64, 0]"
                    :opacity="[0, 1]"
                    :duration="2000"
                    :delay="2000"
                    :intersecting-delay="250"
                    easing="easeOutExpo"
                    intersecting
                    once>
                    <WorkCard
                        v-for="(item, index) in work"
                        :title="item.title"
                        :subtitle="item.subtitle"
                        :description="item.description"
                        :link="item.link"
                        :cta="item.cta"
                        :cta-classes="item.ctaClasses">
                        <template #icon>
                            <component :is="item.icon" />
                        </template>
                        <template #media>
                            <Shot
                                v-for="(image, index) in item.media"
                                :image="image" />
                        </template>
                    </WorkCard>
                </Animate>
                <Animate
                    title="Open Source"
                    id="open-source"
                    :as="TitledSection"
                    :translateY="[64, 0]"
                    :opacity="[0, 1]"
                    :duration="2000"
                    :delay="2500"
                    :intersecting-delay="250"
                    easing="easeOutExpo"
                    intersecting
                    once>
                    <OpenSourceCard
                        v-for="(item, index) in openSource"
                        :vendor="item.vendor"
                        :package="item.package"
                        :description="item.description"
                        :link="item.link"
                        :show-downloads="item.showDownloads">
                        <template #icon>
                            <component :is="item.icon" />
                        </template>
                    </OpenSourceCard>
                </Animate>
                <Animate
                    title="Contact"
                    id="contact"
                    :as="TitledSection"
                    :translateY="[64, 0]"
                    :opacity="[0, 1]"
                    :duration="2000"
                    :intersecting-delay="250"
                    easing="easeOutExpo"
                    intersecting
                    once>
                    <div class="grid grid-cols-2 sm:grid-cols-3 grid-rows-3 md:grid-cols-4 md:grid-rows-2 gap-6">
                        <SocialCard
                            class="order-1 aspect-square col-span-1"
                            title="Read.cv"
                            subtitle="@btrsco"
                            cta="Resume"
                            link="https://read.cv/btrsco"
                            icon-bg="bg-black dark:bg-white"
                            icon-color="text-white dark:text-black">
                            <template #icon>
                                <ReadDotcvIcon class="size-5" />
                            </template>
                        </SocialCard>
                        <SocialEmailCard />
                        <SocialCard
                            class="order-2 md:order-3 md:aspect-square col-span-1"
                            title="Bluesky"
                            subtitle="@btrs.co"
                            cta="Follow"
                            link="https://bsky.app/profile/btrs.co"
                            icon-bg="bg-sky-500"
                            icon-color="text-white">
                            <template #icon>
                                <BlueskyIcon class="size-5" />
                            </template>
                        </SocialCard>
                        <SocialCard
                            class="order-4 aspect-square md:aspect-auto md:col-span-2"
                            title="GitHub"
                            subtitle="@btrsco"
                            cta="Follow"
                            link="https://github.com/btrsco"
                            icon-bg="bg-zinc-800 dark:bg-white"
                            icon-color="text-white dark:text-zinc-800">
                            <template #icon>
                                <GitHubIcon class="size-5" />
                            </template>
                            <template #content>
                                <ContributionCalendar />
                            </template>
                        </SocialCard>
                        <SocialCard
                            class="order-5 sm:order-3 md:order-5 aspect-square md:aspect-auto md:col-span-2"
                            title="Dribbble"
                            subtitle="@batres"
                            cta="Follow"
                            link="https://dribbble.com/batres"
                            icon-bg="bg-pink-500"
                            icon-color="text-white">
                            <template #icon>
                                <DribbbleIcon class="size-5" />
                            </template>
                            <template #content>
                                <RecentShotsGrid />
                            </template>
                        </SocialCard>
                    </div>
                </Animate>
            </Container>

        </KinesisContainer>
    </AppLayout>
</template>

<script>
import Animate from '@/views/components/Animate';
import Card from '@/views/components/Card';
import Container from '@/views/components/Container';
import HeroHeading from '@/views/components/HeroHeading';
import AvailableIcon from '@/views/components/illustrations/AvailableIcon';
import FewIcon from '@/views/components/illustrations/companies/FewIcon';
import NotaryLiveIcon from '@/views/components/illustrations/companies/NotaryLiveIcon';
import OdessoIcon from '@/views/components/illustrations/companies/OdessoIcon';
import FigmaIcon from '@/views/components/illustrations/designStack/FigmaIcon';
import IllustratorIcon from '@/views/components/illustrations/designStack/IllustratorIcon';
import PhotoshopIcon from '@/views/components/illustrations/designStack/PhotoshopIcon';
import JavaScriptIcon from '@/views/components/illustrations/devStack/JavaScriptIcon';
import LaravelIcon from '@/views/components/illustrations/devStack/LaravelIcon';
import TailwindCssIcon from '@/views/components/illustrations/devStack/TailwindCssIcon';
import TypeScriptIcon from '@/views/components/illustrations/devStack/TypeScriptIcon';
import VueJsIcon from '@/views/components/illustrations/devStack/VueJsIcon';
import DomainParserIcon from '@/views/components/illustrations/openSource/DomainParserIcon';
import PasswordGeneratorIcon from '@/views/components/illustrations/openSource/PasswordGeneratorIcon';
import WhoisParserIcon from '@/views/components/illustrations/openSource/WhoisParserIcon';
import WhoisProxyIcon from '@/views/components/illustrations/openSource/WhoisProxyIcon';
import ComponentGuideIcon from '@/views/components/illustrations/projects/ComponentGuideIcon';
import StickerBombIcon from '@/views/components/illustrations/projects/StickerBombIcon';
import VscoDownloadIcon from '@/views/components/illustrations/projects/VscoDownloadIcon';
import WooshLinkIcon from '@/views/components/illustrations/projects/WooshLinkIcon'
import MetalLogo from '@/views/components/MetalLogo';
import TitledSection from '@/views/components/TitledSection';
import BackgroundLogo from '@/views/components/ui/BackgroundLogo';
import ContributionCalendar from '@/views/components/ui/ContributionCalendar';
import Header from '@/views/components/ui/Header';
import IconStack from '@/views/components/ui/IconStack';
import Navigation from '@/views/components/ui/Navigation';
import OpenSourceCard from '@/views/components/ui/OpenSourceCard';
import RecentShotsGrid from '@/views/components/ui/RecentShotsGrid';
import Shot from '@/views/components/ui/Shot';
import SocialCard from '@/views/components/ui/SocialCard';
import SocialEmailCard from '@/views/components/ui/SocialEmailCard';
import WorkCard from '@/views/components/ui/WorkCard';
import AppLayout from '@/views/layouts/AppLayout';
import { KinesisContainer, KinesisElement } from 'vue-kinesis';
import { BlueskyIcon, DribbbleIcon, GitHubIcon, ReadDotcvIcon } from 'vue3-simple-icons'

export default {
    name:       'Home',
    computed:   {
        Navigation() {
            return Navigation
        },
        TitledSection() {
            return TitledSection
        },
        HeroHeading() {
            return HeroHeading;
        },
        Header() {
            return Header;
        }
    },
    components: {
        TailwindCssIcon,
        TypeScriptIcon,
        JavaScriptIcon,
        Animate,
        MetalLogo,
        OdessoIcon,
        FewIcon,
        NotaryLiveIcon,
        AvailableIcon,
        VueJsIcon,
        LaravelIcon,
        IllustratorIcon,
        PhotoshopIcon,
        FigmaIcon,
        IconStack,
        RecentShotsGrid,
        DribbbleIcon,
        ContributionCalendar,
        SocialEmailCard,
        ReadDotcvIcon,
        SocialCard,
        Shot,
        WhoisProxyIcon,
        WhoisParserIcon,
        DomainParserIcon,
        OpenSourceCard,
        GitHubIcon,
        PasswordGeneratorIcon,
        WorkCard,
        StickerBombIcon,
        VscoDownloadIcon,
        ComponentGuideIcon,
        WooshLinkIcon,
        Card,
        TitledSection,
        HeroHeading,
        Container,
        BackgroundLogo,
        Header,
        AppLayout,
        KinesisContainer,
        KinesisElement,
        BlueskyIcon
    },
    data() {
        return {
            work:       [
                {
                    title:       'Woosh.link',
                    subtitle:    'Product Design & Web Development',
                    description: 'Effortlessly share everything you create, curate, and sell across all social platforms with your own link page.',
                    cta:         'Claim your page',
                    icon:        'WooshLinkIcon',
                    link:        'https://woosh.link/?utm_sorce=batres_co&utm_medium=work_item',
                    media:       [ '/images/woosh-link-preview-01@2x.jpg' ],
                    ctaClasses:  'bg-zinc-800 text-white dark:bg-white dark:text-zinc-800',
                },
                {
                    title:       'Sticker Bomb Co.',
                    subtitle:    'Product Design & Web Development',
                    description: 'Monthly sticker subscription box. Join the club and you’ll receive a pack of hand picked stickers you’ll love.',
                    cta:         'Customize Pack',
                    icon:        'StickerBombIcon',
                    link:        'https://stickerbomb.co/?ref=personal',
                    media:       [ '/images/stickerbomb-preview-01@2x.jpg', '/images/stickerbomb-preview-02@2x.jpg' ],
                    ctaClasses:  'bg-yellow-300 text-black',
                },
                {
                    title:       'VSCO Download',
                    subtitle:    'Browser Extension Development',
                    description: 'Allow users to download VSCO media with one click. Serving 10k monthly active users and over 6M media downloads.',
                    cta:         'Download',
                    icon:        'VscoDownloadIcon',
                    link:        'https://chromewebstore.google.com/detail/vsco-media-downloader/looapkhpinpjaioiljphfmbnhbbgfcpl',
                    media:       [ '/images/vsco-download-preview-01@2x.jpg' ],
                    ctaClasses:  'bg-zinc-800 text-white dark:bg-white dark:text-zinc-800',
                },
            ],
            openSource: [
                {
                    vendor:      'outofoffice',
                    package:     'password-generator',
                    description: 'Laravel Nova 4 package to add random password generation field.',
                    link:        'https://github.com/oooholdings/nova-password-generator',
                    icon:        'PasswordGeneratorIcon',
                    showDownloads: true,
                },
            ],
        };
    },
    methods: {
        scrollToBottom() {
            window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
        },
    },
};
</script>
