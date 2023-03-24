<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    customer: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    id: props?.customer?.id || null,
    name: props?.customer?.name || '',
    email: props?.customer?.email || '',
    phone: props?.customer?.phone || '',
    address_name: props?.customer?.address_name || '',
    address_street: props?.customer?.address_street || '',
    address_zip: props?.customer?.address_zip || '',
    address_city: props?.customer?.address_city || '',
    address_country: props?.customer?.address_country || '',
});

const submit = () => {
    form.patch(route('customers.update', form.id), {
        // onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Edit Customer" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Customer</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
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

                        <div>
                            <InputLabel for="email" value="Email" />

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="email"
                            />

                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="phone" value="Phone" />

                            <TextInput
                                id="phone"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.phone"
                                required
                                autocomplete="phone"
                            />

                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>

                        <hr>

                        <div>
                            <InputLabel for="address_name" value="Address Name" />

                            <TextInput
                                id="address_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.address_name"
                                required
                                autocomplete="address_name"
                            />

                            <InputError class="mt-2" :message="form.errors.address_name" />
                        </div>

                        <div>
                            <InputLabel for="address_street" value="Address Street" />

                            <TextInput
                                id="address_street"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.address_street"
                                required
                                autocomplete="address_street"
                            />

                            <InputError class="mt-2" :message="form.errors.address_street" />
                        </div>

                        <div>
                            <InputLabel for="address_zip" value="Address ZIP" />

                            <TextInput
                                id="address_zip"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.address_zip"
                                required
                                autocomplete="address_zip"
                            />

                            <InputError class="mt-2" :message="form.errors.address_zip" />
                        </div>

                        <div>
                            <InputLabel for="address_city" value="Address City" />

                            <TextInput
                                id="address_city"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.address_city"
                                required
                                autocomplete="address_city"
                            />

                            <InputError class="mt-2" :message="form.errors.address_city" />
                        </div>

                        <div>
                            <InputLabel for="address_country" value="Address Country" />

                            <TextInput
                                id="address_country"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.address_country"
                                required
                                autocomplete="address_country"
                            />

                            <InputError class="mt-2" :message="form.errors.address_country" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
