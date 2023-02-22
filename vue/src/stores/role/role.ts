import { defineStore } from 'pinia';

import role from '@/helper/api/services/role.services';
import type { Role } from './interface/role.interface';

export const roleStore = defineStore('roleStore', {
    state: () => {
        return {
            roles: [] as Role[],
        };
    },
    actions: {
        async fetchRoles() {
           const { data } = await role.fetchRoles();
           this.roles = data;
        }
    }
});
