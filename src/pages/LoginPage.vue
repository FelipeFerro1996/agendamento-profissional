<template>
  <q-page class="flex flex-center">
    <q-card style="width: 350px">
      <q-card-section>
        <div class="text-h6">Login</div>
      </q-card-section>

      <q-card-section>
        <q-input v-model="email" label="Email" type="email" />
        <q-input v-model="password" label="Senha" type="password" class="q-mt-md" />
      </q-card-section>

      <q-card-actions align="right">
        <q-btn label="Entrar" color="primary" @click="handleLogin" :loading="loading" />
      </q-card-actions>
    </q-card>
  </q-page>
</template>

<script setup lang="ts">

import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuth } from 'src/composables/useAuth'

const email = ref('')
const password = ref('')
const loading = ref(false)

const router = useRouter()
const { login } = useAuth()

const handleLogin = async () => {
    try {
        loading.value = true

        await login(email.value, password.value)

        await router.push('/')
    } catch (error) {
        console.error(error)
        alert('Erro ao fazer o login')
    }finally {
        loading.value = false
    }
}

</script>