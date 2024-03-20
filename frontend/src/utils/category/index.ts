import type { CategoryInterface } from "@/intefaces/CategoryInterface"
import { http } from "@/utils/http/http"

export const fetchCategory = async (params?:object) => {
  const { data } = await http.get('/v1/public/categories', {params})
  return data
}

export const fetchCategoryAdin = async (params?:object) => {
  const { data } = await http.get('/v1/admin/categories', {params})
  return data
}

export const storeCategoryFetch = async (form:CategoryInterface) => {
  return http.postForm('/v1/admin/categories', form)
}

export const deleteCategoryFetch = async (category:CategoryInterface) => {
  return http.delete(`/v1/admin/categories/${category.id}`)
}
