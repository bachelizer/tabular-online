import { defineStore } from 'pinia';

import participant from '@/helper/api/services/participant.service';
import type { ParticipantRequest } from './interface/participant.interface';

export const participantStore = defineStore('participantStore', {
    state: () => {
        return {};
    },
    actions: {
        async createParticipant(payload: ParticipantRequest) {
            await participant.createParticipant(payload);
        }
    }
});
