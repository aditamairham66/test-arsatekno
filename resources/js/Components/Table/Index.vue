<template>
  <table :class="tableClass" class="min-w-full table-auto border-collapse">
    <thead>
      <slot name="thead"></slot>
    </thead>
    <tbody>
      <slot name="tbody"></slot>
    </tbody>
  </table>
</template>

<script setup>
  defineProps({
    tableClass: {
      type: String,
      default: ''
    }
  });
</script>
