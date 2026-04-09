<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const stats = [
    { 
        name: 'TOTAL BOOKS', 
        value: '1,280', 
        icon: 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 
        iconBg: 'bg-white',
        iconColor: 'text-indigo-600',
        progressColor: 'bg-indigo-500',
        progressWidth: '65%',
        link: 'books.index' 
    },
    { 
        name: 'AUTHORS', 
        value: '450', 
        icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 
        iconBg: 'bg-emerald-100',
        iconColor: 'text-emerald-700',
        progressColor: 'bg-emerald-500',
        progressWidth: '40%',
        link: 'authors.index' 
    },
    { 
        name: 'PUBLISHERS', 
        value: '82', 
        icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 
        iconBg: 'bg-rose-100',
        iconColor: 'text-rose-700',
        progressColor: 'bg-rose-500',
        progressWidth: '25%',
        link: 'publishers.index' 
    },
];

const features = [
    { title: 'Inventory Management', description: 'Easily track and manage books, authors, and publishers in one centralized system.', icon: 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4' },
    { title: 'Advanced Search', description: 'Real-time filtering and search capabilities to find any title or author instantly.', icon: 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z' },
    { title: 'Role-Based Access', description: 'Secure CRUD operations protected by strict administrator authorization.', icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z' },
    { title: 'Responsive Design', description: 'Full compatibility across all devices, from mobile phones to high-res desktops.', icon: 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z' },
];
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
                <!-- Welcome Banner -->
                <div class="relative overflow-hidden bg-[#5350d1] rounded-[2rem] p-10 text-white shadow-xl">
                    <div class="relative z-10 max-w-2xl">
                        <span class="text-xs font-bold uppercase tracking-widest text-indigo-200 opacity-80 mb-4 block">SYSTEM OVERVIEW</span>
                        <h1 class="text-4xl font-extrabold mb-4 leading-tight">
                            Welcome back, {{ $page.props.auth.user.name }}!
                        </h1>
                        <p class="text-indigo-100 text-lg mb-8 opacity-90 max-w-lg">
                            Your library is running smoothly. 1,280 books across 450 authors — everything is up to date.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <Link :href="route('books.index')" class="px-8 py-3 bg-white text-indigo-600 font-bold rounded-xl hover:bg-indigo-50 transition-all shadow-lg border-2 border-white">
                                Manage Books
                            </Link>
                            <Link v-if="$page.props.auth.user.role === 'admin'" :href="route('books.create')" class="px-8 py-3 bg-transparent border-2 border-indigo-400 text-white font-bold rounded-xl hover:bg-indigo-400/20 transition-all">
                                + Quick Add
                            </Link>
                        </div>
                    </div>
                    <!-- Decorative Book Icon -->
                    <div class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-10 opacity-20 hidden md:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-96 h-96" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div v-for="stat in stats" :key="stat.name" class="bg-[#1c1c1c] p-8 rounded-[1.5rem] shadow-xl border border-white/5 group relative overflow-hidden">
                        <div class="flex justify-between items-start mb-6">
                            <div :class="`w-12 h-12 ${stat.iconBg} rounded-xl flex items-center justify-center ${stat.iconColor} shadow-inner`">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="stat.icon" />
                                </svg>
                            </div>
                            <Link :href="route(stat.link)" class="text-indigo-400 font-bold text-xs flex items-center gap-1 group-hover:gap-2 transition-all">
                                View all
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </Link>
                        </div>
                        <h3 class="text-gray-500 font-bold tracking-widest uppercase text-[0.7rem] mb-2">{{ stat.name }}</h3>
                        <p class="text-4xl font-extrabold text-white mb-6">{{ stat.value }}</p>
                        
                        <!-- Progress Bar Container -->
                        <div class="w-full bg-white/5 h-1.5 rounded-full overflow-hidden">
                            <div :class="`h-full ${stat.progressColor} rounded-full`" :style="{ width: stat.progressWidth }"></div>
                        </div>
                    </div>
                </div>

                <!-- Web Information & Features Card -->
                <div class="bg-white dark:bg-[#1a1a1a] rounded-[2rem] p-10 shadow-2xl border border-gray-100 dark:border-white/5 relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex flex-col lg:flex-row gap-12">
                            <div class="lg:w-1/3">
                                <h2 class="text-3xl font-extrabold mb-6 dark:text-white leading-tight">Library Ecosystem</h2>
                                <p class="text-gray-500 dark:text-gray-400 mb-8 leading-relaxed">
                                    Library EcoSystem is a next-generation library management solution designed for speed, security, and elegance. Our platform empowers librarians and developers to maintain vast collections with absolute precision.
                                </p>
                                <div class="p-6 bg-indigo-600 rounded-3xl text-white shadow-xl shadow-indigo-600/30">
                                    <p class="text-sm opacity-80 mb-2 font-bold uppercase tracking-wider">Current Version</p>
                                    <p class="text-2xl font-black">v2.4.0-Stable</p>
                                </div>
                            </div>
                            
                            <div class="lg:w-2/3 grid sm:grid-cols-2 gap-8">
                                <div v-for="feature in features" :key="feature.title" class="group">
                                    <div class="w-12 h-12 bg-indigo-50 dark:bg-white/5 rounded-[1rem] flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="feature.icon" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-bold mb-2 dark:text-white">{{ feature.title }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed">
                                        {{ feature.description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Decorative Background Element -->
                    <div class="absolute bottom-[-5rem] right-[-5rem] w-64 h-64 bg-indigo-600/5 blur-[80px] rounded-full"></div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
