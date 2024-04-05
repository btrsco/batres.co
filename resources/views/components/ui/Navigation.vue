<template>
    <footer class="fixed left-0 right-0 bottom-0 p-3 sm:p-4 pt-0 z-20 pointer-events-none">
        <nav class="w-full sm:w-max mx-auto flex justify-between sm:justify-center items-center gap-2 sm:gap-4 px-3 sm:px-6 py-2 sm:py-2.5 rounded-xl border border-white bg-white/85 backdrop-blur-lg pointer-events-auto dark:bg-black/50 dark:border-zinc-900">
            <button
                v-for="item in navItems"
                :key="item.section"
                @click="scrollToSection(item.section)"
                class="text-sm sm:text-base transition-all duration-200 ease-in-out pointer-events-auto rounded-lg px-4 py-1.5 font-semibold tracking-condensed"
                :class="[buttonClasses(item.section)]"
            >{{ item.label }}</button>
        </nav>
    </footer>
</template>

<script>
export default {
    name: 'Navigation',
    data() {
        return {
            currentSection: 'home',
            navItems: [
                { label: 'Home', section: 'home' },
                { label: 'Work', section: 'work' },
                { label: 'Open Source', section: 'open-source' },
                { label: 'Contact', section: 'contact' },
            ],
            autoScrolling: false,
            autoScrollReset: null,
        };
    },
    mounted() {
        window.addEventListener('scroll', this.updateScroll);
    },
    methods: {
        scrollToSection(section) {
            if ( this.autoScrollReset ) {
                clearTimeout(this.autoScrollReset);
            }

            this.currentSection = section;
            // scroll to section with a 72px offset
            const element = document.getElementById(section);
            const offset = 128;
            const elementPosition = element.getBoundingClientRect().top + window.scrollY;
            const offsetPosition = elementPosition - offset;

            this.autoScrolling = true;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth',
            });

            this.autoScrollReset = setTimeout(() => {
                this.autoScrolling = false;
            }, 1000);
        },
        buttonClasses(section) {
            return {
                'bg-black text-white dark:bg-white dark:text-black': this.currentSection === section,
                'bg-transparent text-black/25 dark:text-white/50': this.currentSection !== section,
            };
        },
        updateScroll() {
            if ( this.autoScrolling ) {
                return;
            }

            const scrollPosition = window.scrollY;
            const sections = document.querySelectorAll('section');

            // if at the top 420px section should be home
            if (scrollPosition < 420) {
                return this.currentSection = 'home';
            }

            // if at the bottom 128px section should be contact
            if (scrollPosition + window.innerHeight > document.body.offsetHeight - 128) {
                return this.currentSection = 'contact';
            }

            sections.forEach((section) => {
                const id = section.id;

                if ( id === 'home' || id === 'contact' ) {
                    return;
                }

                const centerOfViewport = scrollPosition + window.innerHeight / 2;
                const centerOfSection = section.offsetTop + section.offsetHeight / 2;

                // if center of viewport is in range of center of section without +/- 320px set section as current
                if (centerOfViewport > centerOfSection - 320 && centerOfViewport < centerOfSection + 320) {
                    this.currentSection = id;
                }
            });
        },
    },
};
</script>
