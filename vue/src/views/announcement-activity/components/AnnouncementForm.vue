<script setup lang="ts">
import { ref, reactive } from 'vue';
import type { AnnouncementRequest } from '@/stores/announcement/interface/announcement.interface';
import { PencilIcon } from 'vue-tabler-icons';

const emit = defineEmits<{
    (e: 'close'): void;
    (e: 'submit', payload: {}, action: string): void;
}>();

interface Props {
    dialog: boolean;
    action: string;
    payload: AnnouncementRequest;
}

const props = defineProps<Props>();

let showBtnSave = ref(props.action === 'create');

let showBtnPencil = ref(props.action === 'create');

let req = reactive(props.payload);

const submitHandler = () => {
    emit('submit', req, props.action);
};
</script>

<template>
    <v-row justify="center">
        <v-dialog v-model="props.dialog" persistent width="500">
            <v-card>
                <v-card-title>
                    <span class="text-h5">Announcement Details</span>
                    <!-- <v-btn v-if="!showBtnPencil" @click="showBtnSave = true" class="float-right" icon variant="flat" color="primary"> <PencilIcon stroke-width="1.5" size="20" /></v-btn> -->
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field label="Title" v-model="req.title" required></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-textarea label="Details" v-model="req.details" required></v-textarea>
                            </v-col>
                            <!-- <v-col cols="12" sm="2" md="2">
                                <v-text-field label="Number" :readonly="!showBtnSave" v-model="req.is_active" required></v-text-field>
                            </v-col> -->
                        </v-row>
                    </v-container>
                    <!-- <small>*indicates required field</small> -->
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
