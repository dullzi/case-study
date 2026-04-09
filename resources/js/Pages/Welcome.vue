<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Library Management" />

    <div class="min-h-screen bg-slate-950 text-white selection:bg-indigo-500 overflow-hidden relative">
        <!-- Abstract Background Shapes -->
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-600/20 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-purple-600/20 blur-[120px] rounded-full"></div>

        <!-- Navigation -->
        <nav class="relative z-10 max-w-7xl mx-auto px-6 py-8 flex justify-between items-center bg-transparent">
            <div class="flex items-center gap-2">
               
                <span class="text-2xl font-bold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400">
                     Library EcoSystem
                </span>
            </div>

            <div v-if="canLogin" class="flex gap-4 items-center">
                <Link
                    v-if="$page.props.auth.user"
                    :href="route('dashboard')"
                    class="px-6 py-2 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 transition-all font-medium text-sm"
                >
                    Dashboard
                </Link>

                <template v-else>
                    <Link
                        :href="route('login')"
                        class="text-sm font-medium text-gray-400 hover:text-white transition-colors"
                    >
                        Log in
                    </Link>

                    <Link
                        v-if="canRegister"
                        :href="route('register')"
                        class="px-6 py-2 rounded-full bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-600/20 transition-all font-medium text-sm"
                    >
                        Get Started
                    </Link>
                </template>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="relative z-10 max-w-7xl mx-auto px-6 pt-20 pb-32">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 text-xs font-semibold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                        Management System v2.0
                    </div>
                    
                    <h1 class="text-6xl lg:text-7xl font-extrabold leading-[1.1] tracking-tight text-white">
                        Manage your <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Library</span> with elegance.
                    </h1>
                    
                    <p class="text-lg text-gray-400 leading-relaxed max-w-xl">
                        A premium platform built for collectors, librarians, and book enthusiasts. Organise authors, track publishers, and manage your collection with a seamless real-time interface.
                    </p>

                    <div class="flex flex-wrap gap-4 pt-4">
                        <Link :href="route('register')" class="px-8 py-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 shadow-xl shadow-indigo-600/30 transition-all font-bold text-lg inline-flex items-center gap-2 group">
                            Start Exploring
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </Link>
                        <a href="#features" class="px-8 py-4 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition-all font-bold text-lg">
                            Learn More
                        </a>
                    </div>

                    <!-- Trust Badges/Stats -->
                    <div class="grid grid-cols-3 gap-8 pt-12 border-t border-white/5">
                        <div>
                            <div class="text-3xl font-bold">500+</div>
                            <div class="text-sm text-gray-500">Books Tracked</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">100+</div>
                            <div class="text-sm text-gray-500">Famous Authors</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">99.9%</div>
                            <div class="text-sm text-gray-500">Uptime Ready</div>
                        </div>
                    </div>
                </div>

                <!-- Visual Element: Glass Card -->
                <div class="relative hidden lg:block">
                    <div class="absolute -inset-4 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-[3rem] blur-2xl opacity-20 animate-pulse"></div>
                    <div class="relative bg-white/5 backdrop-blur-xl border border-white/10 rounded-[2.5rem] p-8 shadow-2xl overflow-hidden">
                        <!-- Mockup Table -->
                        <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <div class="w-32 h-6 bg-white/10 rounded-full"></div>
                                <div class="w-10 h-10 bg-indigo-500/20 rounded-xl"></div>
                            </div>
                            <div class="space-y-4">
                                <div v-for="i in 4" :key="i" class="p-4 bg-white/5 border border-white/5 rounded-2xl flex items-center gap-4 transition-transform hover:scale-[1.02]" :style="{opacity: 1 - (i*0.2)}">
                                    <div class="w-12 h-12 bg-white/10 rounded-xl"></div>
                                    <div class="flex-1 space-y-2">
                                        <div class="w-[60%] h-4 bg-white/10 rounded-full"></div>
                                        <div class="w-[40%] h-3 bg-white/5 rounded-full"></div>
                                    </div>
                                    <div class="w-4 h-4 rounded-full bg-indigo-500/40"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Features Grid -->
        <section id="features" class="max-w-7xl mx-auto px-6 py-24">
            <h2 class="text-4xl font-bold text-center mb-16">Everything you need</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div v-for="(feature, index) in [
                    {title: 'Real-time Filters', desc: 'Find any book or author instantly as you type with our optimized search engine.', icon: 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'},
                    {title: 'Role Management', desc: 'Secure administration with multi-role support for Admins and regular Readers.', icon: 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'},
                    {title: 'API Integration', desc: 'Full REST API support for external integrations and headless management.', icon: 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'}
                ]" :key="index" class="p-8 rounded-3xl bg-white/5 border border-white/5 hover:border-indigo-500/50 transition-all hover:bg-white/[0.07] group">
                    <div class="w-12 h-12 bg-indigo-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-indigo-500 group-hover:text-white text-indigo-400 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="feature.icon" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4">{{ feature.title }}</h3>
                    <p class="text-gray-400 leading-relaxed">{{ feature.desc }}</p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="max-w-7xl mx-auto px-6 py-12 border-t border-white/5 text-center text-gray-500 text-sm">
            &copy; 2026 Library EcoSystem. Built with Laravel + Vue + Tailwind.
        </footer>
    </div>
</template>

<style scoped>
@keyframes pulse {
    0%, 100% { opacity: 0.2; transform: scale(1); }
    50% { opacity: 0.3; transform: scale(1.05); }
}
.animate-pulse {
    animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
