import { defineStore } from 'pinia';

import report from '@/helper/api/services/report.service';
import { userStore } from '../user/user';

const user = userStore()

export const reportStore = defineStore('reportStore', {
    state: () => {
        return {};
    },
    actions: {
        async generateFinalPdf(payload: any, eventId: number) {
            await report.generateFinalPdf(payload, eventId);
        },
        async generateJudgesScoring(eventId: number) {
            const judges = user.users.filter((x) => x.role_id == 2)

            await report.generateJudgesScoring(eventId);
        },
        async scoreSummary(eventId: number) {
            await report.scoreSummary(eventId);
        },
        async individualScoring(eventId: number) {
            const judges = user.users.filter((x) => x.role_id == 3)
             await report.individualScoring(eventId, judges)
        },
    }
});
