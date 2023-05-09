import { defineStore } from 'pinia';

import criteria from '@/helper/api/services/criteria.services';
import type { CriteriaRequest, Criteria } from '@/stores/criteria/interface/criteria.interface';

export const criteriaStore = defineStore('criteriaStore', {
    state: () => {
        return {
            criterias: [] as Criteria[]
        };
    },
    actions: {
        async createCriteria(payload: CriteriaRequest) {
            await criteria.createCriteria(payload);
        },
        async fetchEventCriteria(eventId: number) {
            const { data } = await criteria.fetchEventCriteria(eventId);
            this.criterias = data;
        },
        async removeCriteria(criteriaId: number) {
            await criteria.removeCriteria(criteriaId);
        },
        async updateCriteria(payload: Criteria) {
            await criteria.updateCriteria(payload);
        }
    }
});