import api from '../api';
import type { ScoreRequest } from '@/stores/score/interface/score.interface';

const createScore = (payload: ScoreRequest) => api.post('/api/score', payload);

const getParticipantScore = (participantId: number, userId: number) => api.get(`/api/score/${participantId}/${userId}`);

const getParticipantsTotalScore = (eventId : number) => api.get(`/api/score/event/${eventId}`)

export default {
    createScore,
    getParticipantScore,
    getParticipantsTotalScore,
};