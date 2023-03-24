<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { formatDate } from '@/date';
import { formatPrice, formatPriceWithoutSymbol } from '@/currency';

defineProps({
    invoices: Array,
    profit: Object,
});
</script>

<template>
    <Head title="Invoices" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Invoices</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-8">
                <div class="flex flex-row gap-6 mb-12">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 border border-gray-200">
                        <div class="bg-gray-100 p-4 rounded-t-lg border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Total Profit</h3>
                            <p class="mt-2 text-sm text-gray-500">Total paid profit</p>
                        </div>
                        <div class="p-6">
                            <div class="flex items-baseline">
                                <span class="text-2xl font-semibold text-gray-900">{{ formatPriceWithoutSymbol(profit.paid) }}</span>
                                <span class="ml-2 text-sm font-medium text-gray-500">€</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 border border-blue-200">
                        <div class="bg-blue-100 p-4 rounded-t-lg border-b border-blue-200">
                            <h3 class="text-lg font-medium text-blue-800">Pending Profit</h3>
                            <p class="mt-2 text-sm text-blue-900">Total pending profit</p>
                        </div>
                        <div class="p-6">
                            <div class="flex items-baseline">
                                <span class="text-2xl font-semibold text-gray-900">{{ formatPriceWithoutSymbol(profit.pending) }}</span>
                                <span class="ml-2 text-sm font-medium text-gray-500">€</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex-1 border border-red-200">
                        <div class="bg-red-100 p-4 rounded-t-lg border-b border-red-200">
                            <h3 class="text-lg font-medium text-red-800">Cancelled profit</h3>
                            <p class="mt-2 text-sm text-red-900">Total cancelled profit</p>
                        </div>
                        <div class="p-6">
                            <div class="flex items-baseline">
                                <span class="text-2xl font-semibold text-gray-900">{{ formatPriceWithoutSymbol(profit.cancelled) }}</span>
                                <span class="ml-2 text-sm font-medium text-gray-500">€</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 border-b border-gray-200">
                        <Link :href="route('invoices.create')">
                            <PrimaryButton type="button">Create Invoice</PrimaryButton>
                        </Link>
                    </div>

                    <!-- invoices table -->
                    <div class="pb-4">
                        <table class="table-auto w-full border-b border-gray-200">
                            <thead>
                                <tr class="bg-slate-50 border-b border-gray-200">
                                    <th class="px-4 py-2 text-left">Number</th>
                                    <th class="px-4 py-2 text-left">Date</th>
                                    <th class="px-4 py-2 text-left">Customer</th>
                                    <th class="px-4 py-2 text-right">Total</th>
                                    <th class="px-4 py-2 text-right">Status</th>
                                    <th class="px-4 py-2 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="invoice in invoices">
                                    <tr class="odd:bg-white even:bg-slate-50">
                                        <td class="px-4 py-2 font-mono">{{ invoice.number }}</td>
                                        <td class="px-4 py-2 font-mono">{{ formatDate(invoice.date, 'medium') }}</td>
                                        <td class="px-4 py-2">{{ invoice.customer.name }}</td>
                                        <td class="px-4 py-2 font-mono text-right">{{ formatPrice(invoice.total) }}</td>
                                        <td class="px-4 py-2 text-right">
                                            <span class="px-2 py-1 rounded-full text-xs font-semibold capitalize" :class="{
                                                'bg-gray-200 text-gray-800': invoice.status === 'draft',
                                                'bg-blue-200 text-blue-800': invoice.status === 'pending',
                                                'bg-green-200 text-green-800': invoice.status === 'paid',
                                                'bg-red-200 text-red-800': invoice.status === 'cancelled',
                                            }">
                                                {{ invoice.status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">
                                            <div class="flex gap-4 justify-end">
                                                <Link :href="route('invoices.edit', invoice.id)" class="text-blue-500">Edit</Link>
                                                <a :href="route('invoices.download', invoice.id)" target="_blank" class="text-blue-500">Download</a>
                                                <Link :href="route('invoices.duplicate', invoice.id)" method="post" as="button" class="text-blue-500">Duplicate</Link>
                                                <Link :href="route('invoices.destroy', invoice.id)" method="delete" as="button" class="text-red-500">Delete</Link>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
