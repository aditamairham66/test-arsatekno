<template>
  <auth-layout>
    <h1 class="text-2xl font-bold text-center mb-6">Register</h1>

    <form @submit.prevent="submit">
      <!-- Name Field -->
      <div class="mb-4">
        <label class="block text-gray-700">Name</label>
        <input 
          v-model="form.name"
          type="text"
          class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"  
        />
        <div v-if="form.errors.name" class="text-red-500 text-sm mb-4">
          {{ form.errors.name }}
        </div>
      </div>

      <!-- Email Field -->
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

      <!-- Password Field -->
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

      <!-- Submit Button -->
      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300"
      >
        Register
      </button>
    </form>

    <!-- Login Link (for navigating back to login) -->
    <div class="mt-4 text-center">
      <span>Already have an account? </span>
      <Link href="/login" class="text-blue-500 hover:underline">
        Login here
      </Link>
    </div>
  </auth-layout>
</template>

<script setup>
  import { useForm, Link } from '@inertiajs/vue3';
  import AuthLayout from '@/Layouts/AuthLayout.vue'; // Import the layout

  const form = useForm({
    name: '',
    email: '',
    password: '',
  });

  // Fungsi untuk mengirim form
  const submit = () => {
    form.post('/register', {
      onFinish: () => {
        form.name = '';
        form.email = '';
        form.password = '';
      },
    });
  };
</script>
