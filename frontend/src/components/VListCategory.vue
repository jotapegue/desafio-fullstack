<script setup lang="ts">
import type { CategoryInterface } from '@/intefaces/CategoryInterface';
defineProps<{categories: CategoryInterface[]}>()
</script>

<template>
  <ul class="list-group">
    <li class="list-group-item active">Categorias</li>
    <li v-for="category in categories" :key="category.id" class="list-group-item d-flex justify-content-between align-items-start">
      <a href="#" @click="$emit('filterBy', category.id)">
        {{ category.name  }}
      </a>
    </li>
  </ul>
</template>
