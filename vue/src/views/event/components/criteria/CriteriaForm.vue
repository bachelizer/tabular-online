<script setup lang="ts">
import { ref, reactive, toRaw } from 'vue';
import { toRefs } from '@vue/reactivity';
import type { CriteriaRequest } from '@/stores/criteria/interface/criteria.interface';

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'submit', payload: {}, action: string): void;
}>();

interface Props {
    dialog: boolean;
    action: string;
    payload: CriteriaRequest;
}
// let payload = reactive({} as CriteriaRequest);
const props = defineProps<Props>();

let payload = reactive(toRaw(props.payload)) as CriteriaRequest ;

let showBtnSave = ref(props.action === "create");

let showBtnPencil = ref(props.action === "create");

let req = reactive(payload)

const submitHandler = () => {
    emit('submit', req, props.action)
};
</script>

<template>
    <v-row justify="center">
        <v-dialog v-model="props.dialog" persistent width="1024">
            <v-card>
                <v-card-title>
                    <span class="text-h5">Criteria Details</span>
                    <v-btn v-if="!showBtnPencil" @click="showBtnSave = true" class="float-right" icon variant="flat" color="primary"> <PencilIcon stroke-width="1.5" size="20" /></v-btn>

                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="10" sm="8" md="8">
                                <v-text-field label="Criteria Description" :readonly="!showBtnSave" v-model="payload.criteria" required></v-text-field>
                            </v-col>
                            <v-col cols="2" sm="4" md="4">
                                <v-text-field label="Percentage: % out 0f 100" :readonly="!showBtnSave" v-model="payload.percentage" required></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                    <!-- <small>*indicates required field</small> -->
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="default" variant="text" @click="$emit('close')"> Close </v-btn>
                    <v-btn color="success" v-if="showBtnSave" variant="text" @click="submitHandler()"> Save </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
