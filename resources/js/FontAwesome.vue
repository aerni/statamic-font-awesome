<template>
    <div v-if="icons">
        <v-select
            ref="input"
            :name="name"
            :disabled="isReadOnly"
            :options="paginated"
            :filterable="false"
            :value="value"
            @input="update"
            @open="onOpen"
            @close="onClose"
            @search="(query) => (search = query)"
        >
            <template #option="icon">
                <i class="inline-block w-4 mr-sm" :class="icon.class" />
                <span v-text="icon.label" />
            </template>

            <template #selected-option="icon">
                <i class="inline-block w-4 mr-sm" :class="icon.class" />
                <span v-text="icon.label" />
            </template>

            <template #list-footer>
                <span v-show="hasNextPage" ref="load" />
            </template>
        </v-select>
    </div>
</template>

<script>
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
    },

    methods: {
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
    },
}
</script>
