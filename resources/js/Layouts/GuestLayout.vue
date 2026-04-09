<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-950 relative overflow-hidden">
        <!-- Abstract Background Shapes -->
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-indigo-600/20 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] bg-purple-600/20 blur-[120px] rounded-full"></div>

        <div class="relative z-10 w-full flex flex-col items-center">
            <Link href="/" class="flex flex-col items-center gap-4 group">
                <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-2xl shadow-indigo-500/40 transform transition-transform group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <span class="text-3xl font-extrabold tracking-tight text-white mb-8 text-center uppercase">
                    Library Ecosystem
                </span>
            </Link>

            <div
                class="w-full sm:max-w-md px-8 py-10 bg-white/5 backdrop-blur-2xl border border-white/10 shadow-2xl overflow-hidden sm:rounded-[2.5rem] relative"
            >
                <!-- Subtle inner glow -->
                <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                
                <slot />
            </div>
            
            <p class="mt-8 text-gray-500 text-sm">
                &copy; 2026 Library Ecosystem System. Secure & Premium.
            </p>
        </div>
    </div>
</template>
