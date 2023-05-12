<script setup lang="ts">
import { ref, reactive } from 'vue';
import { useRoute } from 'vue-router';
// import type { ParticipantRequest } from '@/stores/participant/interface/participant.interface';
// import { PencilIcon } from 'vue-tabler-icons';
import { eventStore } from '@/stores/event/event';

const useEventStore = eventStore();

const { createSubEventCriteria, getSubEventCriteria } = useEventStore;

const emit = defineEmits<{
    (e: 'close'): void;
    // (e: 'submit', payload: {}, action: string): void;
}>();

interface Props {
    dialog: boolean;
    sub_event_id: number;
    subEvent: any;
    // payload: ParticipantRequest;
}

const props = defineProps<Props>();

let error = ref(false);

let subCriteriaDetails = reactive({
    criteria: '',
    percentage: null
});

const route = useRoute();
const eventId = ref(route.params.id);

// let req = reactive(props.payload)

const submitHandler = () => {
    if (!subCriteriaDetails.percentage) {
        error.value = true;
    } else {
        const payload = {
            event_id: Number(eventId.value),
            sub_event_id: props.sub_event_id,
            criteria: subCriteriaDetails.criteria,
            percentage: subCriteriaDetails.percentage
        };
        createSubEventCriteria(payload)
        props.subEvent.criterias.push(payload)
        close()
    }
};

const close = () => {
    (subCriteriaDetails.criteria = ''), (subCriteriaDetails.percentage = null);
};
</script>

<template>
    <v-row justify="center">
        <v-dialog v-model="props.dialog" persistent width="500">
            <v-card>
                <v-card-title>
                    <span class="text-h5">Sub Event Criteria</span>
                </v-card-title>

                <v-card-text>
                    <span style="font-size: 12px; color: red" v-if="error">Invalid Entry</span>
                    <v-container>
                        <v-row>
                            <v-col cols="6">
                                <v-text-field v-model="subCriteriaDetails.criteria" label="Criteria" required></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field
                                v-model="subCriteriaDetails.percentage"
                                label="%"
                                placeholder="00"
                                type="number"
                                required
                            ></v-text-field>
                            </v-col>
                            <v-btn color="success" class="mt-5" @click="submitHandler()"> Add </v-btn>
                        </v-row>
                        <v-table fixed-header class="mb-5 table-striped">
                <tbody>
                    <tr v-for="item in subEvent.criterias" :key="item.id">
                        <td>{{ item.criteria }}</td>
                        <td>{{ item.percentage }} %</td>
                    </tr>
                </tbody>
            </v-table>
                    </v-container>
                    <!-- <small>*indicates required field</small> -->
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="default" variant="text" @click="$emit('close'), close()"> Close </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
