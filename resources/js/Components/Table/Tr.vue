<template>
  <tr :class="customClass">
    <slot></slot>
  </tr>
</template>

<script setup>
  defineProps({
    customClass: {
      type: String,
      default: ''
    }
  });
</script>
