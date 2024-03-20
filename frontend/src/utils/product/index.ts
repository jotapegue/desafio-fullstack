import type { ProductInterface } from "@/intefaces/ProductInterface"
import { http } from "@/utils/http/http"

export const fetchProduct = async (params?:object) => {
  const { data } = await http.get('/public/products', {params})
  return data
}

export const storeProductFetch = async (form:ProductInterface) => {
  return http.postForm('/admin/product', form)
}


export const deleteProductFetch = async (product:ProductInterface) => {
  return http.delete(`/admin/product/${product.id}`)
}

export const updateProductFetch = async (form:ProductInterface) => {
  return http.patch('/admin/product', form)
}

