<script setup lang="ts">
import { ref } from 'vue';
import ParticipantsForm from '@/views/event/components/participants/ParticipantsForm.vue';
import { participantStore } from '@/stores/participant/participant';
import type { ParticipantRequest, Participant } from '@/stores/participant/interface/participant.interface';
import { useRoute } from 'vue-router';

interface Props {
    participants: Participant[];
}

const props = defineProps<Props>();

let dialog = ref(false);
let action = ref('');
const route = useRoute();
const useParticipantStore = participantStore();
const { createParticipant } = useParticipantStore;
const eventId = ref(route.params.id);

const close = () => {
    dialog.value = false;
};

const submitHandler = (payload: {}, action: string) => {
    if (action === 'create') {
        const request = { ...payload, event_id: Number(eventId.value) };
        createParticipant(request);
    } else {
        console.log('update');
    }
};
</script>

<template>
    <v-col cols="12">
        <v-col class="text-right">
            <v-btn icon variant="flat" color="primary" @click="dialog = true, action='create'"> <PlusIcon stroke-width="1.5" size="20" /></v-btn>
        </v-col>

        <v-card>
            <v-table fixed-header>
                <thead>
                    <tr class="font-weight-bold text-uppercase" style="">
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
                        <td class="d-flex justify-space-around"><v-btn color="primary">view</v-btn>
                            <v-btn color="success">edit</v-btn>
                            <v-btn color="error">remove</v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>

        <ParticipantsForm :action="action" v-if="dialog" :dialog="dialog" @close="close()" @submit="submitHandler" />
    </v-col>
</template>
