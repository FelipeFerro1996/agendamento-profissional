<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { usePatient } from 'src/composables/usePatient'
import { useQuasar, type QTableProps } from 'quasar'
import { type Patient } from 'src/types/Patient'

const $q = useQuasar();

const { patients, pagination, loading, fetchPatients, remove } = usePatient()

const tablePagination = ref({
  page:1,
  rowsPerPage:10,
  rowsNumber:0
})

const columns = [
  { name: 'name', label: 'Nome', field: 'name', align: 'left' as const },
  { name: 'email', label: 'Email', field: 'email', align: 'left' as const },
  { name: 'phone', label: 'Telefone', field: 'phone', align: 'left' as const },
  { name: 'actions', label: 'Ações', field: 'actions', align: 'left' as const, sortable: false },
]

const onRequest: QTableProps['onRequest'] = ({ pagination }) => {
  void (async () => {
    await fetchPatients(pagination.page)

    updatePagination()
  })()
}

onMounted(async () => {
  await fetchPatients()

  if(pagination.value){
    updatePagination()
  }
})

const confirmDelete = (patient: Patient) => {
  $q.dialog({
    title: 'Excluir paciente',
    message: `Deseja realmente excluir ${patient.name}?`,
    cancel: true,
    persistent: true,
  }).onOk(() => {
    void deletePatient(patient.id)
  })
}

const deletePatient = async (id: number) => {
  loading.value = true

  try{
    await remove(id)
    await fetchPatients()
    updatePagination()

    $q.notify({
      type: 'positive',
      message: 'Paciente excluído com sucesso!'
    })

  }finally {
    loading.value = false
  }
}

const updatePagination = () => {
  if (!pagination.value) return

  tablePagination.value = {
    page: pagination.value.current_page,
    rowsPerPage: pagination.value.per_page,
    rowsNumber: pagination.value.total,
  }
}

</script>

<template>
  <q-page class="q-pa-md">

    <div class="row items-center justify-between q-mb-md">

      <div class="text-h5">
        Pacientes
      </div>

      <q-btn 
        color="primary"
        icon="add"
        label="Novo Paciente"
        to="/patients/create"
      />

    </div>

    <q-table
      title="Pacientes"
      :rows="patients"
      :columns="columns"
      row-key="id"
      :loading="loading"
      v-model:pagination="tablePagination"
      @request="onRequest"
    >
      <template #body-cell-actions="props">
        <q-td :props="props">

          <q-btn
            flat
            round
            dense
            color="primary"
            icon="edit"
            :to="`/patients/${props.row.id}`"
          >
            <q-tooltip>Editar</q-tooltip>
          </q-btn>

          <q-btn
            flat 
            round
            dense
            color="negative"
            icon="delete"
            @click="confirmDelete(props.row)"
          >
            <q-tooltip>Excluir</q-tooltip>
          </q-btn>

        </q-td>
      </template>
    </q-table>
  </q-page>
</template>