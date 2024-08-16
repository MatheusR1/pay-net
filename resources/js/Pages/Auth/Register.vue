<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import axios from 'axios';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    cep: '',
    street: '',
    neighborhood: '',
    number: '',
    city: '',
    state: '',
});

// errors
let cepError = '';

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};

const fetchAddress = () => {
    const cep = form.cep.replace(/\D/g, '');

    if (cep.length === 8) {
        axios.get(`/getAdressInfo/${cep}`)
            .then(res => {
                const data = res.data;
                form.street = data.logradouro;
                form.neighborhood = data.bairro;
                form.city = data.localidade;
                form.state = data.uf;
                cepError = '';
            })
            .catch(err => {
                console.error(err);
                cepError = 'Erro ao buscar endereço. Verifique o CEP e tente novamente.';
            });
    } else {
        cepError = 'CEP inválido. Por favor, insira um CEP com 8 dígitos.';
    }
};

</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>


            <div class="mt-4">
                <InputLabel for="cep" value="CEP" />
                <TextInput id="cep" type="text" class="mt-1 block w-full" v-model="form.cep" @blur="fetchAddress" required />
                <InputError class="mt-2" :message="form.errors.cep" />
                <InputError class="mt-2" :message="cepError" />
            </div>

            <div class="mt-4">
                <InputLabel for="street" value="Rua" />
                <TextInput id="street" type="text" class="mt-1 block w-full" v-model="form.street" required />
                <InputError class="mt-2" :message="form.errors.street" />
            </div>

            <div class="mt-4">
                <InputLabel for="neighborhood" value="Bairro" />
                <TextInput id="neighborhood" type="text" class="mt-1 block w-full" v-model="form.neighborhood" required />
                <InputError class="mt-2" :message="form.errors.neighborhood" />
            </div>

            <div class="mt-4">
                <InputLabel for="number" value="Número" />
                <TextInput id="number" type="text" class="mt-1 block w-full" v-model="form.number" required />
                <InputError class="mt-2" :message="form.errors.number" />
            </div>

            <div class="mt-4">
                <InputLabel for="city" value="Cidade" />
                <TextInput id="city" type="text" class="mt-1 block w-full" v-model="form.city" required />
                <InputError class="mt-2" :message="form.errors.city" />
            </div>

            <div class="mt-4">
                <InputLabel for="state" value="Estado" />
                <TextInput id="state" type="text" class="mt-1 block w-full" v-model="form.state" required />
                <InputError class="mt-2" :message="form.errors.state" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Already registered?
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
