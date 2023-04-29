import api from '../api';

import type { ParticipantRequest, Participant } from '@/stores/participant/interface/participant.interface';

const createParticipant = (participant: ParticipantRequest) => api.post('/api/participant', participant);

const fetchEventParticipants = (eventId: number) => api.get(`/api/participant/eventParticipants/${eventId}`);

const updateParticipants = (payload: Participant) => api.put(`/api/participant/${payload.id}`, payload);

const removeParticipant = (id: number) => api.delete(`/api/participant/${id}`)
export default {
    createParticipant,
    fetchEventParticipants,
    updateParticipants,
    removeParticipant,
};
