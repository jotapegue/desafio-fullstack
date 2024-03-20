import type { ProductInterface } from "@/intefaces/ProductInterface"
import { http } from "@/utils/http/http"

export const fetchProduct = async (params?:object) => {
  const { data } = await http.get('/v1/public/products', {params})
  return data
}

export const fetchProductAdmin = async (params?:object) => {
  const { data } = await http.get('/v1/admin/products', {params})
  return data
}

export const storeProductFetch = async (form:ProductInterface) => {
  return http.postForm('/v1/admin/product', form)
}

export const deleteProductFetch = async (product:ProductInterface) => {
  return http.delete(`/v1/admin/product/${product.id}`)
}

export const updateProductFetch = async (form:ProductInterface) => {
  return http.patch('/v1/admin/product', form)
}

