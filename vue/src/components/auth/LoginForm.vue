<script setup lang="ts">
import { ref } from 'vue';

const emit = defineEmits<{
    (e: 'logIn', password: string): void;
}>();

const checkbox = ref(true);
let password = ref('');
</script>

<template>
    <v-form @submit.prevent="emit('logIn', password)">
        <v-row class="d-flex mb-3">
            <!-- <v-col cols="12">
            <v-label class="font-weight-bold mb-1">Username</v-label>
            <v-text-field variant="outlined" hide-details color="primary"></v-text-field>
        </v-col> -->
            <v-col cols="12">
                <v-label class="font-weight-bold mb-1">Password</v-label>
                <v-text-field v-model="password" variant="outlined" type="password" hide-details color="primary"></v-text-field>
            </v-col>
            <v-col cols="12" class="pt-0">
                <div class="d-flex flex-wrap align-center ml-n2">
                    <!-- <v-checkbox v-model="checkbox" color="primary" hide-details>
                        <template v-slot:label class="text-body-1">Remeber this Device</template>
                    </v-checkbox>
                    <div class="ml-sm-auto">
                        <RouterLink to="/" class="text-primary text-decoration-none text-body-1 opacity-1 font-weight-medium"
                            >Forgot Password ?</RouterLink
                        >
                    </div> -->
                </div>
            </v-col>
            <v-col cols="12" class="pt-0">
                <v-btn type="submit" color="primary" size="large" block flat>Sign in</v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>
