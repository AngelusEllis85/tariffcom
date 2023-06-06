<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">All Users</h1>
      <table class="w-full">
        <thead>
          <tr>
            <th class="py-2">Name</th>
            <th class="py-2">Email</th>
            <th class="py-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td class="py-2">{{ user.firstname }} {{ user.lastname }}</td>
            <td class="py-2">{{ user.email }}</td>
            <td class="py-2">
              <router-link :to="`/users/${user.id}`" class="text-blue-500 hover:underline">View</router-link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    props: ['users'],
  }
  </script>
  
  <style>
  table {
    border-collapse: collapse;
    width: 100%;
  }
  
  th,
  td {
    border: 1px solid #ddd;
    padding: 8px;
  }
  
  th {
    background-color: #f2f2f2;
    font-weight: bold;
  }
  
  td {
    text-align: center;
  }
  </style>
  