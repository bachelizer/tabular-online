<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { eventStore } from '@/stores/event/event';
import { storeToRefs } from 'pinia';
import UiParentCard from '@/components/shared/UiParentCard.vue';
import { PlusIcon, EditIcon, SettingsIcon } from 'vue-tabler-icons';
import EventForm from '@/views/event/components/EventForm.vue';

const useEventStore = eventStore();
const { fetchEvents, getEvent } = useEventStore;
const { events, event } = storeToRefs(useEventStore);

onMounted(() => {
    fetchEvents();
});
let dialog = ref(false);

const eventModal = () => {
    dialog.value = true;
};

const closeModal = () => {
    dialog.value = false;
};

const theEvent = async (id: number) => {
    await getEvent(id);
    console.log(event.value);
};
</script>
<template>
    <v-row justify="end" class="mb-5">
        <v-col cols="7" md="3">
            <v-row class="mx-3 mt-2">
                <v-switch color="primary" :model-value="true" label="Show Active"></v-switch>
                <v-btn icon variant="flat" color="primary" @click="eventModal"> <PlusIcon stroke-width="1.5" size="20" /></v-btn>
            </v-row>
        </v-col>
    </v-row>
    <v-row>
        <v-col v-for="event in events" :key="event.id" cols="12" md="6">
            <UiParentCard :title="event.event_name">
                <template v-slot:action>
                    <!-- <RouterLink :to="{ name: 'EventManagement', params: { id: event.id }}"  icon variant="outlined" color="success" class="mr-3"><SettingsIcon stroke-width="1.5" size="20"
                    /></RouterLink> -->
                    <v-btn :to="{ name: 'EventManagement', params: { id: event.id } }" icon variant="outlined" color="success" class="mr-3"
                        ><SettingsIcon stroke-width="1.5" size="20"
                    /></v-btn>
                    <v-btn icon variant="outlined" color="warning" class="mr-3"><EditIcon stroke-width="1.5" size="20" /></v-btn>
                </template>
                <div class="px-7 mb-2">
                    <p class="text-body-1">Event Date: {{ event.date }}</p>
                </div>
            </UiParentCard>
        </v-col>
    </v-row>
    <EventForm @close="closeModal()" :dialog="dialog" />
</template>
