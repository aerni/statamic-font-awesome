<template>
    <Combobox
        clearable
        :class="{ 'invisible': !store.icons }"
        :read-only="isReadOnly"
        :options="visibleIcons"
        :placeholder="'Type to search …'"
        :ignore-filter="true"
        :model-value="store.icons ? value : null"
        option-value="class"
        @update:model-value="update"
        @search="search"
    >
        <template #option="icon">
            <div class="flex items-center gap-4">
                <i class="w-5 h-5" :class="icon.class" />
                <span class="text-xs truncate">{{ icon.label }}</span>
            </div>
        </template>

        <template #selected-option="{ option: icon }">
            <div class="flex items-center gap-4">
                <i class="w-5 h-5" :class="icon.class" />
                <span class="text-xs truncate">{{ icon.label }}</span>
            </div>
        </template>
    </Combobox>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import { Fieldtype } from '@statamic/cms';
import { Combobox } from '@statamic/cms/ui';
import { useFontAwesomeStore } from './store';

const emit = defineEmits([...Fieldtype.emits, 'focus', 'blur']);
const props = defineProps(Fieldtype.props);
const { expose, update, isReadOnly } = Fieldtype.use(emit, props);

defineExpose(expose);

const store = useFontAwesomeStore();

const query = ref('');
const limit = ref(50);
let viewport = null;
let observer = null;

const icons = computed(() => {
    if (!store.icons) return [];

    const iconsByStyle = store.icons.filter((icon) => props.meta.styles.includes(icon.style));

    if (query.value.length > 0) {
        return iconsByStyle.filter((icon) => icon.label.toLowerCase().includes(query.value.toLowerCase()));
    }

    return iconsByStyle;
});

const visibleIcons = computed(() => icons.value.slice(0, limit.value));

const fontAwesomeIsLoaded = computed(() => {
    const elements = props.meta.script
        ? Array.from(document.getElementsByTagName("script"))
            .filter(script => script.src === props.meta.script)
        : Array.from(document.getElementsByTagName("link"))
            .filter(link => link.href === props.meta.css);
    return elements.length > 0;
});

function search(value) {
    query.value = value;
    limit.value = 50;
}

function handleScroll() {
    const { scrollTop, scrollHeight, clientHeight } = viewport;
    const nearBottom = scrollTop + clientHeight >= scrollHeight - 100;
    const hasMore = limit.value < icons.value.length;

    if (nearBottom && hasMore) limit.value += 50;
}

function findViewport(node) {
    if (node.nodeType !== 1) return null;

    return node.matches('[data-reka-combobox-viewport]')
        ? node
        : node.querySelector('[data-reka-combobox-viewport]');
}

function onViewportAdded(node) {
    viewport = findViewport(node);
    if (!viewport) return;
    viewport.addEventListener('scroll', handleScroll, { passive: true });
}

function onViewportRemoved(node) {
    if (!findViewport(node)) return;
    viewport.removeEventListener('scroll', handleScroll);
    viewport = null;
    limit.value = 50;
}

function setupObserver() {
    observer = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
            for (const node of mutation.addedNodes) {
                if (!viewport) onViewportAdded(node);
            }
            for (const node of mutation.removedNodes) {
                if (viewport) onViewportRemoved(node);
            }
        }
    });
    observer.observe(document.body, { childList: true, subtree: true });
}

function loadFontAwesome() {
    if (fontAwesomeIsLoaded.value) return;

    const el = props.meta.script
        ? Object.assign(document.createElement('script'), { src: props.meta.script })
        : Object.assign(document.createElement('link'), { rel: 'stylesheet', href: props.meta.css });

    document.head.appendChild(el);
}

onMounted(() => {
    store.fetchIcons(props.meta.url);
    loadFontAwesome();
    setupObserver();
});

onUnmounted(() => {
    observer.disconnect();
    if (viewport) {
        viewport.removeEventListener('scroll', handleScroll);
    }
});
</script>
