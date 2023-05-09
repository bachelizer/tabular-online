<script setup lang="ts">
import Logo from '@/layouts/full/logo/Logo.vue';
/* Login form */
import LoginForm from '@/components/auth/LoginForm.vue';

import { authStore } from '@/stores/auth/auth';
import { storeToRefs } from 'pinia';

const useAuthStore = authStore();
const { signIn } = useAuthStore;
const { userAccount } = storeToRefs(useAuthStore);

const logIn = async (password: string) => {
    const data = await signIn(password);
    if (data.role.role === 'Judge') return window.location.assign('/judge');
    if (data.role.role === 'Admin') return window.location.assign('/event');
    // console.log(password)
};
// console.log(userAccount)
</script>
<template>
    <div class="authentication">
        <v-container fluid class="pa-3">
            <v-row class="h-100vh d-flex justify-center align-center">
                <v-col cols="12" lg="4" xl="3" class="align-center">
                    <div
                        style="background-color: green; display: flex; justify-content: center; align-items: center"
                    >
                        <img src="../../assets/images/logos/logo.png" alt="ASSCAT Seal" />
                    </div>

                    <v-card rounded="md" elevation="10" class="px-sm-1 px-0 withbg mx-auto" max-width="500">
                        <v-card-item class="pa-sm-8">
                            <div class="d-flex justify-center py-4">
                                <span style="text-weight: 700; font-size: 1.5rem; text-align: center"
                                    ><strong>Web-based Event Tabulation System</strong></span
                                >
                                <!-- <Logo /> -->
                            </div>
                            <!-- <div class="text-body-1 text-muted text-center mb-3">Your Social Campaigns</div> -->
                            <LoginForm @logIn="logIn" />
                            <!-- <h6 class="text-h6 text-muted font-weight-medium d-flex justify-center align-center mt-3">
                                New to Modernize?
                                <RouterLink
                                    to="/auth/register"
                                    class="text-primary text-decoration-none text-body-1 opacity-1 font-weight-medium pl-2"
                                >
                                    Create an account</RouterLink
                                >
                            </h6> -->
                        </v-card-item>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
