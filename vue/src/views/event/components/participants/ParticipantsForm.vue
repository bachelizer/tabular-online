<script setup lang="ts">
import { ref, reactive } from 'vue';
import type { ParticipantRequest } from '@/stores/participant/interface/participant.interface'

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'submit', payload: {}, action: string): void;
}>();

interface Props {
    dialog: boolean;
    action: string;
}

let payload = reactive({} as ParticipantRequest);

const props = defineProps<Props>();
const submitHandler = () => {
    emit('submit', payload, props.action)
};
</script>

<template>
    <v-row justify="center">
        <v-dialog v-model="props.dialog" persistent width="1024">
            <v-card>
                <v-card-title>
                    <span class="text-h5">Event Details</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="5" md="5">
                                <v-text-field label="Screen Name" v-model="payload.screen_name" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="5" md="5">
                                <v-text-field label="Full Name" v-model="payload.full_name" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="2" md="2">
                                <v-text-field label="Number" v-model="payload.number" required></v-text-field>
                            </v-col>
                        </v-row>
                    </v-container>
                    <small>*indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="default" variant="text" @click="$emit('close')"> Close </v-btn>
                    <v-btn color="success" variant="text" @click="submitHandler()"> Save </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
