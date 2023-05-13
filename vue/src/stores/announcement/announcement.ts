import { defineStore } from 'pinia';

import announcement from '@/helper/api/services/announcement.service';

import type { AnnouncementRequest, Announcement } from './interface/announcement.interface';

export const announcementStore = defineStore('announcementStore', {
    state: () => {
        return {
            announcements: [] as Announcement[]
        };
    },
    actions: {
        async createAnnouncement(payload: AnnouncementRequest) {
            await announcement.createAnnouncement(payload);
        },
        async fetchAnnouncement() {
            const { data } = await announcement.fetchAnnouncement();
            this.announcements = data;
        },
        async updateAnnouncement(payload: Announcement) {
            await announcement.updateAnnouncement(payload);
        },
        async deleteAnnouncement(id: number) {
            await announcement.deleteAnnouncement(id);
        }
    }
});
