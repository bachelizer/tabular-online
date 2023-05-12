<script setup lang="ts">
import { ref, onMounted, reactive } from 'vue';
// import CriteriaForm from './CriteriaForm.vue';
import { storeToRefs } from 'pinia';
import { useRoute } from 'vue-router';
import { eventStore } from '@/stores/event/event';
import { criteriaStore } from '@/stores/criteria/criteria';
import ConfirmationDialog from '@/components/shared/ConfirmationDialog.vue';
import type { CriteriaRequest, Criteria } from '@/stores/criteria/interface/criteria.interface';
import SubEventCriteria from '../sub-events/SubEventCriteria.vue'

const useEventStore = eventStore();
const useCriteriaStore = criteriaStore();
const { getEvent, createSubEvent, showSubEvent, getSubEventCriteria } = useEventStore;
const { createCriteria, removeCriteria, updateCriteria } = useCriteriaStore;
const { subEvent } = storeToRefs(useEventStore);

interface Props {
    subEvents: any[];
}

const props = defineProps<Props>();

onMounted(async () => {
    await getEvent(Number(eventId.value));
});

let dialog = ref(false);
let action = ref('');
let payload = reactive({} as CriteriaRequest);
let confirmationDialog = ref(false);
let criteriaId = ref(0);
let error = ref(false)
const route = useRoute();
const eventId = ref(route.params.id);
let sub_event_id = ref(0)

const subEventDetails = reactive({
    sub_event_name: '',
    percentage: null,
})

const close = () => {
    dialog.value = false;
    getEvent(Number(eventId.value));
};

const fetchSubEventCriteria = (id: number) => {
    getSubEventCriteria(id)
    console.log(subEvent)
}

// const submitHandler = async (payload: {}, action: string) => {
//     if (action === 'create') {
//         const request = { ...payload, event_id: Number(eventId.value)}
//         await createCriteria(request);
//     } else {
//         console.log('update');
//         await updateCriteria(payload);
//     }
//     await getEvent(Number(eventId.value));
//     close();
// };

const confirmDelete = async (id: number) => {
    try {
        await removeCriteria(id);
        await getEvent(Number(eventId.value));
        confirmationDialog.value = false;
    } catch (e) {
        alert('Data has already reference to another table. Cant delete this data');
    }
};

const addSubEvent = async () => {
    if(!subEventDetails.percentage) {
        error.value = true
    }
    const payload = {
        event_id: Number(eventId.value),
        ...subEventDetails
    }
    await createSubEvent(payload);
    await getEvent(Number(eventId.value));
    subEventDetails.percentage = null;
    subEventDetails.sub_event_name = '';

}
</script>

<template>
    <v-col cols="12">
        <v-col cols="12" class="d-flex justify-end">
            <v-col cols="6">
                <v-row>
                    <span style="font-size: 12px; color: red;" class="mt-5" v-if="error">Invalid entry</span>
                    <v-text-field v-model="subEventDetails.sub_event_name" label="Sub Event Name" class="mr-2" required></v-text-field>
                    <v-text-field v-model="subEventDetails.percentage" label="Percentage"  class="mr-2" placeholder="00" required type="number"></v-text-field>
                    <v-btn icon variant="flat" color="primary" @click="addSubEvent()"> <PlusIcon stroke-width="1.5" size="20" /></v-btn>
                </v-row>
            </v-col>
        </v-col>

        <v-card>
            <v-table fixed-header class="mb-5">
                <thead>
                    <tr class="text-uppercase" style="">
                        <th class="text-left">Sub Event</th>
                        <th class="text-left">Percentage</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="sub in subEvents" :key="sub.id">
                        <td>
                            <strong>{{ sub.sub_event_name }}</strong>
                        </td>
                        <td>{{ sub.percentage }} %</td>
                        <td class="d-flex justify-space-around">
                            <v-btn color="primary" @click="dialog = true, sub_event_id = sub.id, fetchSubEventCriteria(sub.id)">sub-event criteria</v-btn>
                            <!-- <v-btn color="success">edit</v-btn> -->
                            <!-- <v-btn color="error" @click="">remove</v-btn> -->
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
       
        <!-- <CriteriaForm :action="action" v-if="dialog" :dialog="dialog" @close="close()" @submit="submitHandler" :payload="payload" /> -->
    </v-col>
    <SubEventCriteria class="mt-5" :subEvent="subEvent" :sub_event_id="sub_event_id" :dialog="dialog" @close="close()" :payload="payload"></SubEventCriteria>
    <ConfirmationDialog
        @submit="confirmDelete(criteriaId)"
        @close="confirmationDialog = false"
        :dialog="confirmationDialog"
        :action="'delete'"
        :title="'Remove'"
        :text="'Are you sure you want to remove this criteria?'"
    />
</template>
