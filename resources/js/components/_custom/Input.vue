<template>
    <div class="flex flex-col mb-4">
        <label v-if="label" class="mb-1 font-medium">{{ label }}</label>

        <!-- Input standard -->
        <input
            v-if="type !== 'select' && type !== 'file'"
            :type="type"
            :placeholder="placeholder"
            v-model="modelValue"
            :class="[
        'border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary',
        type === 'number' ? 'no-number-spin' : '',
        'bg-white'
      ]"
        />

        <!-- Select -->
        <select
            v-if="type === 'select'"
            v-model="modelValue"
            :class="'border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary bg-white'"
        >
            <option disabled value="">{{ placeholder }}</option>
            <slot></slot>
        </select>

        <!-- File input -->
        <input
            v-if="type === 'file'"
            type="file"
            @change="onFileChange"
            :class="'bg-white'"
        />
    </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, ref } from 'vue';

const props = defineProps({
    label: String,
    type: { type: String, default: 'text' },
    placeholder: String,
    modelValue: [String, Number, File, null],
});

const emit = defineEmits(['update:modelValue']);

const modelValue = ref(props.modelValue);

function onFileChange(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (files && files.length > 0) {
        emit('update:modelValue', files[0]);
    }
}

modelValue.value = props.modelValue;
</script>
