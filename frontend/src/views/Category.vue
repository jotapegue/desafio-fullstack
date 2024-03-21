<script setup lang="ts">
import VNavbar from '@/components/VNavbar.vue';
import type { CategoryInterface } from '@/intefaces/CategoryInterface';
import { deleteCategoryFetch, fetchCategory, fetchCategoryAdmin, storeCategoryFetch } from '@/utils/category';
import { onMounted, reactive, watch } from 'vue';
import VAlertMessage from '@/components/VAlertMessage.vue';
import type { AlertMessageInterface } from '@/intefaces/AlertMessageInterface';

const categories = reactive<CategoryInterface[]>([])
const form = reactive<CategoryInterface>({name: ''})
const alert = reactive<AlertMessageInterface>({type: 'alert-success', message: '', open: false})

onMounted(async () => {
  Object.assign(categories, await fetchCategoryAdmin())
})

watch(form, (newForm) => {
  if (newForm.name.length == 0) {
    form.id = undefined
  }
})

const submit = () => {
  storeCategoryFetch(form)
    .then(response => categories.push(response.data))
  form.name = ''
  alert.message = 'Categoria cadastrada com sucesso'
  alert.open = true
}

const deleteCategory = (category:CategoryInterface) => {
  try {
    deleteCategoryFetch(category)
      .then(() => {
        const index = categories.findIndex((item) => item.id === category.id)

        if (index !== -1) {
          categories.splice(index, 1);
        }
      })
  } catch (error) {
    alert.message = 'Não foi possível pagar esta categoria'
    alert.type = 'alert-danger'
    alert.open = true
  }
}
</script>

<template>
  <v-navbar />
  <div class="container py-4 py-xl-5">
    <div class="row mb-5">
      <div class="col">
        <v-alert-message
          :message="alert.message"
          :type="alert.type"
          v-if="alert.open"
        />
        <div class="card">
          <div class="card-body">
            <form @submit.prevent="submit">
              <div class="mb-3">
                <label for="name" class="form-label">Category:</label>
                <input
                  type="hidden"
                  v-model="form.id"
                >
                <input
                  type="text"
                  id="name"
                  class="form-control"
                  v-model="form.name"
                >
              </div>
              <button
                class="btn btn-primary"
                type="submit"
                v-if="form.id == null"
              >
                Cadastrar
              </button>
              <button
                v-else
                class="btn btn-primary"
                type="submit"
              >
                Atualizar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="table-responsive">
          <table class="table table-sm striped">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                <th>Categoria</th>
                <th class="text-center">Produtos (total)</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="category in categories" :key="category.id">
                <td class="text-center">{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td class="text-center">{{ category.details?.quantity ?? 0 }}</td>
                <td></td>
                <td width="15%">
                  <div class="d-flex justify-content-between">
                    <button
                      :disabled="category.details && category.details.quantity !== undefined"
                      @click="deleteCategory(category)"
                      class="btn btn-sm btn-danger"
                    >
                      remover
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
