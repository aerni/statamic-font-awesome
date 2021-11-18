<template>
    <div :class="this.classes">
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
        classes() {
            return `font-awesome ${this.meta.license} version-${this.meta.version.charAt(0)}`
        },

        filtered() {
            return this.meta.icons.filter((icon) => icon.label.toLowerCase().includes(this.search.toLowerCase()))
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

<style scoped>

    /* This fixes an issue with Duotone icons being displayed wrong */
    .font-awesome {
        letter-spacing: initial;
    }

    .font-awesome.free.version-5 .fas,
    .font-awesome.free.version-5 .far {
        font-family: "Font Awesome 5 Free" !important;
    }

    .font-awesome.pro.version-5 .fas,
    .font-awesome.pro.version-5 .far,
    .font-awesome.pro.version-5 .fal {
        font-family: "Font Awesome 5 Pro" !important;
    }

    .font-awesome.version-5 .fad {
        font-family: "Font Awesome 5 Duotone" !important;
    }

    .font-awesome.version-5 .fab {
        font-family: "Font Awesome 5 Brands" !important;
    }

    .font-awesome.free.version-6 .fa-solid,
    .font-awesome.free.version-6 .fa-regular {
        font-family: "Font Awesome 6 Free" !important;
    }

    .font-awesome.pro.version-6 .fa-solid,
    .font-awesome.pro.version-6 .fa-regular,
    .font-awesome.pro.version-6 .fa-light,
    .font-awesome.pro.version-6 .fa-thin {
        font-family: "Font Awesome 6 Pro" !important;
    }

    .font-awesome.version-6 .fa-duotone {
        font-family: "Font Awesome 6 Duotone" !important;
    }

    .font-awesome.version-6 .fa-brands {
        font-family: "Font Awesome 6 Brands" !important;
    }

</style>
