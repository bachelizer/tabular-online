<script setup lang="ts">
import { ref, reactive } from 'vue';
import type { ParticipantRequest } from '@/stores/participant/interface/participant.interface';
import { PencilIcon } from 'vue-tabler-icons';

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'submit', payload: {}, action: string): void;
}>();

interface Props {
    dialog: boolean;
    action: string;
    payload: ParticipantRequest;
}

const props = defineProps<Props>();

let showBtnSave = ref(props.action === "create");

let showBtnPencil = ref(props.action === "create");

let req = reactive(props.payload)


const submitHandler = () => {
    emit('submit', req, props.action);
};
</script>

<template>
    <v-row justify="center">
        <v-dialog v-model="props.dialog" persistent width="1024">
            <v-card>
                <v-card-title>
                    <span class="text-h5">Event Details</span>
                    <v-btn v-if="!showBtnPencil" @click="showBtnSave = true" class="float-right" icon variant="flat" color="primary"> <PencilIcon stroke-width="1.5" size="20" /></v-btn>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="3" md="3">
                                <v-text-field label="Screen Name" :readonly="!showBtnSave" v-model="req.screen_name" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="5" md="5">
                                <v-text-field label="Full Name" :readonly="!showBtnSave" v-model="req.full_name" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="2" md="2">
                                <v-select :items="['Male', 'Female']" label="Gender" v-model="req.gender">

                                </v-select>
                            </v-col>
                            <v-col cols="12" sm="2" md="2">
                                <v-text-field label="Number" :readonly="!showBtnSave" v-model="req.number" required></v-text-field>
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
