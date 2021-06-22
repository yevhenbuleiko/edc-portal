<template>
    <app-layout>

        <template #menu>
            <main-menu />
        </template>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Create
            </h2>
        </template>

        <template #breadcrumbs>
            <ol class="flex text-gray-700 bg-gray-100 rounded py-2 px-2">
                <li class="px-2">
                    <a href="#" class="hover:underline">Home</a>
                </li>
                <li class="text-gray-500 select-none">&rsaquo;</li>
                <li class="px-2">
                    <a href="#" class="hover:underline">Dashboard</a>
                </li>
                <li class="text-gray-500 select-none">&rsaquo;</li>
                <li class="px-2">
                    <a href="#" class="hover:underline">Users</a>
                </li>
                <li class="text-gray-500 select-none">&rsaquo;</li>
                <li class="px-2 text-indigo-600">Edit user</li>
            </ol>
        </template>

        <template #leftcnt>
            <left-nav />
        </template>
        <template #centercnt>
            <!-- main context -->    
        </template>
        <template #rightcnt></template>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import MainMenu from '@/Pages/Backend/Partials/Nav/Menu'
    import LeftNav from '@/Pages/Backend/User/Partials/LeftNav'
    import JetButton from '@/Jetstream/Button'

    export default {
        components: {
            AppLayout,
            MainMenu,
            LeftNav,
            JetButton,
        },
    }
</script>