import { createRouter, createWebHistory } from 'vue-router'
import Store from '@/views/Store.vue'
import Login from '@/views/Login.vue'
import Category from '@/views/Category.vue'
import Product from '@/views/Product.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'store',
      component: Store
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/category',
      name: 'category',
      component: Category
    },
    {
      path: '/product',
      name: 'product',
      component: Product
    },
  ]
})

export default router
