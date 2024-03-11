<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const props = defineProps({
    nextStep: {
        type: Function,
        default: () => {},
        required: false,
        validator: (value) => typeof value === 'function',
    },
    insuranceQuotes: {
        type: Array,
        required: true
    },
    formData: Object,
    errors: Object,
});

const form = useForm({
    selectedQuotes: []
})

const submitForm = () => {
    if (form.selectedQuotes.length < 1) {
        form.setError({
            selectedQuotes: 'You must select at least one insurance quote',
        });

        return;
    }

    props.formData.value = {...props.formData.value, ...form.data()};

    props.nextStep();
}

const setQuotes = (quoteId) => {
    // Find the index of the quote with the given ID
    const index = props.insuranceQuotes.findIndex(quote => quote.id === quoteId);

    // Toggle the selection state of the quote
    props.insuranceQuotes[index].selected = !props.insuranceQuotes[index].selected;

    // Filter the selected quotes
    const selectedQuotes = props.insuranceQuotes.filter(quote => quote.selected);

    // Extract IDs of selected quotes
    form.selectedQuotes = selectedQuotes.map(quote => quote.id)
};

const isSelected = quoteId => {
    const quote = props.insuranceQuotes && props.insuranceQuotes.find(quote => quote.id === quoteId);
    return quote && quote.selected;
};
</script>

<template>
    <div class="min-h-screen flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-4 bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="flex-1 text-center hidden lg:flex">
                <div
                    class="w-full bg-center bg-no-repeat bg-cover"
                    style="background-image: url('/images/fencing.png');"
                ></div>
            </div>
            <div class="lg:w-1/2 xl:w-6/12 p-6 sm:p-12">
                <div class="mt-12 px-6">
                    <h1 class="text-2xl font-extrabold">
                        Let's get started
                    </h1>
                    <p class="text-gray-400 text-sm">
                        Please select one or more option below that you'd like to have quoted for insurance
                    </p>

                    <form @submit.prevent="submitForm" class="my-5">
                        <InputError class="my-2" :message="form.errors.selectedQuotes" />
                        <div
                            @click="setQuotes(quote.id)"
                            v-for="quote in insuranceQuotes" :key="quote.id"
                            :class="{ 'border-blue-700': isSelected(quote.id) }"
                            class="flex border rounded-md mb-4 cursor-pointer h-20 relative bg-center bg-no-repeat bg-cover text-white bg-gradient-to-r from-gray-800 to-gray-200"
                        >
                            <div class="flex pl-2 items-center gap-x-3">
                                <div class="bg-blue-100 p-3 rounded">
                                    <fa :icon="quote.icon" class="text-blue-600" />
                                </div>

                                <div>
                                    <p class="font-bold">{{ quote.name }}</p>
                                    <p class="text-sm">
                                        {{ quote.sub_title }}
                                    </p>
                                </div>
                            </div>

                            <div class="bg-blue-600 absolute right-0 top-0 rounded-r-md px-2">
                                <fa icon="check" style="color: white" />
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-end mt-4">
                            <PrimaryButton type="submit" class="w-full bg-blue-600 mb-5">
                                Agree and Continue
                            </PrimaryButton>
                        </div>
                        <p class="text-sm text-gray-400">
                            By continuing this form you agree to share data with Franke Insurance Services as defined
                            in the Terms of Use and Privacy Policy.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
