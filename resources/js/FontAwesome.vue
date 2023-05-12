<template>
    <div class="flex icon-fieldtype-wrapper" v-if="icons">
        <v-select
            ref="input"
            class="w-full"
            append-to-body
            :calculate-position="positionOptions"
            clearable
            :name="name"
            :disabled="config.disabled || isReadOnly"
            :options="paginated"
            :placeholder="config.placeholder || 'Search ...'"
            :searchable="true"
            :multiple="false"
            :close-on-select="true"
            :value="selectedOption"
            @open="onOpen"
            @close="onClose"
            @input="vueSelectUpdated"
            @search="(query) => (search = query)"
            @search:focus="$emit('focus')"
            @search:blur="$emit('blur')"
        >
            <template slot="option" slot-scope="icon">
                <div class="flex items-center">
                    <i class="flex items-center w-5 h-5" :class="icon.class" />
                    <span class="ml-4 text-xs text-gray-800 truncate">{{ icon.label }}</span>
                </div>
            </template>

            <template slot="selected-option" slot-scope="icon">
                <div class="flex items-center">
                    <i class="flex items-center w-5 h-5" :class="icon.class" />
                    <span class="ml-4 text-xs text-gray-800 truncate">{{ icon.label }}</span>
                </div>
            </template>

            <template slot="list-footer">
                <span v-show="hasNextPage" ref="load" />
            </template>
        </v-select>
    </div>
</template>

<script>
import { computePosition, offset } from '@floating-ui/dom';

export default {
    mixins: [Fieldtype],

    data() {
        return {
            observer: new IntersectionObserver(this.infiniteScroll),
            limit: 20,
            search: '',
        }
    },

    computed: {
        icons() {
            return this.$store.state.publish.fontAwesome.icons
        },

        filtered() {
            return this.icons
                .filter((icon) => icon.label.toLowerCase().includes(this.search.toLowerCase()))
                .filter((icon) => this.meta.styles.includes(icon.style))
        },

        paginated() {
            return this.filtered.slice(0, this.limit)
        },

        hasNextPage() {
            return this.paginated.length < this.filtered.length
        },

        selectedOption() {
            return this.icons.find(icon => icon.class === this.value);
        }
    },

    methods: {
        focus() {
            this.$refs.input.focus();
        },

        vueSelectUpdated(value) {
            if (value) {
                this.update(value.class)
            } else {
                this.update(null);
            }
        },

        async onOpen() {
            if (this.hasNextPage) {
                await this.$nextTick()
                this.observer.observe(this.$refs.load)
            }
        },

        onClose() {
            this.observer.disconnect()
        },

        async infiniteScroll([{ isIntersecting, target }]) {
            if (isIntersecting) {
                const ul = target.offsetParent
                const scrollTop = target.offsetParent.scrollTop
                this.limit += 20
                await this.$nextTick()
                ul.scrollTop = scrollTop
            }
        },

        positionOptions(dropdownList, component, { width }) {
            dropdownList.style.width = width

            computePosition(component.$refs.toggle, dropdownList, {
                placement: 'bottom',
                middleware: [
                    offset({ mainAxis: 0, crossAxis: -1 }),
                ]
            }).then(({ x, y }) => {
                Object.assign(dropdownList.style, {
                    // Round to avoid blurry text
                    left: `${Math.round(x)}px`,
                    top: `${Math.round(y)}px`,
                });
            });
        },
    },
}
</script>
