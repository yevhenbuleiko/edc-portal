<template>
    <div class="bg-gray-800">
        <nav class="flex items-center justify-between flex-wrap bg-gray-800 p-5 max-w-screen-2xl mx-auto">
            
                <div class="inline-block items-center flex-shrink-0 text-white mr-6">
                    <span class="font-semibold text-xl tracking-tight">Logo</span>
                </div>
                <div class="w-full inline-block flex-grow lg:flex lg:items-center lg:w-auto hidden">
                    <div class="text-sm lg:flex-grow">
                        <!-- Dashboard -->
                        <div class="inline-block">
                            <div class="w-24">
                                <jet-nav-link :href="route('admin.dashboard', $page.props.objFnd.alias)" :active="route().current('admin.dashboard')">
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-100 focus:outline-none transition">
                                            {{ $page.props.dp.titles.dashboard }}
                                        </button>
                                    </span>
                                </jet-nav-link>
                            </div>
                        </div>
                        <!-- *** -->
                        <!-- Users -->
                        <div class="inline-block">
                            <div class="w-24">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <div class="text-center">
                                            <span class="inline-flex rounded-md">
                                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-100 focus:outline-none transition">
                                                    {{ $page.props.dp.titles.users }}
                                                </button>
                                            </span>
                                        </div>
                                    </template>

                                    <template #content>
                                        <div class="w-28">
                                            <jet-dropdown-link 
                                            :href="route('admin.users.index', $page.props.objFnd.alias)" 
                                            :active="route().current('admin.users.*')" 
                                            v-if="$page.props.permission.users.viewAny">
                                                {{ $page.props.dp.titles.users }}
                                            </jet-dropdown-link>
                                        </div>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>
                        <!-- *** -->
                        <!-- Access -->
                        <div class="inline-block">
                            <div class="w-24">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <div class="text-center">
                                            <span class="inline-flex rounded-md">
                                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 hover:text-gray-100 focus:outline-none transition">
                                                    {{ $page.props.dp.titles.access }}
                                                </button>
                                            </span>
                                        </div>
                                    </template>

                                    <template #content>
                                        <div class="w-28">
                                            <jet-dropdown-link href="#">
                                                {{ $page.props.dp.titles.access }}
                                            </jet-dropdown-link>
                                        </div>
                                        <div class="w-28">
                                            <jet-dropdown-link href="#">
                                                {{ $page.props.dp.titles.roles }}
                                            </jet-dropdown-link>
                                        </div>
                                        <div class="w-28">
                                            <jet-dropdown-link href="#">
                                                {{ $page.props.dp.titles.permissions }}
                                            </jet-dropdown-link>
                                        </div>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>
                        <!-- *** -->
                        
                    </div>
                    <div class="inline-block float-right">
                        <!-- Authentication -->
                        <form v-if="$page.props.user" @submit.prevent="logout">
                            <jet-dropdown-link as="button">
                                Log Out
                            </jet-dropdown-link>
                        </form>

                        <template v-else>
                            <inertia-link :href="route('login', $page.props.objFnd.alias)" class="text-sm text-gray-700 underline">
                                Log in
                            </inertia-link>

                            <inertia-link :href="route('register', $page.props.objFnd.alias)" class="ml-4 text-sm text-gray-700 underline">
                                Register
                            </inertia-link>
                        </template>
                    </div>
                </div>
                <div class="lg:hidden">
                    hidden menu
                </div>
        
        </nav>

    </div>
</template>


<script>
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },
        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout', 'knu'));
            },
        }
    }
</script>