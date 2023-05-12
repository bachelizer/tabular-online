import api from '../api'

const createSubEvent = (payload: any) => api.post('/api/event/sub-event', payload);
const showSubEvent = (eventId: any) => api.get(`/api/event/sub-event/${eventId}`);
const createSubEventCriteria = (payload: any) => api.post('/api/sub-event/s-c', payload);
const getSubEventCriteria = (id: number) => api.get(`/api/event/sub-event/show/${id}`)
const fetchSubEvents = (eventId: number) => api.get(`/api/event/sub-event/${eventId}`)

export default {
    createSubEvent,
    showSubEvent,
    createSubEventCriteria,
    getSubEventCriteria,
    fetchSubEvents,
}