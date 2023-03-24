<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="space-x-8 -my-px flex">
                                <NavLink :href="route('invoices.index')" :active="route().current('invoices.index')">
                                    Invoices
                                </NavLink>
                                <NavLink :href="route('companies.index')" :active="route().current('companies.index')">
                                    Companies
                                </NavLink>
                                <NavLink :href="route('customers.index')" :active="route().current('customers.index')">
                                    Customers
                                </NavLink>
                                <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')">
                                    Profile
                                </NavLink>
                            </div>
                        </div>

                        <div class="flex items-center ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                {{ $page.props.auth.user.name }}
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
    import NavLink from '@/Components/NavLink.vue';
</script>
