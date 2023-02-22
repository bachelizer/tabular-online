import api from '../api';

import type { ParticipantRequest } from '@/stores/participant/interface/participant.interface';

const createParticipant = (participant: ParticipantRequest) => api.post('/api/participant', participant);

export default {
    createParticipant
};
