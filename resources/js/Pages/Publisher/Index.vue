<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    publishers: Object,
    filters: Object,
});

const search = ref(props.filters.search);

watch(search, (value) => {
    router.get(route('publishers.index'), { search: value }, {
        preserveState: true,
        replace: true,
    });
});

const deletePublisher = (id) => {
    if (confirm('Are you sure you want to delete this publisher?')) {
        router.delete(route('publishers.destroy', id));
    }
};
</script>

<template>
    <Head title="Publishers" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Publishers Management</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-100 dark:border-white/5">
                    <div class="p-8">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                            <div class="relative w-full md:w-96">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    placeholder="Search publishers..." 
                                    class="block w-full pl-10 pr-3 py-3 border-gray-200 dark:border-white/10 rounded-2xl dark:bg-white/5 dark:text-white focus:ring-2 focus:ring-indigo-500 transition-all" 
                                    v-model="search" 
                                />
                            </div>
                            <Link 
                                v-if="$page.props.auth.user.role === 'admin'" 
                                :href="route('publishers.create')" 
                                class="w-full md:w-auto text-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold rounded-2xl shadow-lg shadow-indigo-500/25 transition-all"
                            >
                                + Add New Publisher
                            </Link>
                        </div>

                        <div class="overflow-x-auto rounded-2xl border border-gray-100 dark:border-white/5">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-white/5">
                                <thead class="bg-gray-50 dark:bg-white/5">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Name</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Email</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Phone</th>
                                        <th v-if="$page.props.auth.user.role === 'admin'" class="px-6 py-4 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-widest">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-transparent divide-y divide-gray-100 dark:divide-white/5">
                                    <tr v-for="publisher in publishers.data" :key="publisher.id" class="hover:bg-gray-50 dark:hover:bg-white/[0.02] transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-white">{{ publisher.name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-white">{{ publisher.email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-white">{{ publisher.phone }}</td>
                                        <td v-if="$page.props.auth.user.role === 'admin'" class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                            <Link :href="route('publishers.edit', publisher.id)" class="inline-flex items-center px-3 py-1 bg-indigo-50 dark:bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-lg hover:bg-indigo-100 transition-all">Edit</Link>
                                            <button @click="deletePublisher(publisher.id)" class="inline-flex items-center px-3 py-1 bg-red-50 dark:bg-red-500/10 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 transition-all">Delete</button>
                                        </td>
                                    </tr>
                                    <tr v-if="publishers.data.length === 0">
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">No publishers found.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="mt-8 flex justify-center">
                             <nav class="relative z-0 inline-flex rounded-xl shadow-sm -space-x-px" aria-label="Pagination">
                                <template v-for="(link, k) in publishers.links" :key="k">
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
