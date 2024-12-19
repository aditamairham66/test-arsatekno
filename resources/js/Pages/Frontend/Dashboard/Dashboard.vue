<template>
  <app-layout>
    <div class="mb-4 flex justify-between items-center">
      <!-- Add Task Button -->
      <Link 
        href="/task/create" 
        class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
        Add Task
      </Link>

      <!-- Search & Filter -->
      <div class="flex items-center space-x-4">
        <!-- Search Input -->
        <input
          v-model="search"
          @input="onSearch"
          type="text"
          placeholder="Search by Name or Description"
          class="p-2 border rounded"
        />

        <!-- Status Filter -->
        <select v-model="status" @change="onFilterChange" class="p-2 border rounded">
          <option value="">Filter by Status</option>
          <option value="selesai">Selesai</option>
          <option value="belum_selesai">Belum Selesai</option>
        </select>
      </div>
    </div>

    <!-- Table with Pagination -->
    <div v-if="tasks.data.length > 0">
      <Table tableClass="custom-table mt-4">
        <template v-slot:thead>
          <Tr customClass="bg-blue-500 text-white">
            <Th customClass="p-4 text-left">Name</Th>
            <Th customClass="p-4 text-left">Description</Th>
            <Th customClass="p-4 text-left">Status</Th>
            <Th customClass="p-4 text-right">Actions</Th>
          </Tr>
        </template>

        <template v-slot:tbody>
          <Tr v-for="task in tasks.data" :key="task.id" customClass="hover:bg-gray-100">
            <Td customClass="p-4">{{ task.title }}</Td>
            <Td customClass="p-4">{{ task.description }}</Td>
            <Td customClass="p-4">{{ task.status }}</Td>
            <Td customClass="p-4 text-right">
              <Link 
                :href="`/task/${task.id}/edit`" 
                class="text-blue-500 hover:underline">
                Edit
              </Link>
              <button 
                @click="deleteTask(task.id)" 
                class="ml-4 text-red-500 hover:underline">
                Delete
              </button>
            </Td>
          </Tr>
        </template>
      </Table>

      <!-- Pagination -->
      <div class="mt-4">
        <Pagination :pagination="tasks" />
      </div>
    </div>

    <!-- Message when no tasks are available -->
    <div v-else class="text-center text-gray-500 mt-4">
      <p>No tasks available</p>
    </div>
  </app-layout>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import { usePage, router, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/components/Table/Index.vue';
import Th from '@/components/Table/Th.vue';
import Td from '@/components/Table/Td.vue';
import Tr from '@/components/Table/Tr.vue';
import Pagination from '@/components/Pagination/Pagination.vue';

const { props } = usePage();
const search = ref(props.filters?.search || '');
const status = ref(props.filters?.status || '');
const tasks = ref(props.task || { data: [], links: [], meta: {} });

// Method to fetch tasks with filters
const fetchTasks = () => {
  router.get('/', {
    search: search.value,
    status: status.value,
  }, {
    preserveState: true,
    replace: true,
    onSuccess: (page) => {
      tasks.value = page.props.task;
    }
  });
};

// Trigger initial fetch when component is mounted
onMounted(() => {
  fetchTasks();
});

// Watchers for search and filter changes
watch([search, status], () => fetchTasks());

// Method to delete a task
const deleteTask = (id) => {
  if (confirm('Are you sure you want to delete this task?')) {
    router.delete(`/task/${id}`, {
      onSuccess: () => fetchTasks(),  // Re-fetch after deletion
    });
  }
};
</script>
