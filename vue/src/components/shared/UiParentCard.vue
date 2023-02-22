<script setup lang="ts">
const props = defineProps({
    title: String,
    class: String
});
</script>

// ===============================|| Ui Parent Card||=============================== //
<template>
    <v-card elevation="4" class="withbg">
        <v-card-item class="pa-0">
            <div class="d-sm-flex align-center justify-space-between">
                <h5 class="text-h5 mb-6 pl-7 pt-7">{{ title }}</h5>
                <!-- <template v-slot:append> -->
                <div class="justify-end">
                    <slot name="action"></slot>
                </div>

                <!-- </template> -->
            </div>

            <slot />
        </v-card-item>
    </v-card>
</template>
