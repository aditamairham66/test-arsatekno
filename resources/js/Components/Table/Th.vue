<template>
  <th :class="customClass">
    <slot></slot>
  </th>
</template>

<script setup>
  defineProps({
    customClass: {
      type: String,
      default: ''
    }
  });
</script>
