<template>
  <app-layout>
    <h1 class="text-2xl font-bold text-center mb-6">
      {{ isEdit ? 'Edit Task' : 'Add Task' }}
    </h1>

    <form @submit.prevent="submit">
      <!-- Title Field -->
      <div class="mb-4">
        <label for="title" class="block text-gray-700">Title</label>
        <input
          id="title"
          v-model="form.title"
          type="text"
          placeholder="Enter task title"
          class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        />
        <div v-if="form.errors.title" class="text-red-500 text-sm mb-4">
          {{ form.errors.title }}
        </div>
      </div>

      <!-- Description Field -->
      <div class="mb-4">
        <label for="description" class="block text-gray-700">Description</label>
        <textarea
          id="description"
          v-model="form.description"
          placeholder="Enter task description"
          class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        ></textarea>
        <div v-if="form.errors.description" class="text-red-500 text-sm mb-4">
          {{ form.errors.description }}
        </div>
      </div>

      <!-- Status Dropdown -->
      <div class="mb-4">
        <label for="status" class="block text-gray-700">Status</label>
        <select
          id="status"
          v-model="form.status"
          class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          <option value="Selesai">Selesai</option>
          <option value="Belum Selesai">Belum Selesai</option>
        </select>
        <div v-if="form.errors.status" class="text-red-500 text-sm mb-4">
          {{ form.errors.status }}
        </div>
      </div>

      <!-- User Dropdown -->
      <div class="mb-4" v-if="props?.user?.role == 'admin'">
        <label for="user_id" class="block text-gray-700">Assign User</label>
        <select
          id="user_id"
          v-model="form.user_id"
          class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          <option value="">Select User</option>
          <option v-for="user in usersList" :key="user.id" :value="user.id">
            {{ user.name }}
          </option>
        </select>
        <div v-if="form.errors.user_id" class="text-red-500 text-sm mb-4">
          {{ form.errors.user_id }}
        </div>
      </div>

      <!-- Submit Button -->
      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300"
      >
        {{ isEdit ? 'Update Task' : 'Add Task' }}
      </button>
    </form>
  </app-layout>
</template>

<script setup>
  import { useForm } from '@inertiajs/vue3';
  import AppLayout from '@/Layouts/AppLayout.vue';

  const props = defineProps({
    task: { type: Object, required: false },
    usersList: Array,
    user: Object,
  });

  const task = props.task || {};  // Fallback jika task tidak didefinisikan

  const form = useForm({
    title: task.title || '',
    description: task.description || '',
    status: task.status || 'Selesai',
    user_id: task.user_id || '',
  });

  // Detect if editing
  const isEdit = !!task.id;

  // Submit form
  const submit = () => {
    const route = isEdit ? `/task/${task.id}` : '/task';

    if(isEdit) {
      form.put(route, {
        onSuccess: () => form.reset(), // Reset form after success
      });
    } else {
      form.post(route, {
        onSuccess: () => form.reset(), // Reset form after success
      });
    }
    
  };
</script>
