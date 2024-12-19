<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Header Section -->
    <header class="bg-white shadow-md p-4 flex justify-between items-center">
      <!-- Logo or Title -->
      <div class="text-xl font-bold text-gray-700">
        <span>My CRUD App</span>
      </div>

      <!-- Profile Dropdown and Logout Button -->
      <div class="relative">
        <button 
          @click="toggleDropdown" 
          class="flex items-center space-x-2 bg-gray-800 text-white px-4 py-2 rounded-lg focus:outline-none"
        >
          <span>{{ page.props.user.name }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
          </svg>
        </button>

        <!-- Dropdown Menu -->
        <div v-if="dropdownOpen" class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md">
          <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
          <a @click.prevent="logout" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
        </div>
      </div>
    </header>

    <!-- Main Content Section -->
    <div class="w-full max-w-7xl mx-auto mt-6 p-4">
      <flash-message 
        :error="flashMessages.error" 
        :success="flashMessages.success" 
        :warning="flashMessages.warning" 
        :message="flashMessages.message" 
      />
      
      <!-- Main Content Slot -->
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
  import { reactive, ref, watchEffect } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import FlashMessage from '@/Components/Alert/FlashMessage.vue';

  const page = usePage({
    props: {
      flash: Object,
      user: Object
    }
  });

  const flashMessages = reactive({
    success: null,
    error: null,
    warning: null,
    message: null,
  });

  const dropdownOpen = ref(false);

  // Toggle dropdown visibility
  const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
  };

  // Handle logout
  const logout = () => {
    // Implement logout logic here
    window.location.href = '/logout'; // Example redirection
  };

  // Update flash messages from Inertia page props
  watchEffect(() => {
    flashMessages.success = page.props.flash.success || null;
    flashMessages.error = page.props.flash.error || null;
    flashMessages.warning = page.props.flash.warning || null;
    flashMessages.message = page.props.flash.message || null;
  });
</script>

<style scoped>
  /* Custom styles for the layout */
  .dropdown-menu {
    display: none;
  }

  .dropdown-menu.show {
    display: block;
  }
</style>
