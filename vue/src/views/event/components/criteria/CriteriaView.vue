<script setup lang="ts">
import { ref, onMounted, reactive } from 'vue';
import CriteriaForm from './CriteriaForm.vue';
import { useRoute } from 'vue-router';
import { eventStore } from '@/stores/event/event';
import { criteriaStore } from '@/stores/criteria/criteria';
import ConfirmationDialog from '@/components/shared/ConfirmationDialog.vue'
import type { CriteriaRequest, Criteria } from '@/stores/criteria/interface/criteria.interface';

const useEventStore = eventStore();
const useCriteriaStore = criteriaStore();
const { getEvent } = useEventStore;
const { createCriteria, removeCriteria,updateCriteria } = useCriteriaStore;

interface Props {
    criterias: Criteria[];
}

const props = defineProps<Props>();

onMounted(async () => {
    await getEvent(Number(eventId.value));
});

let dialog = ref(false);
let action = ref('');
let payload = reactive({} as CriteriaRequest)
let confirmationDialog = ref(false);
let criteriaId = ref(0)
const route = useRoute();
const eventId = ref(route.params.id);

const close = () => {
    dialog.value = false;
};

const submitHandler = async (payload: {}, action: string) => {
    if (action === 'create') {
        const request = { ...payload, event_id: Number(eventId.value)}
        await createCriteria(request);
    } else {
        console.log('update');
        await updateCriteria(payload);
    }
    await getEvent(Number(eventId.value));
    close();
};

const confirmDelete = async (id:number) => {
    try {
        await removeCriteria(id)
        await getEvent(Number(eventId.value));
        confirmationDialog.value = false;
    } catch(e) {
        alert('Data has already reference to another table. Cant delete this data')
    }
}
</script>

<template>
    <v-col cols="12">
        <v-col class="text-right">
            <v-btn icon variant="flat" color="primary" @click="(dialog = true), (action = 'create'), (payload = {} as CriteriaRequest)">
                <PlusIcon stroke-width="1.5" size="20"
            /></v-btn>
        </v-col>

        <v-card>
            <v-table fixed-header class="mb-5">
                <thead>
                    <tr class="text-uppercase" style="">
                        <th class="text-left">Description</th>
                        <th class="text-left">Percentage</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="criteria in props.criterias" :key="criteria.id">
                        <td>{{ criteria.criteria }}</td>
                        <td>{{ criteria.percentage }}</td>
                        <td class="d-flex justify-space-around">
                            <v-btn color="primary"  @click="(dialog = true), (action = 'update'), (payload = criteria)">view</v-btn>
                            <!-- <v-btn color="success">edit</v-btn> -->
                            <v-btn color="error"  @click="confirmationDialog = true, criteriaId = criteria.id">remove</v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>

        <CriteriaForm :action="action" v-if="dialog" :dialog="dialog" @close="close()" @submit="submitHandler" :payload="payload" />
    </v-col>
    <ConfirmationDialog @submit="confirmDelete(criteriaId)" @close="confirmationDialog = false" :dialog="confirmationDialog" :action="'delete'" :title="'Remove'" :text="'Are you sure you want to remove this criteria?'"/>

</template>
