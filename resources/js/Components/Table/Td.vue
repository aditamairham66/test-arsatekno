<template>
  <td :class="customClass">
    <slot></slot>
  </td>
</template>

<script setup>
  defineProps({
    customClass: {
      type: String,
      default: ''
    }
  });
</script>
