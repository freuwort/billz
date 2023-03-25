<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white drop-shadow-md">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <slot name="header" />
                        </div>
                        
                        <div class="flex items-stretch gap-6">
                            <NavLink :href="route('invoices.index')" :active="route().current('invoices.index')">
                                Invoices
                            </NavLink>
                            <NavLink :href="route('companies.index')" :active="route().current('companies.index')">
                                Companies
                            </NavLink>
                            <NavLink :href="route('customers.index')" :active="route().current('customers.index')">
                                Customers
                            </NavLink>
                            <div class="my-2 border-l border-gray-200"></div>
                            <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')">
                                <b>{{ $page.props.auth.user.name }}</b>
                            </NavLink>
                        </div>
                    </div>
                </div>
            </nav>

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
