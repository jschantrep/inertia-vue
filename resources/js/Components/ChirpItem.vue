<script setup>
import ChirpForm from './ChirpForm.vue';
import Dropdown from './Dropdown.vue';
import DropdownButton from './DropdownButton.vue';
import { ref } from "vue";
import DropdownLink from './DropdownLink.vue';

const editing = ref(false)

defineProps({
  chirp: Object,
})
</script>

<template>
  <div class="p-6 flex space-x-2">
    <svg class="h-6 w-6 text-black-600 dark:text-black-400 -scale-x-100" fill="none" stroke="currentColor"
      stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z">
      </path>
    </svg>
    <div class="flex-1">
      <div class="flex justify-between items-center">
        <div>
          <span class="text-black-800 dark:text-black-200">
            {{ chirp.user.name }}
          </span>
          <small class="ml-2 text-sm text-black-600 dark:text-black-400">
            {{ new Date(chirp.created_at).toLocaleString() }}

          </small>
          <small v-if="chirp.edited" class="text-sm text-black-600 dark:text-black-400">
            &middot; edited
          </small>
        </div>
      </div>
      <ChirpForm v-if="editing" :chirp="chirp" @cancel="editing = false" class="mt-4" />
      <p v-else class="mt-4 text-lg text-black-900 dark:text-black-100">
        {{ chirp.message }}
      </p>
    </div>
    <Dropdown v-if="chirp.user.id === $page.props.auth.user.id">
      <template #trigger> Opciones</template>
      <template #content>
        <DropdownButton @click="editing = true">Edit</DropdownButton>
        <DropdownLink 
        as="button" 
        :href="route('chirps.destroy', chirp.id)"
         method="delete"
         :preserve-state="false"
         
         >Delete
        </DropdownLink>
      </template>
    </Dropdown>
  </div>

</template>

<style scoped></style>