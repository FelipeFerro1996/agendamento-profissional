import { api } from 'boot/axios'

export function useApi(){

    const get = async <T>(url: string): Promise<T> => {
        const { data } = await api.get<T>(url)
        return data
    }

    const post = async  <T, D = unknown>(url: string, payload?: D): Promise<T> => {
        const { data } = await api.post<T>(url, payload)
        return data
    } 

    const put = async <T, D = unknown>(url: string, payload?: D): Promise<T> => {
        const { data } = await api.put<T>(url, payload)
        return data
    }

    const del = async <T>(url: string): Promise<T> => {
        const { data } = await api.delete<T>(url)
        return data
    }

    return {
        get,
        post,
        put,
        del
    }

}