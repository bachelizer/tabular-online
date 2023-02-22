import api from '../api';
import type { EventRequest } from '@/stores/event/interface/event.interface';

const fetchEvents = () => api.get('/api/event');

const createEvent = (event: EventRequest) => api.post('/api/event', event);

const getEvent = (id: number) => api.get(`/api/event/${id}`);

export default {
    fetchEvents,
    createEvent,
    getEvent
};
