<script setup lang="ts">
import { ref, reactive } from 'vue';
import { eventStore } from '@/stores/event/event';
import type { EventRequest } from '@/stores/event/interface/event.interface'

const emit = defineEmits<{
    (e: 'close'): void;
}>();

interface Props {
    dialog: boolean;
}

const useEventStore = eventStore();
const { createEvent } = useEventStore;

/** let date = ref(Date);
let event_name = ref('');
let is_active = ref(true); **/

let payload = reactive({} as EventRequest);

const props = defineProps<Props>();

const submitHandler = () => {
    createEvent(payload);
}
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
                            <v-col cols="12" sm="7" md="7">
                                <v-text-field label="Event Name" v-model="payload.event_name" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="3" md="3">
                                <v-text-field type="date" v-model="payload.date" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="2" md="2">
                              <v-switch color="primary" v-model="payload.is_active" label="Active"></v-switch>
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
