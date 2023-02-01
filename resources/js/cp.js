import './store'
import FontAwesome from './FontAwesome.vue'

Statamic.$components.register('font_awesome-fieldtype', FontAwesome)

Statamic.booted(() => {
    Statamic.$store.dispatch("publish/fontAwesome/fetchIcons")
})
