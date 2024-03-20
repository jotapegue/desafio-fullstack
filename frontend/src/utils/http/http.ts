import axios from 'axios'
import store from '@/store'

const baseURL = 'http://backend.desafio.local/api'


axios.defaults.headers.common = {'Authorization': `bearer ${store.state.token}`}

export const http = axios.create({
  baseURL
})

