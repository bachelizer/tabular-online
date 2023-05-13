<script setup>
import Icon from '../Icon.vue';
import { authStore } from '@/stores/auth/auth';
import { ApertureIcon } from 'vue-tabler-icons';
import { RouterLink } from 'vue-router';

const useAuthStore = authStore();
const { userAccount } = useAuthStore;
const props = defineProps({ item: Object, level: Number });
</script>

<template>
    <!---Single Item-->
    <!-- v-if="user.role.role === item.userRole" -->
    <v-list-item
        :to="item.to"
        v-if="userAccount.role.role === item.userRole"
        rounded
        class="mb-1"
        active-color="primary"
        :disabled="item.disabled"
        :target="item.type === 'external' ? '_blank' : ''"
    >
        <!---If icon-->
        <template v-slot:prepend>
            <Icon :item="item.icon" :level="level" />
        </template>
        <v-list-item-title>{{item.title }}</v-list-item-title>
        <!---If Caption-->
        <v-list-item-subtitle v-if="item.subCaption" class="text-caption mt-n1 hide-menu">
            {{ item.subCaption }}
        </v-list-item-subtitle>
        <!---If any chip or label-->
        <template v-slot:append v-if="item.chip">
            <v-chip
                :color="item.chipColor"
                class="sidebarchip hide-menu"
                :size="'small'"
                :variant="item.chipVariant"
                :prepend-icon="item.chipIcon"
            >
                {{ item.chip }}
            </v-chip>
        </template>
    </v-list-item>

    <!-- <v-list-item
        to="/announcement-activity"
        rounded
        class="mb-1"
        active-color="primary"
    >
        <template v-slot:prepend>
            <Icon :item="ApertureIcon"/>
        </template>
        <v-list-item-title>Announcement And Activity</v-list-item-title>
    </v-list-item> --></template>
