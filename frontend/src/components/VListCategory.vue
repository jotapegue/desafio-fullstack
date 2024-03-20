<script setup lang="ts">
import type { CategoryInterface } from '@/intefaces/CategoryInterface';
defineProps<{categories: CategoryInterface[]}>()
</script>

<!-- <script setup lang="ts">
import { defineProps, defineEmits } from 'vue';
import type { CategoryInterface } from '@/intefaces/CategoryInterface';

const props = defineProps<{categories: CategoryInterface[]}>();
const emits = defineEmits(['filterBy']);

const filterByCategory = (categoryId: number) => {
  emits('filterBy', categoryId);
};
</script> -->

<template>
  <ul class="list-group">
    <li class="list-group-item active">Categorias</li>
    <li v-for="category in categories" :key="category.id" class="list-group-item d-flex justify-content-between align-items-start">
      <a href="#" @click="$emit('filterBy', category.id)">
        {{ category.name  }}
      </a>
      <div>
        <button class="btn btn-sm btn-warning rounded">e</button>
        <button class="btn btn-sm btn-danger rounded">r</button>
      </div>
    </li>
  </ul>
</template>
