<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import UserPostsComponent from "@/Components/UserPostsComponent.vue";
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Posts" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <user-posts-component></user-posts-component>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
