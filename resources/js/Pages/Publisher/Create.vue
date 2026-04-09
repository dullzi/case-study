<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    name: '',
    address: '',
    email: '',
    phone: '',
});

const submit = () => {
    form.post(route('publishers.store'));
};
</script>

<template>
    <Head title="Create Publisher" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">Create Publisher</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-2xl sm:rounded-[2rem] border border-gray-100 dark:border-white/5">
                    <div class="p-8 md:p-12">
                        <div class="mb-8">
                            <h3 class="text-lg font-bold text-white">Publisher Details</h3>
                            <p class="text-gray-500 text-sm">Register a new publishing house in the system.</p>
                        </div>
                        
                        <form @submit.prevent="submit" class="max-w-2xl space-y-6">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    placeholder="e.g. Penguin Books"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <InputLabel for="email" value="Business Email" />
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        placeholder="contact@publisher.com"
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div>
                                    <InputLabel for="phone" value="Phone Number" />
                                    <TextInput
                                        id="phone"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.phone"
                                        placeholder="+62..."
                                    />
                                    <InputError class="mt-2" :message="form.errors.phone" />
                                </div>
                            </div>

                            <div>
                                <InputLabel for="address" value="Office Address" />
                                <textarea
                                    id="address"
                                    class="mt-1 block w-full border-gray-200 dark:border-white/10 dark:bg-white/5 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-500 rounded-2xl shadow-sm transition-all placeholder:text-gray-500"
                                    v-model="form.address"
                                    rows="3"
                                    placeholder="Full office address..."
                                ></textarea>
                                <InputError class="mt-2" :message="form.errors.address" />
                            </div>

                            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100 dark:border-white/5">
                                <Link :href="route('publishers.index')" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 dark:hover:text-white transition-colors">
                                    Cancel
                                </Link>
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Save Publisher
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
