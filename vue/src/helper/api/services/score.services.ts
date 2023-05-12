import api from '../api';
import type { ScoreRequest } from '@/stores/score/interface/score.interface';

const createScore = (payload: ScoreRequest) => api.post('/api/score', payload);

// const getParticipantScore = (participantId: number, userId: number) => api.get(`/api/score/${participantId}/${userId}`);

const getParticipantScore = (participantId: number, userId: number, subEventId: number) => api.get(`/api/sub-criteria-scoring/${participantId}/${userId}/${subEventId}`);

const getParticipantsTotalScore = (eventId : number) => api.get(`/api/score/event/${eventId}`)

const createSubEventCriteriaScore = (payload:any) => api.post('/api/sub-criteria-scoring', payload);

export default {
    createScore,
    getParticipantScore,
    getParticipantsTotalScore,
    createSubEventCriteriaScore,
};