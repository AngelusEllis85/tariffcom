<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
  <AuthenticatedLayout>
  <div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create New User</h1>
    <form @submit.prevent="submitForm" class="max-w-md mx-auto" enctype="multipart/form-data">
      <div class="mb-4">
        <label for="prefixname" class="block font-bold mb-2">Prefix (Mr, Mrs, Ms):</label>
        <input type="text" id="prefixname" v-model="form.prefixname" class="border border-gray-300 p-2 w-full">
      </div>
      <div class="mb-4">
        <label for="firstname" class="block font-bold mb-2">First Name:</label>
        <input type="text" id="firstname" v-model="form.firstname" class="border border-gray-300 p-2 w-full" required>
      </div>
      <div class="mb-4">
        <label for="middlename" class="block font-bold mb-2">Middle Name:</label>
        <input type="text" id="middlename" v-model="form.middlename" class="border border-gray-300 p-2 w-full">
      </div>
      <div class="mb-4">
        <label for="lastname" class="block font-bold mb-2">Last Name:</label>
        <input type="text" id="lastname" v-model="form.lastname" class="border border-gray-300 p-2 w-full" required>
      </div>
      <div class="mb-4">
        <label for="suffixname" class="block font-bold mb-2">Suffix (OBE, Bsc, MA etc.):</label>
        <input type="text" id="suffixname" v-model="form.suffixname" class="border border-gray-300 p-2 w-full" >
      </div>
      <div class="mb-4">
        <label for="email" class="block font-bold mb-2">Email:</label>
        <input type="email" id="email" v-model="form.email" class="border border-gray-300 p-2 w-full" required>
      </div>
      <div class="mb-4">
          <label for="photo" class="block font-bold mb-2">Photo:</label>
          <input type="file" id="photo" ref="photoInput" @change="handlePhotoUpload" class="border border-gray-300 p-2 w-full">
      </div>
      <div class="mb-4">
        <label for="password" class="block font-bold mb-2">Password:</label>
        <input type="password" id="password" v-model="form.password" class="border border-gray-300 p-2 w-full" required>
      </div>
      <div class="mb-4">
        <button type="submit" class="bg-blue-500  px-4 py-2 rounded">Create User</button>
      </div>
      <div v-if="errorMessage" class="text-red-500">
        <!-- displays an error message if theres an issue when creating the user -->
      {{ errorMessage }}
    </div>
    </form>
  </div>
  </AuthenticatedLayout>
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
input[type="email"],
input[type="file"] {
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
      prefixname: '',
      firstname: '',
      middlename: '',
      lastname: '',
      suffixname: '',
      email: '',
      password: '',
      photo: null,
    },
    errorMessage: '',
  };
},
methods: {
  // handles the photo upload
  handlePhotoUpload() {
        const file = this.$refs.photoInput.files[0];
        this.form.photo = file;
    },
  // submits the form
  submitForm() {
    // creates a new FormData object
      let formData = new FormData();
    // appends the form data to the formData object
      formData.append('prefixname', this.form.prefixname);
      formData.append('firstname', this.form.firstname);
      formData.append('middlename', this.form.middlename);
      formData.append('lastname', this.form.lastname);
      formData.append('suffixname', this.form.suffixname);
      formData.append('email', this.form.email);
      formData.append('password', this.form.password);
      if (this.form.photo) {
          formData.append('photo', this.form.photo);
      }
      // posts the formData object to the /users route
      axios.post('/users', formData, {
          headers: {
              'Content-Type': 'multipart/form-data'
          }
      }).then(response => {
          // success
          const userId = response.data.user.id;
          this.$inertia.visit(`/users/${userId}`);
      }).catch(error => {
        //failure
          this.errorMessage = error.response.data.message || 'An error occurred';
      });
  },
},
};
</script>
