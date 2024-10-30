<script setup>

import { ref, defineProps, watch } from 'vue';
import { PaperClipIcon, ExclamationTriangleIcon, XCircleIcon }  from '@heroicons/vue/20/solid';
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import DeleteModal from "@/Components/Admin/Modals/DeleteModal.vue";

const props = defineProps({
  files: {
    type: Array,
    default: [],
  },
  title: {
    type: String,
    default: 'Attachments'
  },
  class: {
    type: String
  }
});

const files = ref({});
const classString = ref(props.class);
const deleteModals = ref([]);
const bytesToMegabytes = bytes => (bytes / (1024 * 1024)).toFixed(2);

const emit = defineEmits(['fileDeleted'])

watch(() => props.files, (newFiles) => {
  files.value = newFiles
})

const openDeleteModal = (index) => {
  deleteModals.value = { ...deleteModals.value, [index]: true }
}

const closeDeleteModal = (index) => {
  deleteModals.value = { ...deleteModals.value, [index]: false }
}

const removeFile = (index) => {
  emit('fileDeleted', index);
  closeDeleteModal(index);
}

</script>

<template>

  <div :class="classString">
    <dl class="divide-y divide-gray-100">
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-sm font-medium leading-6 text-gray-900">{{ title }}</dt>
        <dd class="mt-2 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
          <ul role="list" class="divide-y divide-gray-100 rounded-md border border-gray-200" v-if="files.length > 0">
            <li v-for="(file, index) in files" :key="index" class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6">
              <div class="flex w-0 flex-1 items-center">
                <PaperClipIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                <div class="ml-4 flex min-w-0 flex-1 gap-2">
                  <span class="truncate font-medium">{{ file.name }}</span>
                  <span class="flex-shrink-0 text-gray-400">{{ bytesToMegabytes(file.size) }} mb</span>
                </div>
                <div class="mx-4 flex min-w-0 flex-1 gap-2">
                    <select id="visibility" name="visibility" autocomplete="visibility" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                      <option>Public</option>
                      <option>Private</option>
                    </select>
                </div>
              </div>
              <div class="ml-4 flex-shrink-0">
                <a :href="file.src" target="_blank" class="font-medium text-indigo-600 hover:text-indigo-500 cursor-pointer">Download</a>
                <button @click="openDeleteModal(index)" type="button" class="rounded bg-red-500 mx-5 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Archive</button>
              </div>
              <DeleteModal title="Delete file" description="Are you sure?" :show="deleteModals[index] || false" @delete="removeFile(index)" @close="closeDeleteModal(index)"/>
            </li>
          </ul>
          <div class="rounded-md bg-red-50 p-4" v-else>
            <div class="flex">
              <div class="flex-shrink-0">
                <XCircleIcon class="h-5 w-5 text-red-400" aria-hidden="true" />
              </div>
              <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">No files found.</h3>
              </div>
            </div>
          </div>
        </dd>
      </div>
    </dl>
  </div>
</template>
