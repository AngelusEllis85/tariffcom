<template>
    <div class="mx-auto my-10 bg-white p-5 rounded shadow-lg max-w-md">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">User Details</h1>
        <div class="border-t-2 border-gray-200">
            <div class="mt-4 text-gray-700">
                <strong class="font-semibold">First Name:</strong> 
                <span class="ml-2">{{ user.firstname }}</span>
            </div>
            <div class="mt-2 text-gray-700">
                <strong class="font-semibold">Last Name:</strong> 
                <span class="ml-2">{{ user.lastname }}</span>
            </div>
            <div class="mt-2 text-gray-700">
                <strong class="font-semibold">Email:</strong> 
                <span class="ml-2">{{ user.email }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user'],
}
</script>

<style>
</style>
