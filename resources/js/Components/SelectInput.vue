<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:value']);

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
});

const proxyValue = computed({
    get() {
        return props.value;
    },

    set(val) {
        emit('update:value', val);
    },
});
</script>

<template>
    <select v-model="proxyValue" class="rounded border-gray-300 p-3 text-black shadow-sm focus:ring-indigo-500">
        <option disabled>Choose an option</option>
        <option v-for="option in options" :key="option.value" :value="option.value">{{ option.label }}</option>
    </select>
</template>
