<template>
  <auth-layout>
    <h1 class="text-2xl font-bold text-center mb-6">Login</h1>      

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block text-gray-700">Email</label>
        <input 
          v-model="form.email"
          type="email"
          class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"  
        />
        <div v-if="form.errors.email" class="text-red-500 text-sm mb-4">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700">Password</label>
        <input 
          v-model="form.password"
          type="password"
          class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <div v-if="form.errors.password" class="text-red-500 text-sm mb-4">
          {{ form.errors.password }}
        </div>
      </div>

      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300"
      >
        Login
      </button>
    </form>

    <!-- Register Link -->
    <div class="mt-4 text-center">
      <span>Don't have an account? </span>
      <Link href="/register" class="text-blue-500 hover:underline">
        Register here
      </Link>
    </div>
  </auth-layout>
</template>

<script setup>
  import { useForm, Link } from '@inertiajs/vue3';
  import AuthLayout from '@/Layouts/AuthLayout.vue'; // Import the layout

  const form = useForm({
    email: '',
    password: '',
  });

  // Function to submit the form
  const submit = () => {
    form.post('/login');
  };
</script>
