import { defineStore } from 'pinia';

import user from '@/helper/api/services/user.services';
import type { UserRequest, User, SignInRequest } from './interface/user.interface';
import { authStore } from '../auth/auth'
const auth = authStore()

export const userStore = defineStore('userStore', {
    
    state: () => {
        return {
            users: [] as User[],
            user: {} as User
        };
    },
    actions: {
        async SignIn() {
            // const pass = password.password = 'jd'
            const ps = auth.userAccount?.password
            const { data } = await user.signIn(ps);
            // await user.signIn();
            this.user = data;
        },
        async createUser(payload: UserRequest) {
            await user.createUser(payload);
        },
        async fetchEventUser(eventId: number) {
            const { data } = await user.fetchEventUser(eventId);
            this.users = data;
        },
        async updateUser(payload: User) {
            await user.updateUser(payload);
        },
        async removeUser(id: number) {
            await user.removeUser(id)
        }
    }
});
