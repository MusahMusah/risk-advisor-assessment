<script setup>
import { ref, computed } from 'vue';
import RegistrationFormOne from "@/Components/Auth/RegistrationFormOne.vue";
import RegistrationFormTwo from "@/Components/Auth/RegistrationFormTwo.vue";
import RegistrationFormThree from "@/Components/Auth/RegistrationFormThree.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    insuranceQuotes: {
        type: Array,
        required: true
    }
});

const steps = [
    { component: RegistrationFormOne },
    { component: RegistrationFormTwo },
    { component: RegistrationFormThree }
];

const currentStep = ref(0);
const currentStepComponent = computed(() => steps[currentStep.value].component);
const formData = ref({})

const nextStep = () => {
    if (currentStep.value < steps.length - 1) {
        currentStep.value++;
    }
}

const previousStep = () => {
    if (currentStep.value > 0) {
        currentStep.value--;
    }
}

</script>

<template>
    <div>
        <component
            :is="currentStepComponent"
            :formData="formData"
            :nextStep="nextStep"
            :insuranceQuotes="insuranceQuotes"
            :previousStep="previousStep"
        />
    </div>
</template>
