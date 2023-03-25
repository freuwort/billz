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
                    <div class="bg-white overflow-hidden drop-shadow rounded-lg flex-1">
                        <div class="bg-gray-100 p-4 rounded-t-lg">
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

                    <div class="bg-white overflow-hidden drop-shadow rounded-lg flex-1">
                        <div class="bg-blue-100 p-4 rounded-t-lg">
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
                    
                    <div class="bg-white overflow-hidden drop-shadow rounded-lg flex-1">
                        <div class="bg-red-100 p-4 rounded-t-lg">
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

                <div class="bg-white overflow-hidden shadow rounded-lg">
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
                                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-gray-200 cursor-pointer">
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
                                        <td class="p-1">
                                            <div class="flex justify-end">
                                                <a :href="route('invoices.download', invoice.id)" class="icon-button text-gray-500 font-icon" v-tooltip="'Download'" target="_blank">download</a>
                                                <Link :href="route('invoices.edit', invoice.id)" class="icon-button text-blue-500 font-icon" v-tooltip="'Edit'">edit</Link>
                                                <Link :href="route('invoices.duplicate', invoice.id)" class="icon-button text-blue-500 font-icon" v-tooltip="'Duplicate'" method="post" as="button">content_copy</Link>
                                                <Link :href="route('invoices.destroy', invoice.id)" class="icon-button text-red-500 font-icon" v-tooltip="'Delete'" method="delete" as="button">delete</Link>
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

<style lang="sass" scoped>
    .icon-button
        position: relative
        border-radius: .5rem
        height: 2.5rem
        aspect-ratio: 1
        display: inline-flex
        align-items: center
        justify-content: center
        line-height: 1
        font-size: 1.2rem

        &::before
            content: ''
            position: absolute
            top: 0
            left: 0
            width: 100%
            height: 100%
            background-color: currentColor
            border-radius: inherit
            opacity: 0

        &:hover::before
            opacity: 0.1
</style>