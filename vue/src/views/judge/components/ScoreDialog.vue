<script setup lang="ts">
import { onMounted, reactive, ref, computed } from 'vue';
import type { ScoreRequest, Score } from '@/stores/score/interface/score.interface';
import { criteriaStore } from '@/stores/criteria/criteria';
import { scoreStore } from '@/stores/score/score';
import { storeToRefs } from 'pinia';

const useCriteriaStore = criteriaStore();
const useScoreStore = scoreStore();
// const { criterias } = storeToRefs(useCriteriaStore);
const { createScore, createSubScore, getParticipantScore } = useScoreStore;
const { scores } = storeToRefs(useScoreStore);

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'submit', payload: {}, action: string): void;
}>();

onMounted(async () => {
    await getParticipantScore(props.participantId, props.subEventId);
    addTheScore();
});

interface Props {
    criterias: any;
    dialog: boolean;
    action: string;
    participantId: number;
    eventId: number;
    userId: number;
    subEventId: number;
}

let notify = ref(false);

const props = defineProps<Props>();

let payload = reactive({} as ScoreRequest);
const submitHandler = () => {
    emit('submit', payload, props.action);
};

let selectedButtonIndex = reactive({
    saved: null,
    error: null
});

const saveScore = async (participantId: number, criteriaId: number, score: number, index: any) => {
    if (score > 100) {
        selectedButtonIndex.error = index;
        selectedButtonIndex.saved = null;
    } else {
        const data = {
            participant_id: participantId,
            sub_criteria_id: criteriaId,
            sub_event_id: props.subEventId,
            score: score,
            user_id: props.userId,
            event_id: props.eventId
        };
        await createSubScore(data);
        selectedButtonIndex.saved = index;
        selectedButtonIndex.error = null;
    }
    // setTimeout(() => {
    //     notify.value = false;
    // }, 2000);
    // emit('close')
};

const addTheScore = () => {
    console.log(props.criterias);
    props.criterias.forEach((element, i) => {
        element.score = '';
        scores.value.forEach((e) => {
            if (element.id === e.sub_criteria_id) {
                element.score = e.score;
            }
        });
    });
};
</script>

<template>
    <v-row justify="center">
        <v-dialog v-model="props.dialog" persistent width="800">
            <v-card>
                <v-card-title>
                    <span class="text-h5">Scoring</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row v-for="(criteria, index) in criterias" :key="index">
                            <v-col cols="6" sm="6" md="6">
                                <v-text-field v-model="criteria.criteria" required readonly></v-text-field>
                            </v-col>
                            <v-col cols="2" sm="2" md="2">
                                <v-text-field label="%" v-model="criteria.percentage" required readonly></v-text-field>
                            </v-col>
                            <v-col cols="3" sm="3" md="2">
                                <v-text-field label="Score" placeholder="1-100" v-model="criteria.score" required></v-text-field>
                            </v-col>
                            <v-col cols="1" sm="1" md="1">
                                <v-btn
                                    class="mt-2 align-right"
                                    color="primary"
                                    @click="saveScore(participantId, criteria.id, criteria.score, index)"
                                    >Save
                                </v-btn>
                            </v-col>
                            <v-col cols="1" sm="1" md="1">
                                <v-icon class="mt-3 ml-2" v-if="selectedButtonIndex.saved === index" color="success">
                                    mdi-checkbox-marked-circle
                                </v-icon>
                                <v-icon class="mt-3 ml-2" v-if="selectedButtonIndex.error === index" color="error">
                                    mdi-close-circle
                                </v-icon>
                            </v-col>
                        </v-row>
                        <div style="text-align: center; z-index: 100">
                            <span
                                v-if="notify"
                                style="
                                    padding: 10px;
                                    border-radius: 7px;
                                    font-weight: 700;
                                    background-color: rgb(71, 235, 66);
                                    color: #fafafa;
                                "
                                >SAVED</span
                            >
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
