<template>
    <div class="flex flex-col w-full mb-4">
        <!-- Label -->
        <label v-if="label" :for="id" class="mb-1 font-medium text-gray-700">{{ label }}</label>

        <!-- Input wrapper pour icon + input -->
        <div v-if="type !== 'select' && type !== 'file'" class="relative w-full">
            <!-- Icon gauche -->
            <span v-if="iconLeft" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
        <i class="material-icons">{{ iconLeft }}</i>
      </span>

            <!-- Input standard -->
            <input
                :id="id"
                v-model="internalValue"
                :type="type"
                :placeholder="placeholder"
                :disabled="disabled || loading"
                :readonly="readonly"
                :required="required"
                :min="min"
                :max="max"
                :step="step"
                :maxlength="maxlength"
                :minlength="minlength"
                :autocomplete="autocomplete"
                :class="inputClasses"
                @input="$emit('update:modelValue', internalValue)"
                @focus="$emit('focus', $event)"
                @blur="$emit('blur', $event)"
                @keydown="$emit('keydown', $event)"
                @change="$emit('change', $event)"
            />

            <!-- Icon droite ou loader -->
            <span v-if="iconRight && !loading" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
        <i class="material-icons">{{ iconRight }}</i>
      </span>
            <LoaderCircle v-if="loading" class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 animate-spin text-gray-400" />
        </div>

        <!-- Select -->
        <select
            v-if="type === 'select'"
            :class="selectClasses"
            :value="internalValue"
            @change="onSelectChange"
        >
            <option disabled value="">{{ placeholder }}</option>
            <option v-for="option in options" :key="option.id" :value="option.id">
                {{ option.label }}
            </option>
        </select>

        <!-- File input -->
        <input
            v-if="type === 'file'"
            type="file"
            @change="onFileChange"
            :class="fileClasses"
        />

        <!-- Message d’erreur -->
        <p v-if="errorMessage" class="mt-1 text-red-500 text-sm">{{ errorMessage }}</p>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, watch, defineProps, withDefaults } from 'vue';
import { LoaderCircle } from 'lucide-vue-next';
import {Option} from "@/types/option";

type InputType = 'text' | 'email' | 'password' | 'number' | 'file' | 'date' | 'url' | 'tel' | 'search' | 'textarea' | 'select';

interface Props {
    modelValue?: string | number | File | null;
    type?: InputType;
    label?: string;
    placeholder?: string;
    disabled?: boolean;
    readonly?: boolean;
    required?: boolean;
    errorMessage?: string;
    iconLeft?: string;
    iconRight?: string;
    loading?: boolean;
    autocomplete?: string;
    id?: string;
    min?: number;
    max?: number;
    step?: number;
    minlength?: number;
    maxlength?: number;
    inputClass?: string;
    options?: Option[];
}

const props = withDefaults(defineProps<Props>(), {
    type: 'text',
    disabled: false,
    readonly: false,
    required: false,
    loading: false,
    autocomplete: 'off',
    inputClass: '',
    id: '',
});

const emit = defineEmits<{
    (e: 'update:modelValue', value: string | number | File | null): void
}>();

// Gestion de v-model
const internalValue = ref(props.modelValue ?? '');
watch(() => props.modelValue, val => (internalValue.value = val));

// Classes dynamiques Tailwind
const inputClasses = computed(() => {
    const base =
        'w-full bg-white rounded-xl border px-3 py-2 text-gray-900 transition focus:outline-none focus:ring-2 focus:ring-primary disabled:opacity-50 disabled:cursor-not-allowed';
    const error = props.errorMessage ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-primary';
    const paddingLeft = props.iconLeft ? 'pl-10' : '';
    const paddingRight = props.iconRight || props.loading ? 'pr-10' : '';
    return `${base} ${error} ${paddingLeft} ${paddingRight} ${props.inputClass}`;
});

const selectClasses = 'w-full border rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary bg-white';
const fileClasses = 'w-full bg-white';

function onFileChange(event: Event) {
    const files = (event.target as HTMLInputElement).files;
    if (files && files.length > 0) {
        internalValue.value = files[0];
        emit('update:modelValue', files[0]);
    }
}
function onSelectChange(event: Event) {
    const value = (event.target as HTMLSelectElement).value;
    internalValue.value = value;
    emit('update:modelValue', value);
}

</script>
