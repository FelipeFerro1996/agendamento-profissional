<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { usePatient } from 'src/composables/usePatient'
import type { QTableProps } from 'quasar'

const { patients, pagination, loading, fetchPatients } = usePatient()

const tablePagination = ref({
  page:1,
  rowsPerPage:10,
  rowsNumber:0
})

const columns = [
  { name: 'name', label: 'Nome', field: 'name', align: 'left' as const },
  { name: 'email', label: 'Email', field: 'email', align: 'left' as const },
  { name: 'phone', label: 'Telefone', field: 'phone', align: 'left' as const },
]

const onRequest: QTableProps['onRequest'] = ({ pagination }) => {
  const { page } = pagination

  void fetchPatients(page)
}

onMounted(async () => {
  await fetchPatients()

  if(pagination.value){
    tablePagination.value.rowsNumber = pagination.value.total
  }
})
</script>

<template>
  <q-page>
    <q-table
      title="Pacientes"
      :rows="patients"
      :columns="columns"
      row-key="email"
      :loading="loading"
      :pagination="tablePagination"
      @request="onRequest"
    />
  </q-page>
</template>