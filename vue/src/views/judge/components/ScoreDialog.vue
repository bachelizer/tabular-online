<script setup lang="ts">
import { onMounted, reactive, ref, computed } from 'vue';
import type { ScoreRequest, Score } from '@/stores/score/interface/score.interface';
import { criteriaStore } from '@/stores/criteria/criteria';
import { scoreStore } from '@/stores/score/score';
import { storeToRefs } from 'pinia';

const useCriteriaStore = criteriaStore();
const useScoreStore = scoreStore();
const { criterias } = storeToRefs(useCriteriaStore);
const { createScore, getParticipantScore } = useScoreStore;
const { scores } = storeToRefs(useScoreStore);

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'submit', payload: {}, action: string): void;
}>();

onMounted(async () => {
    await getParticipantScore(props.participantId);
    addTheScore();
});

interface Props {
    dialog: boolean;
    action: string;
    participantId: number;
    eventId: number;
    userId: number;
}

let notify = ref(false)

const props = defineProps<Props>();

let payload = reactive({} as ScoreRequest);
const submitHandler = () => {
    emit('submit', payload, props.action);
};

const saveScore = async (participantId: number, criteriaId: number, score: number, userId: number, eventId: number) => {
    notify.value = true
    const data: ScoreRequest = {
        participant_id: participantId,
        criteria_id: criteriaId,
        score: score,
        user_id: userId,
        event_id: eventId
    };
    await createScore(data);
    setTimeout(() => { notify.value = false }, 2000)
    // emit('close')
};

const addTheScore = () => {
    criterias.value.forEach((element, i) => {
        element.score = '';
        scores.value.forEach((e) => {
            if (element.id === e.criteria_id) {
                element.score = e.score;
            }
        });
    });
};

const scoreRaw = (data: any) => {
    return data ? data :'';
}

</script>

<template>
    <v-row justify="center">
        <v-dialog v-model="props.dialog" persistent width="600">
            <v-card>
                <v-card-title>
                    <span class="text-h5">Scoring</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row v-for="criteria in criterias" :key="criteria.id">
                            <v-col cols="5" sm="5" md="5">
                                <v-text-field label="description" v-model="criteria.criteria" required readonly></v-text-field>
                            </v-col>
                            <v-col cols="2" sm="2" md="2">
                                <v-text-field label="%" v-model="criteria.percentage" required readonly></v-text-field>
                            </v-col>
                            <v-col cols="3" sm="3" md="3">
                                <v-text-field label="Score" placeholder="1-100" v-model="criteria.score" required></v-text-field>
                            </v-col>
                            <v-col cols="1" sm="1" md="1">
                                <v-btn
                                    class="mt-2 align-right"
                                    color="primary"
                                    @click="saveScore(participantId, criteria.id, criteria.score, userId, eventId)"
                                    >Save</v-btn
                                >
                            </v-col>
                        </v-row>
                        <div style="text-align: center; z-index: 100; ">
                            <span v-if="notify" style="padding: 10px; border-radius: 7px; font-weight: 700; background-color: rgb(71, 235, 66); color: #fafafa;">SAVED</span>
                        </div>
                        
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="default" variant="text" @click="$emit('close')"> Close </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
