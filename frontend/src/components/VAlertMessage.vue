<script setup lang="ts">
import type { AlertMessageInterface } from '@/intefaces/AlertMessageInterface';
defineProps<AlertMessageInterface>()
</script>

<template>
  <div :class="type" class="alert alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong>{{ title }}</strong> {{  message }}
  </div>
</template>
