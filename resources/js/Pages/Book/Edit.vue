<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    book: Object,
    authors: Array,
    publishers: Array,
});

const form = useForm({
    title: props.book.title,
    isbn: props.book.isbn,
    author_id: props.book.author_id,
    publisher_id: props.book.publisher_id,
    published_at: props.book.published_at,
    description: props.book.description,
});

const submit = () => {
    form.patch(route('books.update', props.book.id));
};
</script>

<template>
    <Head title="Edit Book" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Book</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submit" class="max-w-xl">
                            <div>
                                <InputLabel for="title" value="Title" />
                                <TextInput
                                    id="title"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.title"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="isbn" value="ISBN" />
                                <TextInput
                                    id="isbn"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.isbn"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.isbn" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="author_id" value="Author" />
                                <select
                                    id="author_id"
                                    v-model="form.author_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="" disabled>Select Author</option>
                                    <option v-for="author in authors" :key="author.id" :value="author.id">
                                        {{ author.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.author_id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="publisher_id" value="Publisher" />
                                <select
                                    id="publisher_id"
                                    v-model="form.publisher_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="" disabled>Select Publisher</option>
                                    <option v-for="publisher in publishers" :key="publisher.id" :value="publisher.id">
                                        {{ publisher.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.publisher_id" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="published_at" value="Published At" />
                                <TextInput
                                    id="published_at"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.published_at"
                                />
                                <InputError class="mt-2" :message="form.errors.published_at" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="description" value="Description" />
                                <textarea
                                    id="description"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    v-model="form.description"
                                    rows="3"
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link :href="route('books.index')" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 mr-4">
                                    Cancel
                                </Link>
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update Book
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
