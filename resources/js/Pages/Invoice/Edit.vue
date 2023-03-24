<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { formatPrice } from '@/currency';

const props = defineProps({
    companies: Array,
    customers: Array,
    invoice: Object,
});

const form = useForm({
    id: props?.invoice?.id ?? null,
    number: props?.invoice?.number ?? '',
    date: props?.invoice?.date ? props?.invoice?.date.substr(0, 10) : '',
    status: props?.invoice?.status ?? 'draft',
    company_id: props?.invoice?.company_id ?? '',
    customer_id: props?.invoice?.customer_id ?? '',
    timespan_start: props?.invoice?.timespan_start ? props?.invoice?.timespan_start.substr(0, 10) : '',
    timespan_end: props?.invoice?.timespan_end ? props?.invoice?.timespan_end.substr(0, 10) : '',
    footnote: props?.invoice?.footnote ?? '',
    items: props?.invoice?.items ?? [],
});



const setToday = () => {
    let date = new Date().toISOString().substr(0, 10);
    form.date = date;
    form.timespan_start = date;
    form.timespan_end = date;
};



const addItem = () => {
    form.items.push({
        id: null,
        description: '',
        quantity: 1,
        price: 0,
    });
};

const removeItem = (index) => {
    form.items.splice(index, 1);
};



const total = computed(() => {
    let total = 0;
    form.items.forEach((item) => {
        total += item.quantity * item.price;
    });
    return total;
});



const submit = () => {
    form.patch(route('invoices.update', form.id), {
        // onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Head title="Edit Invoice" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Invoice</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div class="flex gap-6 items-center">
                            <div class="flex-1">
                                <InputLabel for="company_id" value="Company" />
    
                                <select
                                    id="company_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.company_id"
                                    required
                                    autofocus
                                    autocomplete="company_id"
                                >
                                    <option value="" disabled>Select Company</option>
                                    <option v-for="company in companies" :value="company.id">{{ company.name }}</option>
                                </select>
    
                                <InputError class="mt-2" :message="form.errors.company_id" />
                            </div>
    
                            <div class="flex-1">
                                <InputLabel for="customer_id" value="Customer" />
    
                                <select
                                    id="customer_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.customer_id"
                                    required
                                    autocomplete="customer_id"
                                >
                                    <option value="" disabled>Select Customer</option>
                                    <option v-for="customer in customers" :value="customer.id">{{ customer.name }}</option>
                                </select>
    
                                <InputError class="mt-2" :message="form.errors.customer_id" />
                            </div>
                        </div>

                        <div class="!mt-14 border-t border-gray-200 pb-8"></div>

                        <PrimaryButton type="button" @click="setToday()">Date Today</PrimaryButton>

                        <div>
                            <InputLabel for="date" value="Date" />

                            <TextInput
                                id="date"
                                type="date"
                                class="mt-1 block w-full"
                                v-model="form.date"
                                required
                                autocomplete="date"
                            />

                            <InputError class="mt-2" :message="form.errors.date" />
                        </div>

                        <div class="flex gap-6 items-center">
                            <div class="flex-1">
                                <InputLabel for="timespan_start" value="Timespan Start" />
    
                                <TextInput
                                    id="timespan_start"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.timespan_start"
                                    required
                                    autocomplete="timespan_start"
                                />
    
                                <InputError class="mt-2" :message="form.errors.timespan_start" />
                            </div>

                            <span>bis</span>
    
                            <div class="flex-1">
                                <InputLabel for="timespan_end" value="Timespan End" />
    
                                <TextInput
                                    id="timespan_end"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.timespan_end"
                                    required
                                    autocomplete="timespan_end"
                                />
    
                                <InputError class="mt-2" :message="form.errors.timespan_end" />
                            </div>
                        </div>

                        <div>
                            <InputLabel for="number" value="Invoice Number" />

                            <TextInput
                                id="number"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.number"
                                required
                                autocomplete="invoice_number"
                            />

                            <InputError class="mt-2" :message="form.errors.number" />
                        </div>

                        <div class="!mt-14 border-t border-gray-200 pb-8"></div>

                        <PrimaryButton type="button" @click="addItem()">Add Item</PrimaryButton>

                        <div class="flex gap-6 items-center" v-for="(item, index) in form.items">
                            <div class="flex-[3_3_0%]">
                                <InputLabel for="description" value="Description" />

                                <TextInput
                                    id="description"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="item.description"
                                    required
                                    autocomplete="description"
                                />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="quantity" value="Quantity" />

                                <TextInput
                                    id="quantity"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="item.quantity"
                                    required
                                    autocomplete="quantity"
                                />
                            </div>

                            <div class="flex-1">
                                <InputLabel for="price" value="Price" />

                                <TextInput
                                    id="price"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="item.price"
                                    required
                                    autocomplete="price"
                                />
                            </div>

                            <PrimaryButton type="button" @click="removeItem(index)">Remove</PrimaryButton>
                        </div>

                        <div>
                            Total: {{ formatPrice(total) }}
                        </div>

                        <div class="!mt-14 border-t border-gray-200 pb-8"></div>

                        <div>
                            <InputLabel for="footnote" value="Footnote" />

                            <textarea
                                id="footnote"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                v-model="form.footnote"
                                autocomplete="footnote"
                            ></textarea>

                            <InputError class="mt-2" :message="form.errors.footnote" />
                        </div>

                        <div class="!mt-14 border-t border-gray-200 pb-8"></div>

                        <div>
                            <InputLabel for="status" value="Status" />

                            <select
                                id="status"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                v-model="form.status"
                                required
                                autocomplete="status"
                            >
                                <option value="" disabled>Select Status</option>
                                <option value="draft">Draft</option>
                                <option value="pending">Pending</option>
                                <option value="paid">Paid</option>
                                <option value="cancelled">Cancelled</option>
                            </select>

                            <InputError class="mt-2" :message="form.errors.status" />
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
