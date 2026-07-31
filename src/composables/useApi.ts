import axios from 'axios'
import { api } from 'boot/axios'

export interface ValidationErrorResponse {
  success: boolean
  message: string
  errors: Record<string, string[]>
}

export function useApi() {
  const request = async <T>(callback: () => Promise<T>): Promise<T> => {
    try {
      return await callback()
    } catch (error: unknown) {
      if (axios.isAxiosError<ValidationErrorResponse>(error)) {
        // Apenas relança o erro para quem chamou decidir o que fazer
        throw error
      }

      throw error
    }
  }

  const get = <T>(url: string): Promise<T> =>
    request(async () => {
      const { data } = await api.get<T>(url)
      return data
    })

  const post = <T, D = unknown>(url: string, payload?: D): Promise<T> =>
    request(async () => {
      const { data } = await api.post<T>(url, payload)
      return data
    })

  const put = <T, D = unknown>(url: string, payload?: D): Promise<T> =>
    request(async () => {
      const { data } = await api.put<T>(url, payload)
      return data
    })

  const del = <T>(url: string): Promise<T> =>
    request(async () => {
      const { data } = await api.delete<T>(url)
      return data
    })

  return {
    get,
    post,
    put,
    del
  }
}