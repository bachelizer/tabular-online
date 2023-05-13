import api from '../api';

import type { ActivityRequest, Activity } from '@/stores/activity/interface/activity.interface'

const createActivity = (payload: ActivityRequest) => api.post('/api/activity', payload)

const fetchActivity = () => api.get('/api/activity')

const updateActivity = (payload: Activity) => api.put(`/api/activity/${payload.id}`, payload)

const deleteActivity = (id: number) => api.delete(`/api/activity/${id}`)

export default {
    createActivity,
    fetchActivity,
    updateActivity,
    deleteActivity,
}