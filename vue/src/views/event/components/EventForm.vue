<script setup lang="ts">
import { ref, reactive, onMounted } from 'vue';
import { eventStore } from '@/stores/event/event';
import type { EventRequest } from '@/stores/event/interface/event.interface';
import type { PropType } from 'vue';

const useEventStore = eventStore();
const { createEvent } = useEventStore;

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'submit', payload: {}, action: string): void;
}>();

interface Props {
    dialog: boolean;
    action: string;
}
const props = defineProps<{
    dialog: boolean;
    action: string;
    payload: EventRequest;
}>()

var showBtnSave = ref(props.action === 'create');
var showBtnPencil = ref(props.action === 'create');
let req = reactive(props.payload);

const submitHandler = () => {
    emit('submit', props.payload, props.action);
    // console.log(props.payload)
};
</script>

<template>
    <v-row justify="center">
        <v-dialog v-model="props.dialog" persistent width="1024">
            <v-card>
                <v-card-title>
                    <span class="text-h5">Event Details</span>
                    <v-btn
                        v-if="action !== 'create'"
                        @click="showBtnSave = true"
                        class="float-right"
                        icon
                        variant="flat"
                        color="primary"
                    >
                        <PencilIcon stroke-width="1.5" size="20"
                    /></v-btn>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12" sm="7" md="7">
                                <v-text-field
                                    label="Event Name"
                                    v-model="props.payload.event_name"
                                    required
                                    :readonly="props.action !== 'create' && !showBtnSave"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="3" md="3">
                                <v-text-field type="date" v-model="payload.date" required></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="2" md="2">
                                <v-switch color="primary" v-model="payload.is_active" label="Active"></v-switch>
                            </v-col>
                        </v-row>
                    </v-container>
                    <!-- <small>*indicates required field</small> -->
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="default" variant="text" @click="$emit('close')"> Close </v-btn>
                    <v-btn color="success" v-if="action === 'create' || showBtnSave" variant="text" @click="submitHandler()"> Save </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
