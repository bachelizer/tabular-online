import api from '../api'
import type { CriteriaRequest, Criteria } from '@/stores/criteria/interface/criteria.interface'

const createCriteria = (payload: CriteriaRequest) => api.post('/api/criteria', payload)

const fetchEventCriteria = (eventId: number) => api.get(`/api/criteria/event/${eventId}`)

const removeCriteria = (criteriaId: number) => api.delete(`/api/criteria/${criteriaId}`)

const updateCriteria = (payload: Criteria) => api.put(`/api/criteria/${payload.id}`, payload);

export default {
    createCriteria,
    fetchEventCriteria,
    removeCriteria,
    updateCriteria,
}