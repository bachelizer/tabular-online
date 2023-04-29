<script setup lang="ts">
import { ref, onMounted, reactive } from 'vue';
import { eventStore } from '@/stores/event/event';
import { storeToRefs } from 'pinia';
import UiParentCard from '@/components/shared/UiParentCard.vue';
import { PlusIcon, EditIcon, SettingsIcon } from 'vue-tabler-icons';
import EventForm from '@/views/event/components/EventForm.vue';
import type { EventRequest } from '@/stores/event/interface/event.interface';
import { useRoute } from 'vue-router';
import { router } from '@/router';

const route = useRoute();
const useEventStore = eventStore();
const { fetchEvents, getEvent, createEvent, updateEvent, fetchEventsActive } = useEventStore;
const { events, event } = storeToRefs(useEventStore);

onMounted(() => {
    fetchEvents();
    activeSwitch();
});
let dialog = ref(false);
let showInactive = ref(true)
let action = ref('');
let payload = reactive({} as EventRequest);
let eventList = reactive(events)

const closeModal = () => {
    router.go(0);
    dialog.value = false;
};

const submitHandler = async (payload: {}, action: string) => {
    if (action === 'create') {
        await createEvent(payload);
    } else {
        await updateEvent(payload)
    }
    closeModal();
    fetchEvents();
};

const activeSwitch = async() => {
    let b = showInactive.value = !showInactive.value
    if(!b) {
       await fetchEventsActive()
    } else if(b) {
       await fetchEvents();
    }
    else {
        null
    }
}
</script>

<template>
    <v-row justify="end" class="mb-5">
        <v-col cols="7" md="3">
            <v-row class="mx-3 mt-2">
                <v-switch color="primary" :model="showInactive" @change="activeSwitch()" label="Show Inactive event"></v-switch>
                <v-btn icon variant="flat" color="primary" @click="(action = 'create'), (dialog = true), (payload)"> <PlusIcon stroke-width="1.5" size="20" /></v-btn>
            </v-row>
        </v-col>
    </v-row>
    <v-row>
        <v-col v-for="event in eventList" :key="event.id" cols="12" md="6">
            <UiParentCard :title="event.event_name" :style="!event.is_active ? 'background-color: #E0E0E0;': ''">
                <template v-slot:action>
                    <!-- <RouterLink :to="{ name: 'EventManagement', params: { id: event.id }}"  icon variant="outlined" color="success" class="mr-3"><SettingsIcon stroke-width="1.5" size="20"
                    /></RouterLink> -->
                    <v-btn :to="{ name: 'EventManagement', params: { id: event.id } }" icon variant="outlined" color="success" class="mr-3"
                        ><SettingsIcon stroke-width="1.5" size="20"
                    /></v-btn>
                    <v-btn icon @click="(action = 'update'), (payload = event), (dialog = true)" variant="outlined" color="warning" class="mr-3"
                        ><EditIcon stroke-width="1.5" size="20"
                    /></v-btn>
                </template>
                <div class="px-7 mb-2">
                    <p class="text-body-1">Event Date: {{ event.date }}</p>
                </div>
            </UiParentCard>
        </v-col>
    </v-row>
    <EventForm @submit="submitHandler" @close="closeModal" :dialog="dialog" :action="action" :payload="payload" />
</template>
