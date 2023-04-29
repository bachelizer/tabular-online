import api from '../api';
import type { EventRequest, Event } from '@/stores/event/interface/event.interface';

const fetchEventsActive = (isActive: Boolean) => api.get(`/api/event/by_status/${true}`);

const fetchEvents = () => api.get('/api/event');

const createEvent = (event: EventRequest) => api.post('/api/event', event);

const getEvent = (id: number) => api.get(`/api/event/${id}`);

const updateEvent = (payload: EventRequest) => api.put(`/api/event/${payload.id}`, payload);

export default {
    fetchEvents,
    createEvent,
    getEvent,
    updateEvent,
    fetchEventsActive,
};
