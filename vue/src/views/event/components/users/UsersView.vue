<script setup lang="ts">
import { ref, onMounted, reactive } from 'vue';
import { useRoute } from 'vue-router';
import UsersForm from '@/views/event/components/users/UsersForm.vue';
import ConfirmationDialog from '@/components/shared/ConfirmationDialog.vue'
import type { UserRequest } from '@/stores/user/interface/user.interface';
import { userStore } from '@/stores/user/user';
import { storeToRefs } from 'pinia';

const useUserStore = userStore();
const { users } = storeToRefs(useUserStore);
const { fetchEventUser, createUser, updateUser, removeUser } = useUserStore;

let dialog = ref(false);
let action = ref('');
let payload = reactive({} as UserRequest)
let confirmationDialog = ref(false);
let userId = ref(0)
const route = useRoute();
const eventId = ref(route.params.id);

onMounted(async () => {
    await fetchEventUser(Number(eventId.value));
});

const close = () => {
    dialog.value = false;
};

const submitHandler = async (payload: {}, action: string) => {
    if (action === 'create') {
        const request = { ...payload, event_id: Number(eventId.value) };
        await createUser(request);
    } else {
        await updateUser(payload);
    }
    await fetchEventUser(Number(eventId.value));
    close();
};

const confirmDelete = async (id:number) => {
    try {
        await removeUser(id)
        fetchEventUser(Number(eventId.value));
        confirmationDialog.value = false;
    } catch(e) {
        alert('user has existing data.')
    }
}
</script>

<template>
    <v-col cols="12">
        <v-col class="text-right">
            <v-btn icon variant="flat" color="primary" @click="(dialog = true), (action = 'create'), (payload = {} as UserRequest)">
                <PlusIcon stroke-width="1.5" size="20"
            /></v-btn>
        </v-col>

        <v-card>
            <v-table fixed-header class="mb-5">
                <thead>
                    <tr class="text-uppercase">
                        <th class="text-left">Screen Name</th>
                        <th class="text-left">Full Name</th>
                        <th class="text-left">Role</th>
                        <th class="text-left">Password</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>{{ user.screen_name }}</td>
                        <td>{{ user.full_name }}</td>
                        <td>{{ user.role.role }}</td>
                        <td>{{ user.password }}</td>
                        <td class="d-flex justify-space-around">
                            <v-btn color="primary"  @click="(dialog = true), (action = 'update'), (payload = user)">view</v-btn>
                            <!-- <v-btn color="success">edit</v-btn> -->
                            <v-btn color="error"  @click="confirmationDialog = true, userId = user.id">remove</v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>

        <UsersForm :action="action" v-if="dialog" :dialog="dialog" @close="close()" @submit="submitHandler" :payload="payload" />
    </v-col>
    <ConfirmationDialog @submit="confirmDelete(userId)" @close="confirmationDialog = false" :dialog="confirmationDialog" :action="'delete'" :title="'Remove'" :text="'Are you sure you want to remove this user?'"/>

</template>
