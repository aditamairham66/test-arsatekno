<template>
  <app-layout>
    <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
      <div class="text-xl font-medium text-black">
        Hello {{ counter }}!
      </div>
    </div>
  </app-layout>
</template>

<script setup>
  import {ref} from 'vue'
  import AppLayout from '@/Layouts/AppLayout.vue'; // Import the layout

  const counter = ref(0)
  setInterval(() => counter.value++, 1000)
</script>