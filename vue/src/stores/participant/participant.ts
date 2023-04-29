import { defineStore } from 'pinia';

import participant from '@/helper/api/services/participant.services';
import type { ParticipantRequest, Participant } from './interface/participant.interface';

export const participantStore = defineStore('participantStore', {
    state: () => {
        return {
            participants: null as Participant[] | null
        };
    },
    actions: {
        async fetchEventParticipants(eventId: number) {
            const { data } = await participant.fetchEventParticipants(eventId);
            this.participants = data;
        },

        async createParticipant(payload: ParticipantRequest) {
            await participant.createParticipant(payload);
        },

        async updateParticipant(payload: Participant) {
            await participant.updateParticipants(payload);
        },

        async removeParticipant(id: number) {
            await participant.removeParticipant(id);
        }
    }
});
