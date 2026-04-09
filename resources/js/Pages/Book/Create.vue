<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    authors: Array,
    publishers: Array,
});

const form = useForm({
    title: '',
    isbn: '',
    author_id: '',
    publisher_id: '',
    published_at: '',
    description: '',
});

const submit = () => {
    form.post(route('books.store'));
};
</script>

<template>
    <Head title="Create Book" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Create Book</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-100 dark:border-white/5">
                    <div class="p-8 md:p-12">
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-white">Book Specifications</h3>
                            <p class="text-gray-500 text-sm">Fill in the comprehensive details of the book.</p>
                        </div>
                        
                        <form @submit.prevent="submit" class="max-w-3xl space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <InputLabel for="title" value="Book Title" />
                                    <TextInput
                                        id="title"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.title"
                                        required
                                        autofocus
                                        placeholder="Enter the full book title"
                                    />
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>

                                <div>
                                    <InputLabel for="isbn" value="ISBN" />
                                    <TextInput
                                        id="isbn"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.isbn"
                                        required
                                        placeholder="e.g. 978-3-16-148410-0"
                                    />
                                    <InputError class="mt-2" :message="form.errors.isbn" />
                                </div>

                                <div>
                                    <InputLabel for="published_at" value="Publication Date" />
                                    <TextInput
                                        id="published_at"
                                        type="date"
                                        class="mt-1 block w-full"
                                        v-model="form.published_at"
                                    />
                                    <InputError class="mt-2" :message="form.errors.published_at" />
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="author_id" value="Author" />
                                    <select
                                        id="author_id"
                                        v-model="form.author_id"
                                        class="mt-1 block w-full border-gray-200 dark:border-white/10 rounded-2xl dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all px-4 py-3"
                                        required
                                    >
                                        <option value="" class="text-white">Select Author</option>
                                        <option v-for="author in authors" :key="author.id" :value="author.id" class="text-white bg-gray-800">
                                            {{ author.name }}
                                        </option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.author_id" />
                                </div>

                                <div>
                                    <InputLabel for="publisher_id" value="Publisher" />
                                    <select
                                        id="publisher_id"
                                        v-model="form.publisher_id"
                                        class="mt-1 block w-full border-gray-200 dark:border-white/10 rounded-2xl dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all px-4 py-3"
                                        required
                                    >
                                        <option value="" class="text-white">Select Publisher</option>
                                        <option v-for="publisher in publishers" :key="publisher.id" :value="publisher.id" class="text-white bg-gray-800">
                                            {{ publisher.name }}
                                        </option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.publisher_id" />
                                </div>
                            </div>

                            <div>
                                <InputLabel for="description" value="Book Description" />
                                <textarea
                                    id="description"
                                    class="mt-1 block w-full border-gray-200 dark:border-white/10 dark:bg-white/5 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-2xl shadow-sm transition-all placeholder:text-gray-500"
                                    v-model="form.description"
                                    rows="4"
                                    placeholder="Enter a brief summary or description of the book..."
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-white/5">
                                <Link :href="route('books.index')" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 dark:hover:text-white transition-colors">
                                    Cancel
                                </Link>
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Register Book
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
