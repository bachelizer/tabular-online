<script setup lang="ts">
import { onMounted, ref } from 'vue';
import UiParentCard from '@/components/shared/UiParentCard.vue';
import { userStore } from '@/stores/user/user';
import { participantStore } from '@/stores/participant/participant';
import { criteriaStore } from '@/stores/criteria/criteria';
import ScoreDialog from './components/ScoreDialog.vue';
import { storeToRefs } from 'pinia';

const useUserStore = userStore();
const { user } = storeToRefs(useUserStore);
const { SignIn } = useUserStore;
const useParticipantStore = participantStore();
const { participants } = storeToRefs(useParticipantStore);
const { fetchEventParticipants } = useParticipantStore;
const useCriteriaStore = criteriaStore();
const { fetchEventCriteria } = useCriteriaStore;

onMounted(async () => {
    await SignIn();
    await Promise.all([mountParticipantsAndCriteria(user.value.event_id), fetchEventCriteria(user.value.event_id)]);
});

let dialog = ref(false);
let action = ref('');
let participantId = ref(0);
let eventId = ref(0);

const mountParticipantsAndCriteria = async (eventId: number) => {
    await fetchEventParticipants(eventId);
};

const close = () => {
    (dialog.value = false), fetchEventCriteria(user.value.event_id);
};

const submitHandler = (payload: {}, action: string) => {
    if (action === 'create') {
        console.log(payload, action);
    } else {
        console.log(action);
    }
};
</script>

<template>
    <UiParentCard v-if="Object.keys(user).length !== 0" :title="user.event.event_name">
        <v-col cols="12">
            <v-card-item class="py-3">
                <span class="text-h2">{{ user.full_name }}</span> <br />
                <span class="text-subtitle-1">{{ user.role.role }}</span>
            </v-card-item>
            <v-card>
                <v-table fixed-header>
                    <thead>
                        <tr class="text-uppercase">
                            <th class="text-left">Screen Name</th>
                            <th class="text-left">Full Name</th>
                            <th class="text-left">Number</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="participant in participants" :key="participant.id">
                            <td>{{ participant.screen_name }}</td>
                            <td>{{ participant.full_name }}</td>
                            <td>{{ participant.number }}</td>
                            <td>
                                <!-- <v-btn color="primary" @click="(dialog = true), (action = 'update')">view</v-btn> -->
                                <v-btn
                                    color="success"
                                    @click="
                                        (dialog = true),
                                            (action = 'create'),
                                            (participantId = participant.id),
                                            (eventId = participant.event_id)
                                    "
                                    >score</v-btn
                                >
                            </td>
                        </tr>
                    </tbody>
                    <ScoreDialog
                        v-if="dialog"
                        :dialog="dialog"
                        :action="action"
                        @close="close"
                        @submit="submitHandler"
                        :participantId="participantId"
                        :eventId="eventId"
                        :userId="user.id"
                    ></ScoreDialog>
                </v-table>
            </v-card>
        </v-col>
    </UiParentCard>
</template>
