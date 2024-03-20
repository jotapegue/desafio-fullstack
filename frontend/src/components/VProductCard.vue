<script setup lang="ts">
import type {ProductInterface} from "@/intefaces/ProductInterface"
defineProps<ProductInterface>()
</script>

<template>
  <div class="card">
    <img
      class="card-img-top w-100 d-block fit-cover"
      style="height: 200px;"
      :src="image"
      />
    <div class="card-body p-4">
      <p class="text-primary card-text mb-0">{{ category.name }}</p>
      <h4 class="card-title">{{ name }}</h4>
      <p class="card-text">{{ description }}</p>
    </div>
  </div>
</template>
