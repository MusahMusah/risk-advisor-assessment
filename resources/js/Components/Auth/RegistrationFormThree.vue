<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import {Link, useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

const form = useForm({
    submission: {
        address: '',
        apartment_no: '',
        city: '',
        state: '',
        zip_code: ''
    }
});

const props = defineProps({
    nextStep: {
        type: Function,
        default: () => {},
        required: false,
    },
    previousStep: {
        type: Function,
        default: () => {},
        required: false,
    },
    formData: Object,
    errors: Object,
});

const submitForm = () => {
    props.formData.value = {...props.formData.value, ...form.data()};

    form
        .transform(() => ({
            ...props.formData.value
        }))
        .post(route('register'), {
        onSuccess: () => {
            form.reset();
            props.formData.value = {}
        },
        onError: (e) => {
        }
    });
}
</script>

<template>
    <div class="min-h-screen flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-4 bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="flex-1 text-center hidden lg:flex">
                <div class="w-full bg-center bg-no-repeat bg-cover"
                     style="background-image: url('/images/fencing2.png');">
                </div>
            </div>
            <div class="lg:w-1/2 xl:w-6/12 p-6 sm:p-12">
                <div class="mt-12 px-6">
                    <h1 class="text-2xl font-extrabold">
                        Address Information
                    </h1>
                    <p class="text-gray-400 text-sm">
                        We can help with that! What is your address?
                    </p>

                    <form @submit.prevent="submitForm" class="my-5">
                        <div class="flex flex-wrap justify-between mb-5">
                            <div class="w-full sm:w-auto sm:flex-1 sm:mr-4">
                                <InputLabel for="address" value="Street Address" />

                                <TextInput
                                    id="address"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.submission.address"
                                    placeholder="Enter Street Address"
                                    autofocus
                                />
                            </div>

                            <div class="w-full sm:w-auto sm:flex-1 sm:ml-4 mt-4 sm:mt-0">
                                <InputLabel for="apartment_no" value="Ste/Apt" />

                                <TextInput
                                    id="apartment_no"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.submission.apartment_no"
                                    placeholder="Enter Apartment No"
                                    autocomplete="family-name"
                                />
                            </div>
                        </div>

                        <div class="w-full sm:w-auto sm:flex-1 mb-5">
                            <InputLabel for="city" value="City" is-required />

                            <TextInput
                                id="city"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.submission.city"
                                placeholder="Enter City"
                                required
                                autofocus
                                autocomplete="given-name"
                            />

                            <InputError class="mt-2" :message="form.errors.submission?.city" />
                        </div>

                        <div class="w-full sm:w-auto sm:flex-1 mb-5">
                            <InputLabel for="contact_preference" value="State" is-required />

                            <SelectInput
                                :options="[
                                        {
                                            label: 'TX',
                                            value: 'tx'
                                        },
                                    ]"
                                v-model="form.submission.state"
                                class="mt-1 block w-full"
                            />

                            <InputError class="mt-2" :message="form.errors.submission?.state" />
                        </div>

                        <div class="w-full sm:w-auto sm:flex-1 mb-5">
                            <InputLabel for="zip_code" value="Zip Code" is-required />

                            <TextInput
                                id="zip_code"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.submission.zip_code"
                                placeholder="Enter Zip Code"
                                required
                                autofocus
                            />

                            <InputError class="mt-2" :message="form.errors.submission?.zip_code" />
                        </div>

                        <div class="flex flex-col items-center justify-end mt-4">
                            <PrimaryButton
                                class="w-full bg-blue-600 mb-5"
                                type="submit"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Continue
                            </PrimaryButton>

                            <button
                                @click="previousStep"
                                class="text-sm text-blue-600 font-bold hover:text-gray-900 rounded-md focus:outline-none"
                            >
                                Back
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
