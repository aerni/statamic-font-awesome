import FontAwesome from './FontAwesome.vue'

Statamic.booting(() => {
    Statamic.$components.register('font_awesome-fieldtype', FontAwesome);
});
