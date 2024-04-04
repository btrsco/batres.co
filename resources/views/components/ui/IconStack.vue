<template>
    <div class="relative hidden sm:inline-flex justify-center items-center overflow-visible w-12 h-12 top-3 group select-none"
         @mouseenter="hover = true"
         @mouseleave="hover = false"
         @click="shiftIcons">
        <slot/>
    </div>
</template>

<script>
export default {
    name: 'IconStack',
    data() {
        return {
            hover: false,
            classes: [
                'transform-gpu',
                'absolute',
                'transition-all',
                'duration-200',
                'ease-in-out'
            ],
            styleSets: [
                [
                    {
                        transform: 'rotate(4deg)',
                        top: '0',
                        left: '0',
                        zIndex: 1
                    },
                ],
                [
                    {
                        transform: 'rotate(-4deg)',
                        top: '-3px',
                        left: '-2px',
                        zIndex: 2
                    },
                    {
                        transform: 'rotate(8deg)',
                        top: '1px',
                        left: '0',
                        zIndex: 1
                    }
                ],
                [
                    {
                        transform: 'rotate(8deg)',
                        top: '0',
                        left: '0',
                        zIndex: 3
                    },
                    {
                        transform: 'rotate(-2deg)',
                        top: '0',
                        left: '-3px',
                        zIndex: 2
                    },
                    {
                        transform: 'rotate(-8deg)',
                        top: '-2px',
                        left: '-2px',
                        zIndex: 1
                    }
                ],
                [
                    {
                        transform: 'rotate(8deg)',
                        top: '0.34px',
                        left: '0',
                        zIndex: 4
                    },
                    {
                        transform: 'rotate(-8deg)',
                        top: '2.34px',
                        left: '-2px',
                        zIndex: 3
                    },
                    {
                        transform: 'rotate(4deg)',
                        top: '-1.66px',
                        left: '-4px',
                        zIndex: 2
                    },
                    {
                        transform: 'rotate(-8deg)',
                        top: '1.34px',
                        left: '2px',
                        zIndex: 1
                    }
                ]
            ],
            hoverStyle: {
                transform: 'rotate(8deg)',
                top: '-30px',
                left: '22px',
            },
            shiftingStyle: {
                top: '0',
                left: '0',
            }
        };
    },
    computed: {
        nextIcon() {
            return this.$slots.default[1];
        },
    },
    methods: {
        shiftIcons(event) {
            event.stopPropagation();

            this.hover = false;
            const children = this.$el.children;
            const lastChild = children[children.length - 1];

            for (const [key, value] of Object.entries(this.shiftingStyle)) {
                lastChild.style[key] = value;
            }

            this.$el.prepend(lastChild);

            this.styleIcons();

            this.$nextTick(() => {
                this.hover = true;
            });
        },
        styleIcons() {
            this.$nextTick(() => {
                const children = this.$el.children;

                for (let i = 0; i < children.length; i++) {
                    const icon = children[i];
                    const styleSet = this.styleSets[children.length - 1][i];

                    for (const className of this.classes) {
                        if ( ! icon.classList.contains(className)) {
                            icon.classList.add(className);
                        }
                    }

                    for (const [key, value] of Object.entries(styleSet)) {
                        icon.style[key] = value;
                    }
                }
            });
        }
    },
    watch: {
        hover(value) {
            const children = this.$el.children;
            const styleSet = value ? this.hoverStyle : this.styleSets[children.length - 1][children.length - 1];
            const lastChild = children[children.length - 1];

            for (const [key, value] of Object.entries(styleSet)) {
                lastChild.style[key] = value;
            }
        }
    },
    mounted() {
        this.styleIcons();
    }
};
</script>
