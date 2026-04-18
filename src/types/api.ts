export interface ApiResponse<T> {
    success: boolean,
    message: string,
    data: T
}

export interface Pagination<T> {
  current_page: number
  data: T[]
  per_page: number
  total: number
  last_page: number
}