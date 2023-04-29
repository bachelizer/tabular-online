import { defineStore } from 'pinia';

import event from '../../helper/api/services/event.services';
import type { Event, EventRequest } from './interface/event.interface';

export const eventStore = defineStore('eventStore', {
    state: () => {
        return {
            events: [] as Event[],
            event: null as Event | null,
        };
    },
    actions: {
        async fetchEventsActive() {
            const { data } = await event.fetchEventsActive(true);
            this.events = data;
        },
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
        },
        async updateEvent(payload: EventRequest) {
            await event.updateEvent(payload)
        }
    },
    getters: {}
});
