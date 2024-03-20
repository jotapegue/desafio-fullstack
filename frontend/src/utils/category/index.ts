import type { CategoryInterface } from "@/intefaces/CategoryInterface"
import { http } from "@/utils/http/http"

export const fetchCategory = async (params?:object) => {
  const { data } = await http.get('/public/categories', {params})
  return data
}

export const storeCategoryFetch = async (form:CategoryInterface) => {
  return http.postForm('/admin/categories', form)
}

export const deleteCategoryFetch = async (category:CategoryInterface) => {
  return http.delete(`/admin/categories/${category.id}`)
}
