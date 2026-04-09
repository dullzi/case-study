<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block font-bold text-[0.8rem] text-gray-700 dark:text-gray-400 uppercase tracking-widest mb-1">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
