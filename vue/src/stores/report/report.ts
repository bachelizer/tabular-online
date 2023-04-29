import { defineStore } from 'pinia';

import report from '@/helper/api/services/report.service';

export const reportStore = defineStore('reportStore', {
    state: () => {
        return {};
    },
    actions: {
        async generateFinalPdf(payload: any, eventId: number) {
            await report.generateFinalPdf(payload, eventId);
        },
        async generateJudgesScoring(eventId: number) {
            await report.generateJudgesScoring(eventId);
        }
    }
});
