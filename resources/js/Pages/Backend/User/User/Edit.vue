<template>
    <app-layout>

        <template #menu>
            <main-menu />
        </template>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Edit
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
                <jet-form-section @submitted="updateUserInformation">
                    <template #form>
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="name" value="Name" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="email" value="Email" />
                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                            <jet-input-error :message="form.errors.email" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </jet-action-message>

                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </jet-button>
                    </template>
                </jet-form-section>
            <!-- end main context -->   
        </template>
        <template #rightcnt></template>

    </app-layout>
</template>

<script>
    import { useForm } from '@inertiajs/inertia-vue3'
    import AppLayout from '@/Layouts/AppLayout'
    import MainMenu from '@/Pages/Backend/Partials/Nav/Menu'
    import LeftNav from '@/Pages/Backend/User/Partials/LeftNav'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'

    export default {
        components: {
            AppLayout,
            MainMenu,
            LeftNav,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },
        props: [ 'user', ],
        setup(props) {
            const form = useForm({
                _method: 'PUT',
                name: props.user.name,
                email: props.user.email,
            });

            const updateUserInformation = () => {
                form.post(route('admin.users.update', ['knu', props.user.id]), {
                    preserveScroll: true,
                });
            };

            return { form, updateUserInformation };
        },
    }
</script>