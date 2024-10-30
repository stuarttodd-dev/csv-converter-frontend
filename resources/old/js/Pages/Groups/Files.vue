<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";
import DeleteModal from "@/Components/Admin/Modals/DeleteModal.vue";
import DialogModal from "@/Components/Admin/Modals/DialogModal.vue";
import FileUploader from "@/Components/Admin/FileUploader.vue";
import ListCheckbox from "@/Components/Admin/ListCheckbox.vue";

const pages = [
  { name: 'Asset Groups', href: route('group-assets.view'), current: false },
  { name: 'Files', href: '#', current: true },
]

const assets = [
  { id: 1, name: 'Default', total: 21  },
  { id: 2, name: 'Demo - Lifting Equipment', total: 5  },
  { id: 3, name: 'Scaffolding - Demo', total: 1  },
  { id: 4, name: 'JDR Drum Demo', total: 1  },
  { id: 5, name: 'Personal Equipment', total: 3  },
]

const modals = ref({});

const openModal = (id) => {
  modals.value = { ...modals.value, [id]: true }
}

const closeModal = (id) => {
  modals.value = { ...modals.value, [id]: false }
}

const deleteFile = (id) => {
  alert('file deleted')
  closeModal(id);
}

const deleteModals = [
  { key: 'delete-file', title: 'Archive File', description: 'Are you sure you want to archive this file? After 90 days this file will be deleted.' },
]

const files = [
  { id: 1, name: 'Default', total: 21  },
  { id: 2, name: 'Demo - Lifting Equipment', total: 5  },
  { id: 3, name: 'Scaffolding - Demo', total: 1  },
  { id: 4, name: 'JDR Drum Demo', total: 1  },
  { id: 5, name: 'Personal Equipment', total: 3  },
]
</script>

<template>
  <Head title="Asset Group Files" />

  <AppLayout title="Asset Group Files">

    <template #header>
      <Breadcrumbs :pages="pages" />
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Asset Group Files</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the asset group files within this group.</p>
          </div>
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <button type="button" @click.prevent="openModal('new-files-dialog')" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add files</button>
          </div>
        </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8"></th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"> </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="file in files" :key="file.id">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ file.name }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8">
                    <button type="button" href="#" class="rounded bg-indigo-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Download</button>
                    <button type="button" href="#" @click.prevent="openModal('asset-list-dialog')" class="rounded bg-indigo-500 mx-2 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add to Assets</button>
                    <button type="button" href="#" @click.prevent="openModal('delete-file')" class="rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 mr-1">Archive</button>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </template>

    <DeleteModal
        v-for="modal in deleteModals"
        :key="modal.key"
        :title="modal.title"
        :description="modal.description"
        :open="modals[modal.key]"
        @delete="deleteFile(modal.key)"
        @close="closeModal(modal.key)"
    />

    <DialogModal key="new-files-dialog" :open="modals['new-files-dialog']">
      <FileUploader />
      <div class="mt-5 sm:mt-6 flex justify-center">
        <button type="button" class="mt-3 inline-flex w-full sm:w-auto justify-end rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0" @click="closeModal('new-files-dialog')" ref="newFilesButtonRef">Close</button>
      </div>
    </DialogModal>

    <DialogModal key="asset-list-dialog" :open="modals['asset-list-dialog']">
      <ListCheckbox :items="assets" title="Assets" />
      <div class="mt-5 sm:mt-6 flex justify-center">
        <button type="button" class="mt-3 inline-flex w-full sm:w-auto justify-end rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0" @click="closeModal('asset-list-dialog')" ref="assetListButtonRef">Close</button>
      </div>
    </DialogModal>

  </AppLayout>
</template>
