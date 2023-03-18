<template>
    <Link :class="{ 'font-bold text-underline': active }">
    <slot></slot>
    </Link>
</template>

<script setup>
const props = defineProps({
    active: Boolean
});
</script>

