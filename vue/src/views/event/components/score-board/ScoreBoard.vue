<script setup lang="ts">
// https://morioh.com/p/46b2f7907581 datatable tutorial
import { onMounted, reactive, ref } from 'vue';
import { participantStore } from '@/stores/participant/participant';
import { scoreStore } from '@/stores/score/score';
import { storeToRefs } from 'pinia';
import { useRoute } from 'vue-router';
import type { Criteria } from '@/stores/criteria/interface/criteria.interface';
// import merge from '@/helper/util/merge'
import { reportStore } from '@/stores/report/report';
import { userStore } from '@/stores/user/user';

const useParticipantStore = participantStore();
const useScoreStore = scoreStore();
const useReportStore = reportStore();
const useUserStore = userStore();
const { getParticipantsTotalScore, fetchEventParticipants } = useScoreStore
const { participants } = storeToRefs(useParticipantStore);
const { participantScore, normalizeParticipant } = storeToRefs(useScoreStore);
const { scoreSummary, generateJudgesScoring, individualScoring } = useReportStore;
const { fetchEventUser } = useUserStore;

interface Props {
    criterias: Criteria[];
}

const props = defineProps<Props>();

const route = useRoute();
const eventId = ref(route.params.id);

const normalize = () => {
    console.log(normalizeParticipant)
};

const generateFinalResult = () => {
    // generateFinalPdf(normalizeParticipant.value, Number(eventId.value));
    // console.log(normalizeParticipant.value)
    scoreSummary(Number(eventId.value));
}

const generateJudgesScoringResult = async () => {
    await fetchEventUser(Number(eventId.value));
    // generateJudgesScoring(Number(eventId.value))
    individualScoring(Number(eventId.value));
}

onMounted(async () => {
    await getParticipantsTotalScore(Number(eventId.value))
    normalize()
});
</script>

<template>
    <v-col cols="12">
        <v-btn class="mx-2" color="primary" size="small" @click="generateFinalResult">final result</v-btn>
        <v-btn class="mx-2" color="primary" size="small" @click="generateJudgesScoringResult">judges scoring</v-btn>
        <!-- <v-btn class="mx-2" color="primary" size="small">report 3</v-btn> -->
    </v-col>
    <v-table fixed-header height="300px">
        <thead>
            <tr>
                <th class="text-left">Number</th>
                <th class="text-left">Screen Name</th>
                <th class="text-left">Full Name</th>
                <th class="text-left">Gender</th>
                <th v-for="criteria in props.criterias" :key="criteria.id">{{ criteria.criteria }} / {{ criteria.percentage }}%</th>
                <th class="text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="participant in normalizeParticipant" :key="participant.id">
                <td>{{ participant.number }}</td>
                <td>{{ participant.screen_name }}</td>
                <td>{{ participant.full_name }}</td>
                <td>{{ participant.gender }}</td>
                <td v-for="criteria in props.criterias" :key="criteria.id">
                    <template v-for="score in participant.percent_score">
                        <span v-if="score.criteria_id === criteria.id">
                            {{ score.percent_score }} %
                        </span>
                    </template>
                </td>
                <td><strong style="color: red;">{{ participant.percent_score[0].total_percent_score }} %</strong></td>
            </tr>
        </tbody>
    </v-table>
</template>
