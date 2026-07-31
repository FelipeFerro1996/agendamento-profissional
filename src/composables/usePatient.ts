import type { ApiResponse, Pagination } from "src/types/api"
import { useApi } from "./useApi"
import type { Patient } from "src/types/Patient"
import { ref } from "vue"

export function usePatient() {
    const patients = ref<Patient[]>([])
    const pagination = ref<Pagination<Patient> | null>(null)
    const loading = ref(false)
    const { get, post, put, del } = useApi()

    const endpoint = '/patients'

    const list = (page = 1) => get<ApiResponse<Pagination<Patient>>>(`${endpoint}?page=${page}`)

    const find = (id: number) => 
        get<ApiResponse<Patient>>(`${endpoint}/${id}`)

    const create = (data: Partial<Patient>) => 
        post<Patient, Partial<Patient>>(endpoint, data)

    const update = (id: number, data: Partial<Patient>) =>
        put<Patient, Partial<Patient>>(`${endpoint}/${id}`, data)

    const remove = (id: number) => 
            del<void>(`${endpoint}/${id}`)

    const fetchPatients = async (page = 1) => {
        loading.value = true
        try {
            const response = await list(page)

            patients.value = response.data.data
            pagination.value = response.data                
        } finally{
            loading.value = false
        }
        
    }

    return {
        find,
        create,
        update,
        remove,
        fetchPatients,
        patients,
        pagination,
        loading
    }
}