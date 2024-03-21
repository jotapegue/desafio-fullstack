import { createRouter, createWebHistory } from 'vue-router'
import Store from '@/views/Store.vue'
import Login from '@/views/Login.vue'
import Category from '@/views/Category.vue'
import Product from '@/views/Product.vue'
import { requireAuth } from '@/authGuard'

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
      component: Category,
      beforeEnter: requireAuth
    },
    {
      path: '/product',
      name: 'product',
      component: Product,
      beforeEnter: requireAuth
    },
  ]
})

export default router
