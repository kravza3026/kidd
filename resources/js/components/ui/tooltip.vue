<template>
    <div
        :class="[
            'absolute z-10 text-sm px-3 py-1 rounded-full transition-opacity duration-300 group-hover:opacity-100',
            positionClass,
            bgColorClass
        ]"
        :style="inlineStyle"
    >
        {{ title }}
        <div :class="arrowClass" :style="arrowStyle"></div>
    </div>
</template>

<script>
export default {
    name: 'Tooltip',
    props: {
        title: String,
        position: {
            type: String,
            default: 'top',
            validator: value => ['top', 'bottom', 'left', 'right'].includes(value)
        },
        color: {
            type: String,
            default: 'bg-black' // або "#ff0000"
        }
    },
    computed: {
        isTailwind() {
            return this.color.startsWith('bg-');
        },
        // Background class for the bubble
        bgColorClass() {
            return this.isTailwind ? this.color + ' text-white' : 'text-white';
        },
        // Inline background for the bubble
        inlineStyle() {
            return !this.isTailwind ? { backgroundColor: this.color } : {};
        },
        // Arrow inline style
        arrowStyle() {
            if (!this.isTailwind) {
                return this.getCustomArrowStyle();
            }
            return {};
        },
        // Main position class
        positionClass() {
            switch (this.position) {
                case 'top': return 'bottom-full left-1/2 -translate-x-1/2 mb-2';
                case 'bottom': return 'top-full left-1/2 -translate-x-1/2 mt-2';
                case 'left': return 'right-full top-1/2 -translate-y-1/2 mr-2';
                case 'right': return 'left-full top-1/2 -translate-y-1/2 ml-2';
                default: return '';
            }
        },
        // Arrow class (Tailwind only)
        arrowClass() {
            const base = 'absolute w-0 h-0';
            const borderColor = this.isTailwind ? this.getTailwindArrowBorderClass() : '';

            switch (this.position) {
                case 'top':
                    return `${base} top-full left-1/2 -translate-x-1/2
                        border-l-8 border-r-8 border-b-8
                        border-l-transparent border-r-transparent ${borderColor}`;
                case 'bottom':
                    return `${base} bottom-full left-1/2 -translate-x-1/2
                        border-l-8 border-r-8 border-t-8
                        border-l-transparent border-r-transparent ${borderColor}`;
                case 'left':
                    return `${base} right-0 top-1/2 -translate-y-1/2
                        border-t-8 border-b-8 border-r-8
                        border-t-transparent border-b-transparent ${borderColor}`;
                case 'right':
                    return `${base} left-0 top-1/2 -translate-y-1/2
                        border-t-8 border-b-8 border-l-8
                        border-t-transparent border-b-transparent ${borderColor}`;
                default:
                    return '';
            }
        }
    },
    methods: {
        getTailwindArrowBorderClass() {
            const color = this.color.replace('bg-', '');
            switch (this.position) {
                case 'top': return `border-b-${color}`;
                case 'bottom': return `border-t-${color}`;
                case 'left': return `border-r-${color}`;
                case 'right': return `border-l-${color}`;
                default: return '';
            }
        },
        getCustomArrowStyle() {
            const transparent = 'transparent';
            const color = this.color;

            switch (this.position) {
                case 'top':
                    return {
                        borderLeft: '8px solid red',
                        borderRight: '8px solid red',
                        borderBottom: `8px solid ${color}`
                    };
                case 'bottom':
                    return {
                        borderLeft: '8px solid transparent',
                        borderRight: '8px solid transparent',
                        borderTop: `8px solid ${color}`
                    };
                case 'left':
                    return {
                        borderTop: '8px solid transparent',
                        borderBottom: '8px solid transparent',
                        borderRight: `8px solid ${color}`
                    };
                case 'right':
                    return {
                        borderTop: '8px solid transparent',
                        borderBottom: '8px solid transparent',
                        borderLeft: `8px solid ${color}`
                    };
                default:
                    return {};
            }
        }
    }
};
</script>
