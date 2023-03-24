<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    companies: Array,
});
</script>

<template>
    <Head title="Companies" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Companies</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 border-b border-gray-200">
                        <Link :href="route('companies.create')">
                            <PrimaryButton type="button">Create Company</PrimaryButton>
                        </Link>
                    </div>

                    <!-- companies table -->
                    <div class="pb-4">
                        <table class="table-auto w-full border-b border-gray-200">
                            <thead>
                                <tr class="bg-slate-50 border-b border-gray-200">
                                    <th class="px-4 py-2 text-left">ID</th>
                                    <th class="px-4 py-2 text-left">Name</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Phone</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="company in companies">
                                    <tr class="odd:bg-white even:bg-slate-50">
                                        <td class="px-4 py-2">{{ company.id }}</td>
                                        <td class="px-4 py-2">
                                            {{ company.name }}<br>
                                            <span class="text-sm text-gray-500">{{ company.description }}</span>
                                        </td>
                                        <td class="px-4 py-2">{{ company.email }}</td>
                                        <td class="px-4 py-2">{{ company.phone }}</td>
                                        <td class="px-4 py-2">
                                            <div class="flex gap-4">
                                                <Link :href="route('companies.edit', company.id)" class="text-blue-500">Edit</Link>
                                                <Link :href="route('companies.destroy', company.id)" method="delete" as="button" class="text-red-500">Delete</Link>
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
