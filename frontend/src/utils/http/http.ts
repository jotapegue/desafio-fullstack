import axios from 'axios'

const baseURL = 'http://backend.desafio.local/api/v1'

export const http = axios.create({
  baseURL
})
