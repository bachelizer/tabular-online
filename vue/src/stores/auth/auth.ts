import { defineStore } from 'pinia';

import auth from '@/helper/api/services/auth.services';
import type { User } from '@/stores/user/interface/user.interface';

export const authStore = defineStore('authStore', {
    state: () => {
        return {
            userAccount: null as User | null
        };
    },
    persist: {
        storage: sessionStorage,
        paths: ['userAccount']
    },
    actions: {
        async signIn(password: string) {
            const payload = {
                password
            };
            try {
                const { data } = await auth.signIn(payload);
                this.userAccount = data;
                return data;
            } catch (error) {
                console.log(error);
                sessionStorage.clear();
            }
        }
    }
});
