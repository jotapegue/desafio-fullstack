<script setup lang="ts">
import { http } from '@/utils/http/http';
import { reactive } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

interface UserInterface {
  email: string;
  password: string;
}

const store = useStore();
const router = useRouter();

const form = reactive<UserInterface>({
  email:'admin@admin.com',
  password:'password'
})


async function submit () {
  try {
    const {data} = await http.postForm('/auth/login', form)
    store.dispatch('login', `${data.token_type}  ${data.access_token}`)
    router.push({name: 'store'});
  } catch (error) {

  }
}

</script>

<template>
  <section class="position-relative py-4 py-xl-5">
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-8 col-xl-6 text-center mx-auto">
          <h2>Log in</h2>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-xl-4">
          <div class="card mb-5">
            <div class="card-body d-flex flex-column align-items-center">
              <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4">
                <svg class="bi bi-person" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"></path>
                </svg>
              </div>
              <form class="text-center" @submit.prevent="submit">
                <div class="mb-3">
                  <input
                    v-model="form.email"
                    class="form-control"
                    type="email"
                    name="email"
                    placeholder="Email"
                  />
                </div>
                <div class="mb-3">
                  <input
                    v-model="form.password"
                    class="form-control"
                    type="password"
                    name="password"
                    placeholder="Password"
                  />
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-block w-100" type="submit">Login</button>
                </div>
                <RouterLink :to="{name: 'store'}" class="btn btn-info">Voltar</RouterLink>
                <p class="text-muted">Forgot your password?</p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
