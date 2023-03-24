<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Log out</h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Log out of this device.
                            </p>
                        </header>

                        <div class="mt-6 space-y-6">

                            <div class="flex items-center gap-4">
                                <Link :href="route('logout')" method="post" as="button">
                                    <PrimaryButton>Log Out</PrimaryButton>
                                </Link>
                            </div>
                        </div>
                    </section>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
    import DeleteUserForm from './Partials/DeleteUserForm.vue'
    import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue'
    import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import { Head, Link } from '@inertiajs/vue3'

    defineProps({
        mustVerifyEmail: Boolean,
        status: String,
    })
</script>
