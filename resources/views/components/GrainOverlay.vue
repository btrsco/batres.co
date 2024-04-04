<template>
    <div
        ref="element"
        id="grain-overlay"
        class="fixed inset-0 w-full h-full z-[100] overflow-hidden pointer-events-none mix-blend-overlay">
    </div>
</template>

<script>
import Animate from '@/views/components/Animate';

export default {
    name: 'GrainOverlay',
    components: { Animate },
    props: {
        options: {
            type: Object,
            default: () => ({
                animate: true,
                patternWidth: 500,
                patternHeight: 500,
                grainOpacity: 0.25,
                grainDensity: 1,
                grainWidth: 1,
                grainHeight: 1,
                grainChaos: 1,
                grainSpeed: 20
            })
        }
    },
    data() {
        return {
            elementId: null
        };
    },
    mounted() {
        this.elementId = this.$refs.element.id;
        this.applyGrain();
    },
    methods: {
        applyGrain() {
            const element = this.$refs.element;
            const prefixes = ["", "-moz-", "-o-animation-", "-webkit-", "-ms-"];

            // Generate noise function
            const generateNoise = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = this.options.patternWidth;
                canvas.height = this.options.patternHeight;
                for (let w = 0; w < this.options.patternWidth; w += this.options.grainDensity) {
                    for (let h = 0; h < this.options.patternHeight; h += this.options.grainDensity) {
                        const rgb = Math.random() * 256 | 0;
                        ctx.fillStyle = `rgba(${rgb}, ${rgb}, ${rgb}, ${this.options.grainOpacity})`;
                        ctx.fillRect(w, h, this.options.grainWidth, this.options.grainHeight);
                    }
                }
                return canvas.toDataURL('image/png');
            };

            // Add CSS rule function
            const addCSSRule = (sheet, selector, rules, index) => {
                let ins = '';
                if (selector.length) {
                    ins = `${selector} {${rules}}`;
                } else {
                    ins = rules;
                }
                if ("insertRule" in sheet) {
                    sheet.insertRule(ins, index);
                } else if ("addRule" in sheet) {
                    sheet.addRule(selector, rules, index);
                }
            };

            // Generate noise
            const noise = generateNoise();

            // Generate animation
            let animation = '';
            const keyFrames = ['0%:-10%,10%', '10%:-25%,0%', '20%:-30%,10%', '30%:-30%,30%', '40%::-20%,20%', '50%:-15%,10%', '60%:-20%,20%', '70%:-5%,20%', '80%:-25%,5%', '90%:-30%,25%', '100%:-10%,10%'];
            let pre = prefixes.length;
            while (pre--) {
                animation += `@${prefixes[pre]}keyframes grained{`;
                for (let key = 0; key < keyFrames.length; key++) {
                    const keyVal = keyFrames[key].split(':');
                    animation += `${keyVal[0]}{`;
                    animation += `${prefixes[pre]}transform:translate(${keyVal[1]});`;
                    animation += '}';
                }
                animation += '}';
            }

            // Add animation keyframe
            let animationAdded = document.getElementById('grained-animation');
            if (animationAdded) {
                animationAdded.parentElement.removeChild(animationAdded);
            }
            let style = document.createElement("style");
            style.type = "text/css";
            style.id = 'grained-animation';
            style.innerHTML = animation;
            document.body.appendChild(style);

            // Add customized style
            let styleAdded = document.getElementById(`grained-animation-${this.elementId}`);
            if (styleAdded) {
                styleAdded.parentElement.removeChild(styleAdded);
            }

            style = document.createElement("style");
            style.type = "text/css";
            style.id = `grained-animation-${this.elementId}`;
            document.body.appendChild(style);

            let rule = `background-image: url(${noise});`;
            rule += 'position: absolute; content: ""; height: 300%; width: 300%; left: -100%; top: -100%;';
            pre = prefixes.length;
            if (this.options.animate) {
                while (pre--) {
                    rule += `${prefixes[pre]}animation-name:grained;`;
                    rule += `${prefixes[pre]}animation-iteration-count: infinite;`;
                    rule += `${prefixes[pre]}animation-duration: ${this.options.grainChaos}s;`;
                    rule += `${prefixes[pre]}animation-timing-function: steps(${this.options.grainSpeed}, end);`;
                }
            }

            // Selector element to add grains
            const selectorElement = `#${this.elementId}::before`;

            addCSSRule(style.sheet, selectorElement, rule);
        }
    }
};
</script>
