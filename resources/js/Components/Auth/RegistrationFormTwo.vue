<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";

const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    contact_preference: ''
});

const props = defineProps({
    nextStep: {
        type: Function,
        default: () => {
        },
        required: false,
    },
    previousStep: {
        type: Function,
        default: () => {
        },
        required: false,
    },
    formData: Object,
    errors: Object,
});

const submitForm = () => {
    props.formData.value = {...props.formData.value, ...form.data()};

    props.nextStep();
}
</script>

<template>
    <div class="min-h-screen flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-4 bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="flex-1 text-center hidden lg:flex">
                <div class="w-full bg-center bg-no-repeat bg-cover"
                     style="background-image: url('/images/register.png');">
                </div>
            </div>
            <div class="lg:w-1/2 xl:w-6/12 p-6 sm:p-12">
                <div class="mt-12 px-6">
                    <h1 class="text-2xl font-extrabold">
                        Personal Information
                    </h1>
                    <p class="text-gray-400">
                        Ok, Great! Before we continue, please let us know how we can contact you regarding you quote
                    </p>

                    <form @submit.prevent="submitForm" class="my-5">
                        <div class="flex flex-wrap justify-between mb-5">
                            <div class="w-full sm:w-auto sm:flex-1 sm:mr-4">
                                <InputLabel for="first_name" value="First Name" is-required />

                                <TextInput
                                    id="first_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.first_name"
                                    placeholder="Enter First Name"
                                    required
                                    autofocus
                                    autocomplete="given-name"
                                />
                                <InputError class="mt-2" :message="form.errors.first_name"/>
                            </div>

                            <div class="w-full sm:w-auto sm:flex-1 sm:ml-4 mt-4 sm:mt-0">
                                <InputLabel for="last_name" value="Last Name" is-required />

                                <TextInput
                                    id="last_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.last_name"
                                    placeholder="Enter Last Name"
                                    required
                                    autocomplete="family-name"
                                />
                                <InputError class="mt-2" :message="form.errors.last_name"/>
                            </div>
                        </div>

                        <div class="w-full sm:w-auto sm:flex-1 mb-5">
                            <InputLabel for="first_name" value="Email" is-required />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                placeholder="Enter Email Address"
                                required
                                autofocus
                                autocomplete="given-name"
                            />

                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="w-full sm:w-auto sm:flex-1 mb-5">
                            <InputLabel for="phone" value="Phone No" is-required />

                            <TextInput
                                id="phone"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                                placeholder="Enter Phone No"
                                required
                                autofocus
                                autocomplete="given-name"
                            />

                            <InputError class="mt-2" :message="form.errors.phone"/>
                        </div>

                        <div class="w-full sm:w-auto sm:flex-1 mb-5">
                            <InputLabel for="first_name" value="Password" is-required />

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autofocus
                                autocomplete="given-name"
                            />

                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>

                        <div class="w-full sm:w-auto sm:flex-1 mb-5">
                            <InputLabel for="first_name" value="Confirm Password" is-required />

                            <TextInput
                                id="confirm_password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password_confirmation"
                                required
                                autofocus
                                autocomplete="given-name"
                            />

                            <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                        </div>

                        <div class="w-full sm:w-auto sm:flex-1 mb-5">
                            <InputLabel for="contact_preference" value="Contact Preference" is-required />

                            <SelectInput
                                :options="[
                                        {
                                            label: 'Email',
                                            value: 'email'
                                        },
                                        {
                                            label: 'Phone',
                                            value: 'phone'
                                        },
                                    ]"
                                v-model="form.contact_preference"
                                class="mt-1 block w-full"
                            />

                            <InputError class="mt-2" :message="form.errors.contact_preference"/>
                        </div>

                        <div class="flex flex-col items-center justify-end mt-4">
                            <PrimaryButton
                                class="w-full bg-blue-600 mb-5"
                                type="submit"
                            >
                                Continue
                            </PrimaryButton>

                            <button
                                @click="previousStep"
                                class="text-sm text-blue-600 font-bold rounded-md focus:outline-none"
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
