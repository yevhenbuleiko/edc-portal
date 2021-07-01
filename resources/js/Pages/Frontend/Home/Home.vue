<template>
    <app-layout>

        <template #menu>
            <main-menu :fndAlias="$page.props.objFnd.alias"/>
        </template>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home Page
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import MainMenu from '@/Pages/Frontend/Partials/Nav/Menu'

    export default {
        components: {
            AppLayout,
            MainMenu,
        },
    }
</script>