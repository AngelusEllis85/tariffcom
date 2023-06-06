<template>
    <div class="container mx-auto">
      <h1 class="text-2xl font-bold mb-4">Create New User</h1>
      <form @submit.prevent="submitForm" class="max-w-md mx-auto">
        <div class="mb-4">
          <label for="firstname" class="block font-bold mb-2">First Name:</label>
          <input type="text" id="firstname" v-model="form.firstname" class="border border-gray-300 p-2 w-full" required>
        </div>
        <div class="mb-4">
          <label for="lastname" class="block font-bold mb-2">Last Name:</label>
          <input type="text" id="lastname" v-model="form.lastname" class="border border-gray-300 p-2 w-full" required>
        </div>
        <div class="mb-4">
          <label for="email" class="block font-bold mb-2">Email:</label>
          <input type="email" id="email" v-model="form.email" class="border border-gray-300 p-2 w-full" required>
        </div>
        <div class="mb-4">
          <label for="password" class="block font-bold mb-2">Password:</label>
          <input type="password" id="password" v-model="form.password" class="border border-gray-300 p-2 w-full" required>
        </div>
        <div class="mb-4">
          <button type="submit" class="bg-blue-500  px-4 py-2 rounded">Create User</button>
        </div>
        <div v-if="errorMessage" class="text-red-500">
        {{ errorMessage }}
      </div>
      </form>
    </div>
  </template>
  
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
  input[type="email"] {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 0.25rem;
    width: 100%;
  }
  
  button {
    background-color: #3490dc;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
    cursor: pointer;
  }
  
  </style>
  
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          firstname: '',
          lastname: '',
          email: '',
          password: '',
        },
        errorMessage: '',
      };
    },
    methods: {
      submitForm() {
        axios.post('/users', this.form)
          .then(response => {
            //success
            const userId = response.data.user.id;
            this.$inertia.visit(`/users/${userId}`);
          })
          .catch(error => {
            this.errorMessage = error.response.data.message || 'An error occurred';
          });
      },
    },
  };
  </script>
  
