import { defineStore } from 'pinia';

import activity from '@/helper/api/services/activity.service';

import type { ActivityRequest, Activity } from './interface/activity.interface';

export const activityStore = defineStore('activityStore', {
    state: () => {
        return {
            activities: [] as Activity[]
        };
    },
    actions: {
        async createActivity(payload: ActivityRequest) {
            await activity.createActivity(payload);
        },
        async fetchActivity() {
            const { data } = await activity.fetchActivity();
            this.activities = data;
        },
        async updateActivity(payload: Activity) {
            await activity.updateActivity(payload);
        },
        async deleteActivity(id: number) {
            await activity.deleteActivity(id);
        }
    }
});
