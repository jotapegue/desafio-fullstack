<script setup lang="ts">
import store from '@/store';

const logout = () => {
  store.dispatch('logout');
}
</script>

<template>
  <nav class="navbar navbar-expand-md bg-body py-3">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
          <svg class="bi bi-bezier" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M0 10.5A1.5 1.5 0 0 1 1.5 9h1A1.5 1.5 0 0 1 4 10.5v1A1.5 1.5 0 0 1 2.5 13h-1A1.5 1.5 0 0 1 0 11.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm10.5.5A1.5 1.5 0 0 1 13.5 9h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM6 4.5A1.5 1.5 0 0 1 7.5 3h1A1.5 1.5 0 0 1 10 4.5v1A1.5 1.5 0 0 1 8.5 7h-1A1.5 1.5 0 0 1 6 5.5zM7.5 4a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z"></path>
            <path d="M6 4.5H1.866a1 1 0 1 0 0 1h2.668A6.517 6.517 0 0 0 1.814 9H2.5c.123 0 .244.015.358.043a5.517 5.517 0 0 1 3.185-3.185A1.503 1.503 0 0 1 6 5.5zm3.957 1.358A1.5 1.5 0 0 0 10 5.5v-1h4.134a1 1 0 1 1 0 1h-2.668a6.517 6.517 0 0 1 2.72 3.5H13.5c-.123 0-.243.015-.358.043a5.517 5.517 0 0 0-3.185-3.185z"></path>
          </svg>
        </span>
      <span>INNYX - Desafio FullStack</span>
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navcol-4">
      <span class="visually-hidden">Toggle navigation</span>
      <span class="navbar-toggler-icon"></span>
    </button>
      <div id="navcol-4" class="collapse navbar-collapse flex-grow-0 order-md-first">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <RouterLink :to="{name: 'store'}" class="nav-link active">Loja</RouterLink>
          </li>
          <li class="nav-item" v-if="store.state.token">
            <RouterLink :to="{name: 'category'}" class="nav-link active">Categorias</RouterLink>
          </li>
          <li class="nav-item" v-if="store.state.token">
            <RouterLink :to="{name: 'product'}" class="nav-link">Produtos</RouterLink>
          </li>
        </ul>
        <div class="d-md-none my-2">
          <button class="btn btn-primary" type="button">Button</button>
        </div>
      </div>
      <div class="d-none d-md-block">
        <button @click="logout" class="btn btn-primary" v-if="store.state.token">Logout</button>
        <RouterLink :to="{name: 'login'}" class="btn btn-primary" v-else>Login</RouterLink>
      </div>
    </div>
  </nav>
</template>
