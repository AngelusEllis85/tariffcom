<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
    <AuthenticatedLayout>
    <div class="container mx-auto">
      <h1 class="text-2xl font-bold mb-4">Edit User</h1>
      <form @submit.prevent="updateUser" class="max-w-md mx-auto">
        <div class="mb-4">
          <label for="firstname" class="block font-bold mb-2">First Name:</label>
          <input type="text" id="firstname" v-model="user.firstname" class="border border-gray-300 p-2 w-full" required>
        </div>
        <div class="mb-4">
          <label for="lastname" class="block font-bold mb-2">Last Name:</label>
          <input type="text" id="lastname" v-model="user.lastname" class="border border-gray-300 p-2 w-full" required>
        </div>
        <div class="mb-4">
          <label for="email" class="block font-bold mb-2">Email:</label>
          <input type="email" id="email" v-model="user.email" class="border border-gray-300 p-2 w-full" required>
        </div>
        <div class="mb-4">
          <label for="password" class="block font-bold mb-2">Password:</label>
          <input type="password" id="password" v-model="user.password" class="border border-gray-300 p-2 w-full" required>
        </div>
        <div class="mb-4">
          <button type="submit" class="bg-blue-500  px-4 py-2 rounded">Update User</button>
        </div>
      </form>
    </div>
    </AuthenticatedLayout>
  </template>
  
  <script>
  export default {
    props: {
      user: Object
    },
    methods: {
      updateUser() {
        this.$inertia.put(`/users/${this.user.id}`, this.user)
          .catch(error => {
            console.error(error);
          });
      },
    },
  };
  </script>
  
  <style>
  .container {
    padding-top: 2rem;
    text-align:center;
  }
  
  form {
    background-color: white;
    border: 1px solid #ccc;
    padding: 2rem;
    border-radius: 0.25rem;
    width: 500px;
  }
  
  input[type="text"],
  input[type="email"],
  input[type="password"] {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 0.25rem;
    width: 100%;
  }
  
  button {
    color: white;
    background-color: #3490dc;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    cursor: pointer;
  }
  
  </style>
  