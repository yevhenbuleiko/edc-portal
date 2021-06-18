<template>
    <div>
        <jet-banner />

        <div class="min-h-screen bg-gray-100">
            
            <!-- Main menu -->
            <slot name="menu"></slot>            

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-screen-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-center">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Breadcrumbs -->
            <div class="bg-white">
                <div class="max-w-screen-2xl mx-auto sm:px-6 lg:px-8 text-center">
                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                        <slot name="breadcrumbs"></slot>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                <div class="max-w-screen-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-2">
                            <slot name="leftcnt"></slot>
                        </div>
                        <div class="col-span-8">
                            <div class="py-12">
                                <div class="mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                                        <slot name="centercnt"></slot>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <slot name="rightcnt"></slot>
                        </div>
                    </div>
                    
                </div>
            </main>
        </div>
    </div>
</template>

<script>
    import JetBanner from '@/Jetstream/Banner'

    export default {
        components: {
            JetBanner,
        },
    }
</script>
