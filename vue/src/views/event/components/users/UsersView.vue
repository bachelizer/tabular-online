<script setup lang="ts">
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import UsersForm from '@/views/event/components/users/UsersForm.vue'

let dialog = ref(false);
let action = ref('');
const route = useRoute();
const eventId = ref(route.params.id);

const close = () => {
    dialog.value = false;
};

const submitHandler = (payload: {}, action: string) => {
    if (action === 'create') {
    } else {
    }
};
</script>

<template>
    <v-col cols="12">
        <v-col class="text-right">
            <v-btn icon variant="flat" color="primary" @click="(dialog = true), (action = 'create')">
                <PlusIcon stroke-width="1.5" size="20"
            /></v-btn>
        </v-col>

        <v-card>
            <v-table fixed-header>
                <thead>
                    <tr class="font-weight-bold text-uppercase" style="">
                        <th class="text-left">Screen Name</th>
                        <th class="text-left">Full Name</th>
                        <th class="text-left">Role</th>
                        <th class="text-left">Password</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> screen_name</td>
                        <td>full_name</td>
                        <td>participant.role</td>
                        <td>participant.password</td>
                        <td class="d-flex justify-space-around">
                            <v-btn color="primary">view</v-btn>
                            <v-btn color="success">edit</v-btn>
                            <v-btn color="error">remove</v-btn>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>

        <UsersForm :action="action" v-if="dialog" :dialog="dialog" @close="close()" @submit="submitHandler" />
    </v-col>
</template>
