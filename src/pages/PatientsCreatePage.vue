<script setup lang="ts">
import { ref } from 'vue';
import { usePatient } from 'src/composables/usePatient';
import { useRouter } from 'vue-router';
import { type Patient } from 'src/types/Patient';
import PatientForm from 'src/components/PatientForm.vue';
import axios from 'axios';
import { type ValidationErrorResponse } from 'src/composables/useApi';

const router = useRouter()
const { create } = usePatient()
const errors = ref<Record<string, string[]>>({})

const loading = ref(false)

const patient = ref<Partial<Patient>>({
    name: '',
    email: '',
    phone: '',
    cpf: '',
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

        await create(payload)
        void router.push('/patients')
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
            Novo paciente
        </div>

        <PatientForm
            v-model="patient"
            :loading="loading"
            @submit="save"
            :errors="errors"
        />

    </q-page>
</template>