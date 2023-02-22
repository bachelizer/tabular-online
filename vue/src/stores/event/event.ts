import { defineStore } from 'pinia';

import event from '../../helper/api/services/event.services';
import type { Event } from './interface/event.interface';

export const eventStore = defineStore('eventStore', {
    state: () => {
        return {
            events: [] as Event[],
            event: null as Event | null,
        };
    },
    actions: {
        async fetchEvents() {
            const { data } = await event.fetchEvents();
            this.events = data;
        },
        async createEvent(payload: Event)
        {
            await event.createEvent(payload);
        },
        async getEvent(id: number) {
            const { data } = await event.getEvent(id)
            this.event = data;
        }
    },
    getters: {}
});
