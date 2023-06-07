<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
    <AuthenticatedLayout>
    <div class="mx-auto my-10 bg-white p-5 rounded shadow-lg max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">User Details</h1>
        <div class="border-t-2 border-gray-200">
            <div class="mt-4 text-gray-700">
                <strong class="font-semibold">Prefix:</strong> 
                <span class="ml-2">{{ user.prefixname }}</span>
            </div>
            <div class="mt-2 text-gray-700">
                <strong class="font-semibold">First Name:</strong> 
                <span class="ml-2">{{ user.firstname }}</span>
            </div>
            <div class="mt-2 text-gray-700">
                <strong class="font-semibold">Last Name:</strong> 
                <span class="ml-2">{{ user.lastname }}</span>
            </div>
            <div class="mt-2 text-gray-700">
                <strong class="font-semibold">Middle Name:</strong> 
                <span class="ml-2">{{ user.middlename }}</span>
            </div>
            <div class="mt-2 text-gray-700">
                <strong class="font-semibold">Suffix:</strong> 
                <span class="ml-2">{{ user.suffixname }}</span>
            </div>
            <div class="mt-2 text-gray-700">
                <strong class="font-semibold">Email:</strong> 
                <span class="ml-2">{{ user.email }}</span>
            </div>
            <div class="mb-4" v-if="user.photo">
                <label class="block font-bold mb-2">Photo:</label>
                <img :src="user.photo" alt="User photo" class="mb-2" width="100" height="100">
            </div>
        </div>
        <div class="mt-4">
            <inertia-link :href="`/users/${user.id}/edit`" class="px-4 py-2 rounded bg-blue-500 text-white">Edit User</inertia-link>
            <button @click="deleteUser" class="px-4 py-2 ml-2 rounded bg-red-500 text-white">Delete User</button>

        </div>
    </div>
    </AuthenticatedLayout>
</template>

<script>
import { InertiaLink } from '@inertiajs/inertia-vue3';
import axios from 'axios'
export default {
    components: {
        InertiaLink,
    },
    props: ['user'],
    methods: {
        deleteUser() {
            if(confirm('Are you sure you want to delete this user?')) {
                axios.delete(`/users/${this.user.id}`)
                .then(() => {
                    this.$inertia.visit('/users');
                })
                .catch(error => {
                    console.error(error);
                });
            }
        }
    }
}
</script>

<style>
</style>
