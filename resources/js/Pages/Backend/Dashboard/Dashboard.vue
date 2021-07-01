<template>
    <app-layout>

        <template #menu>
            <main-menu :fndAlias="$page.props.objFnd.alias"/>
        </template>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <template #breadcrumbs>
            
        </template>

        <template #leftcnt></template>
        <template #centercnt>
            <!-- main context -->    
        </template>
        <template #rightcnt></template>


    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import MainMenu from '@/Pages/Backend/Partials/Nav/Menu'

    export default {
        components: {
            AppLayout,
            MainMenu,
        },
        methods: {
            // ---
        }
    }
</script>