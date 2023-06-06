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
                <hr class="mt-4">
            </div>
        </div>
        <div v-else>
            <p>No trashed users found.</p>
        </div>
    </div>
</template>

<script>
export default {
    props: ['trashedUsers']
}
</script>

<style>
/* Add your styles here */
</style>
