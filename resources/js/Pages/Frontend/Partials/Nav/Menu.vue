<template>
    <div class="bg-gray-200">
        <nav class="flex items-center justify-between flex-wrap bg-gray-200 p-6 max-w-screen-2xl mx-auto">
            
            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <span class="font-semibold text-xl tracking-tight">Logo</span>
            </div>
            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                <div class="text-sm lg:flex-grow">
                    <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                        One
                    </a>
                    <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                        Two
                    </a>
                    <a href="#" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white">
                        Three
                    </a>
                </div>
                <div class="float-right">
                    <inertia-link v-if="$page.props.user" href="/knu/admin/dashboard" class="text-sm text-gray-700 underline">
                        {{ $page.props.dp.titles.dashboard }}
                    </inertia-link>

                    <!-- Authentication -->
                    <form class="inline-block" v-if="$page.props.user" @submit.prevent="logout">
                        <jet-dropdown-link as="button">
                             {{ $page.props.dp.titles.logout }}
                        </jet-dropdown-link>
                    </form>

                    <template v-else>
                        <inertia-link :href="route('login', $page.props.objFnd.alias)" class="text-sm text-gray-700 underline">
                             {{ $page.props.dp.titles.login }}
                        </inertia-link>

                        <inertia-link :href="route('register', $page.props.objFnd.alias)" class="ml-4 text-sm text-gray-700 underline">
                             {{ $page.props.dp.titles.register }}
                        </inertia-link>
                    </template>
                </div>
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
        props: {
            fndAlias: String
        },
        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
        methods: {
            logout() {
                this.$inertia.post(route('logout', this.fndAlias));
            },
        }
    }
</script>