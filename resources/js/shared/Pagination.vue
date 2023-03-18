<template>
    <div>
        <component :class="{ 'text-gray-500': !link.url, 'font-bold': link.active }" class="px-1" v-for="link in links"
            :is="!link.url ? 'span' : 'Link'" :href="link.url" v-html="link.label">
        </component>
    </div>
</template>

<script setup>
const props = defineProps({
    links: Array
});
</script>