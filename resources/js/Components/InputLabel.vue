<script setup>
defineProps({
    value: {
        type: String,
    },
    isRequired: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">
        <span v-if="value">{{ value }}  <span v-if="isRequired">*</span></span>
        <span v-else><slot /></span>
    </label>
</template>
