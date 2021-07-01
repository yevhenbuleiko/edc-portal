<template>
    <app-layout>

        <template #menu>
            <main-menu :fndAlias="$page.props.objFnd.alias"/>
        </template>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.props.dp.titles.users }}
                <inertia-link :href="route('admin.users.create', [$page.props.objFnd.alias])" 
                    class="float-right"
                    v-if="$page.props.permission.users.create">
                    <jet-button>Create</jet-button>
                </inertia-link>
            </h2>
        </template>

        <template #breadcrumbs>
            <ol class="flex text-gray-700 bg-gray-100 rounded py-2 px-2">
                <li class="px-2">
                    <a href="#" class="hover:underline">Dashboard</a>
                </li>
                <li class="text-gray-500 select-none">&rsaquo;</li>
                <li class="px-2 text-indigo-600">
                    {{ $page.props.dp.titles.users }}
                </li>
            </ol>
        </template>

        <template #leftcnt>
            <left-nav />
        </template>
        <template #centercnt>
            <!-- main content -->    
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ $page.props.dp.titles.name }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ $page.props.dp.titles.desc }}
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                            
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="user in users" :key="user.id">
                                            <td class="px-6 py-4 whitespace-nowrap max-w-xs">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img class="h-10 w-10 rounded-full" :src="user.profile_photo_url" alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 truncate">
                                                            {{ user.last_name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ user.email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 max-w-md truncate">{{ user.about }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <inertia-link 
                                                    :href="route('admin.users.show', [$page.props.objFnd.alias, user.id])" 
                                                    class="text-indigo-600 hover:text-indigo-900"
                                                    v-if="user.can.view">
                                                    Show
                                                </inertia-link>
                                                <inertia-link 
                                                    :href="route('admin.users.edit', [$page.props.objFnd.alias, user.id])" 
                                                    class="ml-2 text-indigo-600 hover:text-indigo-900"
                                                    v-if="user.can.update">
                                                    Edit
                                                </inertia-link>
                                            </td>
                                        </tr>

                                        <!-- More people... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- end main co0ntent -->
        </template>
        <template #rightcnt></template>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import MainMenu from '@/Pages/Backend/Partials/Nav/Menu'
    import UsersList from '@/Pages/Backend/User/User/Partials/List'
    import LeftNav from '@/Pages/Backend/User/Partials/LeftNav'
    import JetButton from '@/Jetstream/Button'

    export default {
        components: {
            AppLayout,
            MainMenu,
            UsersList,
            LeftNav,
            JetButton,
        },
        props: [ 
            'users',
        ],
    }
</script>