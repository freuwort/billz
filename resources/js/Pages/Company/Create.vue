<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: '',
    email: '',
    phone: '',
    tax_id: '',
    office: '',
    bank_name: '',
    bank_account_holder: '',
    bank_iban: '',
    bank_bic: '',
    address_name: '',
    address_street: '',
    address_zip: '',
    address_city: '',
    address_country: '',
});

const submit = () => {
    form.post(route('companies.store'), {
        // onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Create Company" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Company</h2>
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
                            <InputLabel for="description" value="Description" />

                            <TextInput
                                id="description"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                autocomplete="description"
                            />

                            <InputError class="mt-2" :message="form.errors.description" />
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
                                autocomplete="phone"
                            />

                            <InputError class="mt-2" :message="form.errors.phone" />
                        </div>

                        <hr>

                        <div>
                            <InputLabel for="tax_id" value="Tax ID" />

                            <TextInput
                                id="tax_id"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.tax_id"
                                autocomplete="tax_id"
                            />

                            <InputError class="mt-2" :message="form.errors.tax_id" />
                        </div>

                        <div>
                            <InputLabel for="office" value="Tax Office" />

                            <TextInput
                                id="office"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.office"
                                autocomplete="office"
                            />

                            <InputError class="mt-2" :message="form.errors.office" />
                        </div>

                        <hr>

                        <div>
                            <InputLabel for="bank_name" value="Bank Name" />

                            <TextInput
                                id="bank_name"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.bank_name"
                                required
                                autocomplete="bank_name"
                            />

                            <InputError class="mt-2" :message="form.errors.bank_name" />
                        </div>

                        <div>
                            <InputLabel for="bank_account_holder" value="Bank Account Holder" />

                            <TextInput
                                id="bank_account_holder"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.bank_account_holder"
                                required
                                autocomplete="bank_account_holder"
                            />

                            <InputError class="mt-2" :message="form.errors.bank_account_holder" />
                        </div>

                        <div>
                            <InputLabel for="bank_iban" value="Bank IBAN" />

                            <TextInput
                                id="bank_iban"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.bank_iban"
                                required
                                autocomplete="bank_iban"
                            />

                            <InputError class="mt-2" :message="form.errors.bank_iban" />
                        </div>

                        <div>
                            <InputLabel for="bank_bic" value="Bank BIC" />

                            <TextInput
                                id="bank_bic"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.bank_bic"
                                required
                                autocomplete="bank_bic"
                            />

                            <InputError class="mt-2" :message="form.errors.bank_bic" />
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
                            <PrimaryButton :disabled="form.processing">Create</PrimaryButton>

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
