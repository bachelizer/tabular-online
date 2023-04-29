import { defineStore } from 'pinia';

import score from '@/helper/api/services/score.services';
import participant from '@/helper/api/services/participant.services';
import type { ParticipantRequest, Participant } from '../participant/interface/participant.interface';

import type { ScoreRequest, Score, ParticipantScore } from './interface/score.interface';
import { authStore } from '../auth/auth'
import merge from '@/helper/util/merge'

const auth = authStore()

export const scoreStore = defineStore('scoreStore', {
    state: () => {
        return {
            scores: [] as Score[],
            participantScore: [] as ParticipantScore[],
            participants: null as Participant[] | null,
            normalizeParticipant: [] as Array<any>
        };
    },
    actions: {
        async createScore(payload: ScoreRequest) {
            await score.createScore(payload);
        },
        async getParticipantScore(participantId: number) {
            const userId = auth.userAccount?.id;
            const { data } = await score.getParticipantScore(participantId, Number(userId));
            this.scores = data
        },
        async getParticipantsTotalScore(eventId: number) {
            // const { data } = await score.getParticipantsTotalScore(eventId)
            const scores = await score.getParticipantsTotalScore(eventId)
            const part = await participant.fetchEventParticipants(eventId);
            const r = merge.participantsAndScore(part.data, scores.data)   
            // this.participantScore = data
            this.normalizeParticipant = r
        },
        async fetchEventParticipants(eventId: number) {
            const { data } = await participant.fetchEventParticipants(eventId);
            this.participants = data;
        },
    },
    getters: {
        // normalizeParticipant(state) {
        //     return merge.participantsAndScore(state.participants, state.participantScore)   
        // }
    }
});
