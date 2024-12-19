<template>
  <!-- Menampilkan pesan kesalahan umum -->
  <div v-if="error" class="animate-in transform mt-4 mb-3 w-full">
    <div class="bg-red-500 text-white p-4 rounded-md shadow-md">
      {{ error }}
    </div>
  </div>

  <!-- Menampilkan pesan sukses -->
  <div v-if="success" class="animate-in transform mt-4 mb-3 w-full">
    <div class="bg-green-500 text-white p-4 rounded-md shadow-md">
      {{ success }}
    </div>
  </div>

  <!-- Menampilkan pesan peringatan -->
  <div v-if="warning" class="animate-in transform mt-4 mb-3 w-full">
    <div class="bg-yellow-500 text-black p-4 rounded-md shadow-md">
      {{ warning }}
    </div>
  </div>

  <!-- Menampilkan pesan informasi -->
  <div v-if="message" class="animate-in transform mt-4 mb-3 w-full">
    <div class="bg-blue-500 text-white p-4 rounded-md shadow-md">
      {{ message }}
    </div>
  </div>
</template>

<script setup>
  defineProps({
    error: {
      type: String,
      default: null,
    },
    success: {
      type: String,
      default: null,
    },
    warning: {
      type: String,
      default: null,
    },
    message: {
      type: String,
      default: null,
    },
  });
</script>

<style scoped>
  /* Tambahkan animasi opsional */
  .animate-in {
    animation: fade-in 0.5s ease-in-out;
  }

  @keyframes fade-in {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }
</style>