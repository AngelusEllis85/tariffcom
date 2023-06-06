<template>
    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Trashed Users</h1>
        <div v-if="trashedUsers.length > 0">
            <div v-for="user in trashedUsers" :key="user.id">
                <div>
                    <strong>{{ user.firstname }} {{ user.lastname }}</strong>
                </div>
                <div>
                    <small>{{ user.email }}</small>
                </div>
                <div>
                    Deleted At: {{ new Date(user.deleted_at).toLocaleDateString() }}
                </div>
                <button @click="restoreUser(user.id)" class="bg-blue-500 px-4 py-2 text-white rounded">Restore</button>
                <hr class="mt-4">
            </div>
        </div>
        <div v-else>
            <p>No trashed users found.</p>
        </div>
    </div>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import axios from 'axios';

export default {
    props: ['trashedUsers'],
    methods: {
        restoreUser(id) {
            axios.post(`/users/restore/${id}`)
                .then(() => {
                    Inertia.visit(`/users/${id}`);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
}
</script>


<style>
</style>
