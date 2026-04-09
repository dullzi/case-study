<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    author: Object,
});

const form = useForm({
    name: props.author.name,
    bio: props.author.bio,
    birthdate: props.author.birthdate,
    email: props.author.email,
});

const submit = () => {
    form.patch(route('authors.update', props.author.id));
};
</script>

<template>
    <Head title="Edit Author" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Edit Author</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-100 dark:border-white/5">
                    <div class="p-8 md:p-12">
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-white">Update Author Information</h3>
                            <p class="text-gray-500 text-sm">Modifying details for: <span class="font-bold text-indigo-600 tracking-tight">{{ author.name }}</span></p>
                        </div>
                        
                        <form @submit.prevent="submit" class="max-w-2xl space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="name" value="Full Name" />
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="email" value="Email Address" />
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>
                            </div>

                            <div>
                                <InputLabel for="birthdate" value="Date of Birth" />
                                <TextInput
                                    id="birthdate"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.birthdate"
                                />
                                <InputError class="mt-2" :message="form.errors.birthdate" />
                            </div>

                            <div>
                                <InputLabel for="bio" value="Biography" />
                                <textarea
                                    id="bio"
                                    class="mt-1 block w-full border-gray-200 dark:border-white/10 dark:bg-white/5 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-2xl shadow-sm transition-all placeholder:text-gray-500"
                                    v-model="form.bio"
                                    rows="4"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.bio" />
                            </div>

                            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-white/5">
                                <Link :href="route('authors.index')" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 dark:hover:text-white transition-colors">
                                    Cancel
                                </Link>
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update Author
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
