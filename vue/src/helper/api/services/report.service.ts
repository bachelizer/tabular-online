import api from '../api';

const generateFinalPdf = (payload: any, eventId: number) => api.post(`/api/report/${eventId}`, payload);
const generateJudgesScoring = (eventId: number) => api.post(`/api/report/judges-scoring/${eventId}`);

export default {
    generateFinalPdf,
    generateJudgesScoring
};
