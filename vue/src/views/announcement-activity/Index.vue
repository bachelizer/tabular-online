<script setup lang="ts">
import { storeToRefs } from 'pinia';
import { ref, reactive, onMounted } from 'vue';
import UiParentCard from '@/components/shared/UiParentCard.vue';
import ActivityForm from './components/ActivityForm.vue';
import AnnouncementForm from './components/AnnouncementForm.vue';
import { announcementStore } from '@/stores/announcement/announcement';
import { activityStore } from '@/stores/activity/activity';
import ConfirmationDialog from '@/components/shared/ConfirmationDialog.vue';
import { authStore } from '@/stores/auth/auth';

import type { ActivityRequest, Activity } from '../../stores/activity/interface/activity.interface';
import type { AnnouncementRequest, Announcement } from '../../stores/announcement/interface/announcement.interface';

const useAnnouncementStore = announcementStore();
const useActivityStore = activityStore();
const useAuthStore = authStore();

const { createAnnouncement, updateAnnouncement, fetchAnnouncement, deleteAnnouncement } = useAnnouncementStore;
const { createActivity, updateActivity, fetchActivity, deleteActivity } = useActivityStore;
const { announcements } = storeToRefs(useAnnouncementStore);
const { activities } = storeToRefs(useActivityStore);
const { userAccount } = storeToRefs(useAuthStore);

let dialogActivity = ref(false);
let dialogAnnouncement = ref(false);

let activityAction = ref('');
let announcementAction = ref('');

let activityId = ref(0);
let announcementId = ref(0);

let payloadActivity = reactive({} as ActivityRequest);
let payloadAnnouncement = reactive({} as AnnouncementRequest);

let announcementConfirmationDialog = ref(false);
let activityConfirmationDialog = ref(false);

let isAdmin = userAccount.value?.role.role == 'Admin';

onMounted(async () => {
    await fetchActivity();
    await fetchAnnouncement();
});

const closeActivity = () => (dialogActivity.value = false);
const closeAnnouncement = () => (dialogAnnouncement.value = false);

const submitActivity = async (payload: {}, action: string) => {
    if (action === 'create') {
        const req = payload;
        await createActivity(req);
        // console.log(req);
    } else {
        await updateActivity(payload);
    }
    await fetchActivity();
    dialogActivity.value = false;
};

const submitAnnouncement = async (payload: {}, action: string) => {
    if (action === 'create') {
        const req = payload;
        await createAnnouncement(req);
        // console.log(req);
    } else {
        await updateAnnouncement(payload);
    }
    await fetchAnnouncement();
    dialogAnnouncement.value = false;
};

const deleteActivityFn = async (id: number) => {
    await deleteActivity(id);
    activityConfirmationDialog.value = false;
    await fetchActivity();
};

const deleteAnnouncementFn = async (id: number) => {
    await deleteAnnouncement(id);
    announcementConfirmationDialog.value = false;
    await fetchAnnouncement();
};
</script>
<template>
    <v-row>
        <v-col cols="6">
            <UiParentCard title="Announcements">
                <template v-slot:action>
                    <v-btn
                        v-if="isAdmin"
                        @click="
                            (dialogAnnouncement = true), (announcementAction = 'create'), (payloadAnnouncement = {} as AnnouncementRequest)
                        "
                        icon
                        variant="flat"
                        color="primary"
                        class="mr-5"
                    >
                        <PlusIcon stroke-width="1.5" size="20"
                    /></v-btn>
                </template>
                <v-col cols="12">
                    <v-card v-for="item in announcements" :key="item.id" variant="tonal" class="mb-2">
                        <v-card-title class="text-h5 px-5 pt-2">
                            {{ item.title }}
                            <div class="float-right" v-if="isAdmin">
                                <v-btn
                                    @click="(dialogAnnouncement = true), (announcementAction = 'update'), (payloadAnnouncement = item)"
                                    icon
                                    variant="flat"
                                    class="mr-5"
                                    ><PencilIcon stroke-width="1.5" size="20"
                                /></v-btn>
                                <v-btn
                                    @click="(announcementId = item.id), (announcementConfirmationDialog = true)"
                                    icon
                                    variant="flat"
                                    class="mr-5"
                                    ><TrashIcon stroke-width="1.5" size="20"
                                /></v-btn>
                            </div>
                        </v-card-title>
                        <v-card-text> {{ item.details }} </v-card-text>
                    </v-card>
                </v-col>
            </UiParentCard>
        </v-col>

        <!-- Activities -->
        <v-col cols="6">
            <UiParentCard title="Schedule of Activities">
                <template v-slot:action>
                    <v-btn
                        v-if="isAdmin"
                        @click="(dialogActivity = true), (activityAction = 'create'), (payloadActivity = {} as ActivityRequest)"
                        icon
                        variant="flat"
                        color="primary"
                        class="mr-5"
                    >
                        <PlusIcon stroke-width="1.5" size="20"
                    /></v-btn>
                </template>
                <v-col cols="12">
                    <v-card v-for="item in activities" :key="item.id" variant="tonal" class="mb-2">
                        <v-card-title class="text-h5 px-5 pt-2">
                            {{ item.title }}
                            <div class="float-right" v-if="isAdmin">
                                <v-btn
                                    @click="(dialogActivity = true), (activityAction = 'update'), (payloadActivity = item)"
                                    icon
                                    variant="flat"
                                    class="mr-5"
                                    ><PencilIcon stroke-width="1.5" size="20"
                                /></v-btn>
                                <v-btn @click="(activityId = item.id), (activityConfirmationDialog = true)" icon variant="flat" class="mr-5"
                                    ><TrashIcon stroke-width="1.5" size="20"
                                /></v-btn>
                            </div>
                            <v-card-subtitle>{{ item.date }}</v-card-subtitle>
                        </v-card-title>
                        <v-card-text> {{ item.description }} </v-card-text>
                    </v-card>
                </v-col>
            </UiParentCard>
        </v-col>
    </v-row>

    <ActivityForm
        v-if="dialogActivity"
        @close="closeActivity"
        @submit="submitActivity"
        :dialog="dialogActivity"
        :action="activityAction"
        :payload="payloadActivity"
    />
    <AnnouncementForm
        v-if="dialogAnnouncement"
        @close="closeAnnouncement"
        @submit="submitAnnouncement"
        :dialog="dialogAnnouncement"
        :action="announcementAction"
        :payload="payloadAnnouncement"
    />

    <ConfirmationDialog
        v-if="activityConfirmationDialog"
        @submit="deleteActivityFn(activityId)"
        @close="activityConfirmationDialog = false"
        :dialog="activityConfirmationDialog"
        :action="'delete'"
        :title="'Remove'"
        :text="'Are you sure you want to remove this activity?'"
    />

    <ConfirmationDialog
        v-if="announcementConfirmationDialog"
        @submit="deleteAnnouncementFn(announcementId)"
        @close="announcementConfirmationDialog = false"
        :dialog="announcementConfirmationDialog"
        :action="'delete'"
        :title="'Remove'"
        :text="'Are you sure you want to remove this announcement?'"
    />
</template>
