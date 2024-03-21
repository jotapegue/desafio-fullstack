<script setup lang="ts">
import VNavbar from '@/components/VNavbar.vue';
import VProductCard from '@/components/VProductCard.vue';
import VListCategory from '@/components/VListCategory.vue';
import { onMounted, reactive, ref, watch } from 'vue'
import type { CategoryInterface } from '@/intefaces/CategoryInterface';
import type { ProductCollectioInterface } from '@/intefaces/ProductCollectioInterface';
import { fetchProduct } from '@/utils/product';
import { fetchCategory } from '@/utils/category';

const search = ref<string>('')
const products = reactive<ProductCollectioInterface>({ data: [], links: {}, meta: {} })
const categories = reactive<CategoryInterface[]>([])

onMounted(async () => {
  Object.assign(products, await fetchProduct())
  Object.assign(categories, await fetchCategory())
})

watch(search, async (name:string) => {
  Object.assign(products, await fetchProduct({name}))
})

const filterByCategory = async (category:number) => {
  Object.assign(products, await fetchProduct({category}))
}
</script>

<template>
  <v-navbar />
  <div class="container">
    <div class="row">
      <div class="col-3">
        <v-list-category
          :categories="categories"
          @filterBy="filterByCategory"
          />
      </div>
      <div class="col-9">
        <div class="card mb-3">
          <div class="card-body">
            <p class="card-text">Busque seu produto aqui</p>
            <input type="text" name="seach" class="form-control" v-model="search">
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="row mb-5 gy-4 row-cols-1 row-cols-md-2 row-cols-xl-3">
              <div class="col" v-for="(product, index) in products.data" :key="index">
                <v-product-card
                  :category="product.category"
                  :name="product.name"
                  :description="product.description"
                  :image="product.image"
                  :photo="product.photo"
                  :price="product.price"
                  :due_in="product.due_in"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
