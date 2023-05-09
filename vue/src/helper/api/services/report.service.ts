import api from '../api';

const generateFinalPdf = (payload: any, eventId: number) => api.post(`/api/report/${eventId}`, payload);
const generateJudgesScoring = (eventId: number) => api.post(`/api/report/judges-scoring/${eventId}`);
const scoreSummary = (eventId : number) => api.get(`/api/report/score-summary/${eventId}`)

const individualScoring = (eventId : number, judges: any[]) => {
    judges.forEach(element => {
        window.open(`http://127.0.0.1:8000/api/report/individual-scoring/${eventId}/${element.id}`, '_blank')
    });
}

export default {
    generateFinalPdf,
    generateJudgesScoring,
    scoreSummary,
    individualScoring,
};
