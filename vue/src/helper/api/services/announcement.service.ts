import api from '../api';

import type { AnnouncementRequest, Announcement } from '@/stores/announcement/interface/announcement.interface';

const createAnnouncement = (payload: AnnouncementRequest) => api.post('/api/announcement', payload);

const fetchAnnouncement = () => api.get('/api/announcement');

const updateAnnouncement = (payload: Announcement) => api.put(`/api/announcement/${payload.id}`, payload);

const deleteAnnouncement = (id: number) => api.delete(`/api/announcement/${id}`);

export default {
    createAnnouncement,
    fetchAnnouncement,
    updateAnnouncement,
    deleteAnnouncement
};
