<script setup lang="ts">
import { reactive, ref } from 'vue';
import ParticipantsForm from '@/views/event/components/participants/ParticipantsForm.vue';
import ConfirmationDialog from '@/components/shared/ConfirmationDialog.vue';
import { participantStore } from '@/stores/participant/participant';
import type { Participant, ParticipantRequest } from '@/stores/participant/interface/participant.interface';
import { useRoute } from 'vue-router';
import { eventStore } from '@/stores/event/event';

const useEventStore = eventStore();
const { getEvent } = useEventStore;

interface Props {
    participants: Participant[];
}

const props = defineProps<Props>();

let dialog = ref(false);
let confirmationDialog = ref(false);
let action = ref('');
let payload = reactive({} as ParticipantRequest);
let participantId = ref(0);
const route = useRoute();
const useParticipantStore = participantStore();
const { createParticipant, updateParticipant, removeParticipant } = useParticipantStore;
const eventId = ref(route.params.id);

const close = () => {
    dialog.value = false;
};

const submitHandler = async (payload: {}, action: string) => {
    if (action === 'create') {
        const request = { ...payload, event_id: Number(eventId.value) };
        await createParticipant(request);
    } else {
        await updateParticipant(payload);
    }
    await getEvent(Number(eventId.value));
    close();
};

const confirmDelete = async (id: number) => {
    try {
        await removeParticipant(id);
        getEvent(Number(eventId.value));
        confirmationDialog.value = false;
    } catch (e) {
        alert('participant has existing score.');
    }
};
</script>

<template>
    <v-col cols="12">
        <v-col class="text-right">
            <v-btn icon variant="flat" color="primary" @click="(dialog = true), (action = 'create'), (payload = {} as ParticipantRequest)">
                <PlusIcon stroke-width="1.5" size="20"
            /></v-btn>
        </v-col>

        <v-card>
            <v-table fixed-header class="mb-5">
                <thead>
                    <tr class="text-uppercase">
                        <th class="text-left">Screen Name</th>
                        <th class="text-left">Full Name</th>
                        <th class="text-left">Number</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="participant in props.participants" :key="participant.id">
                        <td>{{ participant.screen_name }}</td>
                        <td>{{ participant.full_name }}</td>
                        <td>{{ participant.number }}</td>
                        <td class="d-flex justify-space-around">
                            <v-btn color="primary" @click="(dialog = true), (action = 'update'), (payload = participant)">view</v-btn>
                            <!-- <v-btn color="success">edit</v-btn> -->
                            <v-btn color="error" @click="(confirmationDialog = true), (participantId = participant.id)">remove</v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
    </v-col>
    <ParticipantsForm :action="action" v-if="dialog" :dialog="dialog" @close="close()" @submit="submitHandler" :payload="payload" />
    <ConfirmationDialog
        @submit="confirmDelete(participantId)"
        @close="confirmationDialog = false"
        :dialog="confirmationDialog"
        :action="'delete'"
        :title="'Remove'"
        :text="'Are you sure you want to remove this participant?'"
    />
</template>
