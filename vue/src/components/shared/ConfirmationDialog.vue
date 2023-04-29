<script setup lang="ts">

const emit = defineEmits<{
    (e: 'submit'): void;
    (e: 'close'): void;
}>();

interface Props {
    dialog: boolean;
    action: string;
    title: string;
    text: string
}

const props = defineProps<Props>();
const submitHandler = () => {
    emit('submit');
};
</script>

<template>
    <v-row justify="center">
      <v-dialog
        v-model="dialog"
        persistent
        width="300"
      >
        <v-card class="text-center">
          <v-card-title class="text-h5">
            {{  title }}
          </v-card-title>
          <v-card-text>{{ text }}</v-card-text>
          <!-- <v-card-actions> -->
            <v-spacer></v-spacer>
            <v-btn
            :rounded="0"
              color="secondary"
              @click="emit('close')"
            >
              Cancel
            </v-btn>
            <v-btn
            :rounded="0"
              color="error"
              @click="submitHandler"
            >
              Yes
            </v-btn>
          <!-- </v-card-actions> -->
        </v-card>
      </v-dialog>
    </v-row>
  </template>