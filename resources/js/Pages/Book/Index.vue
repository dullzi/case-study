<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    books: Object,
    authors: Array,
    publishers: Array,
    filters: Object,
});

const search = ref(props.filters.search);
const author_id = ref(props.filters.author_id);
const publisher_id = ref(props.filters.publisher_id);

watch([search, author_id, publisher_id], () => {
    router.get(route('books.index'), {
        search: search.value,
        author_id: author_id.value,
        publisher_id: publisher_id.value,
    }, {
        preserveState: true,
        replace: true,
    });
});

const deleteBook = (id) => {
    if (confirm('Are you sure you want to delete this book?')) {
        router.delete(route('books.destroy', id));
    }
};
</script>

<template>
    <Head title="Books" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Books Management</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-100 dark:border-white/5">
                    <div class="p-8">
                        <div class="flex flex-col lg:flex-row justify-between items-center mb-8 gap-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full lg:flex-1">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        placeholder="Search title or ISBN..." 
                                        class="block w-full pl-10 pr-3 py-3 border-gray-200 dark:border-white/10 rounded-2xl dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all" 
                                        v-model="search" 
                                    />
                                </div>
                                
                                <select v-model="author_id" class="block w-full px-4 py-3 border-gray-200 dark:border-white/10 rounded-2xl dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                                    <option :value="null">All Authors</option>
                                    <option v-for="author in authors" :key="author.id" :value="author.id">{{ author.name }}</option>
                                </select>

                                <select v-model="publisher_id" class="block w-full px-4 py-3 border-gray-200 dark:border-white/10 rounded-2xl dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all">
                                    <option :value="null">All Publishers</option>
                                    <option v-for="publisher in publishers" :key="publisher.id" :value="publisher.id">{{ publisher.name }}</option>
                                </select>
                            </div>
                            
                            <Link 
                                v-if="$page.props.auth.user.role === 'admin'" 
                                :href="route('books.create')" 
                                class="w-full lg:w-auto text-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-500/25 transition-all"
                            >
                                + Add New Book
                            </Link>
                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-gray-100 dark:border-white/5">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-white/5">
                                <thead class="bg-gray-50 dark:bg-white/5">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Title</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">ISBN</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Author</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Publisher</th>
                                        <th v-if="$page.props.auth.user.role === 'admin'" class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-transparent divide-y divide-gray-100 dark:divide-white/5">
                                    <tr v-for="book in books.data" :key="book.id" class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-white">{{ book.title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-white">{{ book.isbn }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-full text-xs font-bold">
                                                {{ book.author?.name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 bg-purple-50 dark:bg-purple-500/10 text-purple-600 dark:text-purple-400 rounded-full text-xs font-bold">
                                                {{ book.publisher?.name }}
                                            </span>
                                        </td>
                                        <td v-if="$page.props.auth.user.role === 'admin'" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                            <Link :href="route('books.edit', book.id)" class="inline-flex items-center px-3 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg hover:bg-indigo-100 transition-all">Edit</Link>
                                            <button @click="deleteBook(book.id)" class="inline-flex items-center px-3 py-1 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 transition-all">Delete</button>
                                        </td>
                                    </tr>
                                    <tr v-if="books.data.length === 0">
                                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">No books found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-8 flex justify-center">
                             <nav class="relative z-0 inline-flex rounded-xl shadow-sm -space-x-px" aria-label="Pagination">
                                <template v-for="(link, k) in books.links" :key="k">
                                    <Link v-if="link.url" :href="link.url" v-html="link.label" class="relative inline-flex items-center px-4 py-2 border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/10 first:rounded-l-xl last:rounded-r-xl" :class="{'z-10 bg-indigo-600 border-indigo-600 text-white hover:bg-indigo-700': link.active}" />
                                    <span v-else v-html="link.label" class="relative inline-flex items-center px-4 py-2 border border-gray-200 dark:border-white/10 bg-white dark:bg-white/5 text-sm font-medium text-gray-400 dark:text-gray-600 first:rounded-l-xl last:rounded-r-xl" />
                                </template>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
