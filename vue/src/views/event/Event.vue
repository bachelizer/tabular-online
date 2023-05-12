<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { eventStore } from '@/stores/event/event';
import { storeToRefs } from 'pinia';
import UiParentCard from '@/components/shared/UiParentCard.vue';
import ParticipantsView from '@/views/event/components/participants/ParticipantsView.vue';
import UsersView from './components/users/UsersView.vue';
// import CriteriaView from './components/criteria/CriteriaView.vue';
import SubEvent from './components/sub-events/SubEvent.vue';
import ScoreBoard from './components/score-board/ScoreBoard.vue';
import { useRoute } from 'vue-router';

onMounted(async () => {
    await getEvent(Number(eventId.value));
});

const route = useRoute();
const eventId = ref(route.params.id);
const useEventStore = eventStore();
const { getEvent } = useEventStore;
const { event } = storeToRefs(useEventStore);

let tabs = ref(null);
</script>

<template>
    <v-row>
        <v-col cols="12">
            <UiParentCard title="Event Management">
                <v-col cols="12">
                    <v-card-title class="ml-4 text-h6 text-md-h5 text-lg-h4">{{ event?.event_name }}</v-card-title>
                    <v-card-text>{{ event?.date }} </v-card-text>
                </v-col>

                <v-tabs v-model="tabs" fixed-tabs bg-color="indigo-darken-2">
                    <v-tab value="score-board"> Generation of Result </v-tab>
                    <v-tab value="participants"> Participants </v-tab>
                    <v-tab value="users"> Users </v-tab>
                    <!-- <v-tab value="criteria"> Criteria </v-tab> -->
                    <v-tab value="sub-events"> Sub Events </v-tab>
                </v-tabs>
                <v-window v-model="tabs">
                    <v-window-item value="score-board">
                        <v-card>
                            <!-- <v-card-text>score-board</v-card-text> -->
                            <ScoreBoard :criterias="event?.criterias"/>
                        </v-card>
                    </v-window-item>
                    <v-window-item value="participants">
                        <ParticipantsView :participants="event.participants" />
                    </v-window-item>
                    <v-window-item value="users">
                        <v-card>
                            <UsersView/>
                        </v-card>
                    </v-window-item>
                   <!--  <v-window-item value="criteria">
                        <v-card>
                            <CriteriaView :criterias="event?.criterias"/>
                        </v-card>
                    </v-window-item> -->
                    <v-window-item value="sub-events">
                        <v-card>
                            <SubEvent :subEvents="event.sub_events"/>
                        </v-card>
                    </v-window-item>
                </v-window>
            </UiParentCard>
        </v-col>
    </v-row>
</template>
