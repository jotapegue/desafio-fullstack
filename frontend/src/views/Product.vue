<script setup lang="ts">
import VNavbar from '@/components/VNavbar.vue';
import type { CategoryInterface } from '@/intefaces/CategoryInterface';
import type { ProductCollectioInterface } from '@/intefaces/ProductCollectioInterface';
import type { ProductInterface } from '@/intefaces/ProductInterface';
import { fetchCategoryAdmin } from '@/utils/category';
import { deleteProductFetch, fetchProductAdmin, storeProductFetch } from '@/utils/product';
import { onMounted, reactive, ref } from 'vue';

const statusForm = ref(false)
const categories = reactive<CategoryInterface[]>([])
const products = reactive<ProductCollectioInterface>({ data: [], links: {}, meta: {} })
const form = reactive<ProductInterface>({
  price: 0,
  due_in: '',
  name: '',
  description: '',
  photo: '',
  id: 0,
})

interface ErrorResponse {
  [key: string]: string[];
}

const apiErrors = reactive<ErrorResponse>({})

onMounted(async () => {
  Object.assign(products, await fetchProductAdmin())
  Object.assign(categories, await fetchCategoryAdmin())
})

const attachImage = (event: Event) => {
  const input = event.target as HTMLInputElement;
  if (input.files && input.files.length) {
    form.image = input.files[0];
  }
}

const deleteProduct = (product:ProductInterface) => {
  deleteProductFetch(product)
    .then(() => {
      const index = products.data.findIndex((item) => item.id === product.id)

      if (index !== -1) {
        products.data.splice(index, 1);
      }
    })
}

const submit = () => {
  storeProductFetch(form)
    .then(response => products.data.push(response.data))
    .catch(errors => Object.assign(apiErrors, errors.response.data))
}

</script>

<template>
  <v-navbar />
  <div class="container py-4 py-xl-5">
    <div class="row mb-5">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <button
              class="btn btn-sm btn-outline-secondary rounded"
              @click="() => statusForm = !statusForm"
            >
              x
            </button>
            <form v-if="statusForm" @submit.prevent="submit">
              <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <select class="form-select" id="category" v-model="form.category_id" :class="{'is-invalid': apiErrors.category_id}" required>
                  <option selected disabled>Selecione a Categoria</option>
                  <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                </select>
                <div class="invalid-feedback">
                  <span v-for="(error, index) in apiErrors.category_id" :key="index">{{ error }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label for="price" class="form-label">Preço</label>
                <input v-model="form.price" type="number" class="form-control" id="price" :class="{'is-invalid': apiErrors.price}" required>
                <div class="invalid-feedback">
                  <span v-for="(error, index) in apiErrors.price" :key="index">{{ error }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label for="due_in" class="form-label">Vencimento</label>
                <input v-model="form.due_in" type="date" class="form-control" :class="{'is-invalid': apiErrors.due_in}" id="due_in" required>
                <div class="invalid-feedback">
                  <span v-for="(error, index) in apiErrors.due_in" :key="index">{{ error }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Produto</label>
                <input v-model="form.name" type="text" class="form-control" id="name" :class="{'is-invalid': apiErrors.name}" required>
                <div class="invalid-feedback">
                  <span v-for="(error, index) in apiErrors.name" :key="index">{{ error }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea v-model="form.description" class="form-control" id="description" rows="3" :class="{'is-invalid': apiErrors.description}" required></textarea>
                <div class="invalid-feedback">
                  <span v-for="(error, index) in apiErrors.description" :key="index">{{ error }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label for="image" class="form-label">Foto</label>
                <input @change="attachImage($event)" accept="image/*" type="file" class="form-control" id="image" :class="{'is-invalid': apiErrors.image}" required>
                <div class="invalid-feedback">
                  <span v-for="(error, index) in apiErrors.image" :key="index">{{ error }}</span>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-sm striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th>Vencimento</th>
                    <th>Categoria</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products.data">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.due_in }}</td>
                    <td>{{ product?.category?.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>
                      <div class="d-flex justify-content-between">
                        <button
                          @click="deleteProduct(product)"
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
    </div>
  </div>
</template>
