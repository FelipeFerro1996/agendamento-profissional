<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { usePatient } from 'src/composables/usePatient';
import { useRoute, useRouter } from 'vue-router';
import { type Patient } from 'src/types/Patient';
import PatientForm from 'src/components/PatientForm.vue';
import axios from 'axios';
import { type ValidationErrorResponse } from 'src/composables/useApi';
import { useQuasar } from 'quasar';

const router = useRouter()
const route = useRoute()
const $q = useQuasar()

const { find, update } = usePatient()
const errors = ref<Record<string, string[]>>({})

const loading = ref(false)

const patient = ref<Partial<Patient>>({})

onMounted(async () => {
    loading.value = true

    try {
        const patientReturn = await find(Number(route.params.id))
        console.log(patientReturn.data)
        patient.value = patientReturn.data      
    } finally {
        loading.value = false
    }
})

const save = async () => {

    loading.value = true

    try {
        
        const payload = {
            ...patient.value,
            ...(patient.value.phone && {
                phone: patient.value.phone.replace(/\D/g, '')
            }),
            ...(patient.value.cpf && {
                cpf: patient.value.cpf.replace(/\D/g, '')
            })
        }

        await update(Number(payload.id), payload)
        $q.notify({
            type: 'positive',
            message: 'Paciente atualizado com sucesso!'
        })
        void router.push(`/patients/${payload.id}`)
    } catch (error: unknown) {
        if (axios.isAxiosError<ValidationErrorResponse>(error)) {
            errors.value = error.response?.data.errors ?? {}
        }
    } finally {
        loading.value = false
    }

}

</script>

<template>
    <q-page class="q-pa-md">
        <div class="text-h5 q-md-lg">
            Editar paciente
        </div>

        <PatientForm
            v-model="patient"
            :loading="loading"
            @submit="save"
            :errors="errors"
        />

    </q-page>
</template>