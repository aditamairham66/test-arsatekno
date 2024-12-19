<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
      <!-- Flash Messages (Optional) -->
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
  import { reactive, watchEffect } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import FlashMessage from '@/Components/Alert/FlashMessage.vue';

  const page = usePage({
    props: {
      flash: Object
    }
  });

  const flashMessages = reactive({
    success: null,
    error: null,
    warning: null,
    message: null,
  });

  watchEffect(() => {
    flashMessages.success = page.props.flash.success || null;
    flashMessages.error = page.props.flash.error || null;
    flashMessages.warning = page.props.flash.warning || null;
    flashMessages.message = page.props.flash.message || null;
  });
</script>

<style scoped>
  /* Custom styles for the Auth Layout */
</style>
