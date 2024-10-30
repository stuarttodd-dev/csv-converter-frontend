<script setup>

import {ref} from "vue";

import Pagination from "@/Components/Admin/Pagination.vue";
import AssetFilters from "@/Components/Admin/AssetFilters.vue";
import ConfirmationModal from "@/Components/Admin/Modals/ConfirmationModal.vue";
import DeleteModal from "@/Components/Admin/Modals/DeleteModal.vue";
import DialogModal from "@/Components/Admin/Modals/DialogModal.vue";
import EditPassword from "@/Components/Admin/EditPassword.vue";
import NotifiableDates from "@/Components/Admin/NotifiableDates.vue";

const checkedAssets = ref([])

const assets = ref([
  { id: 1, name: 'Default', password: 'some_password', what3words: 'some_address' },
  { id: 2, name: 'Demo - Lifting Equipment', password: 'some_password', what3words: 'some_address' },
  { id: 3, name: 'Scaffolding - Demo', password: 'some_password', what3words: 'some_address'  },
  { id: 4, name: 'JDR Drum Demo', password: 'some_password', what3words: 'some_address'  },
  { id: 5, name: 'Personal Equipment', password: 'some_password', what3words: 'some_address'  },
])

const confirmationModals = [
  { key: 'download-qr-codes', title: 'Download QR Codes', description: 'QR Codes has been successfully downloaded.' },
  { key: 'purchase-tags', title: 'Purchase Tags', description: 'A request have been sent, we shall be in touch shortly.' },
]

const deleteModals = [
  { key: 'delete-asset', title: 'Delete Asset', description: 'Are you sure you want to delete this asset? This action is irreversible.' },
]

const modals = ref({})

const openModal = (id) => {
  modals.value = { ...modals.value, [id]: true }
}

const closeModal = (id) => {
  modals.value = { ...modals.value, [id]: false }
}

const deleteAssets = (id) => {
  alert('file deleted: ' + checkedAssets.value)
  closeModal(id);
}

</script>

<template>

  <div class="mt-8">
    <NotifiableDates />
  </div>
  <AssetFilters />


  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8 mb-5" v-if="checkedAssets.length > 0">
      <button type="button" @click.prevent="openModal('edit-password-dialog')" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mr-1">Update Password</button>
      <button type="button" @click.prevent="openModal('download-qr-codes')" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mr-1">Download QR Codes</button>
      <button type="button" @click.prevent="openModal('purchase-tags')" class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mr-1">Purchase Tags For {{ checkedAssets.length }} Asset{{ checkedAssets.length > 1 ? 's' : ''}}</button>
      <button type="button" @click.prevent="openModal('delete-asset')" class="rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 mr-1">Delete {{ checkedAssets.length }} Asset{{ checkedAssets.length > 1 ? 's' : ''}}</button>
    </div>
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle">
        <table class="min-w-full divide-y divide-gray-300">
          <thead>
          <tr>
            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8"></th>
            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Mobtag Id</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Asset Id</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Password</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">What3Words address</th>
          </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 bg-white">
          <tr v-for="asset in assets" :key="asset.id">
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
              <input :id="`asset-${asset.id}`" :value="asset.id" v-model="checkedAssets" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
            </td>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
              <a :href="route('assets.view')" class="truncate text-sm font-medium text-indigo-600">{{ asset.id }}</a>
            </td>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ asset.id }}</td>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
              <input v-model="asset.name" type="text" class="border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" />
            </td>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
              <input v-model="asset.password" type="password" class="border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" />
            </td>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
              <input v-model="asset.what3words" type="text" class="border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2.5" />
            </td>
          </tr>
          </tbody>
        </table>
      </div>

      <Pagination />

    </div>
  </div>

  <ConfirmationModal
      v-for="modal in confirmationModals"
      :key="modal.key"
      :title="modal.title"
      :description="modal.description"
      :open="modals[modal.key]"
      @close="closeModal(modal.key)"
  />

  <DeleteModal
      v-for="modal in deleteModals"
      :key="modal.key"
      :title="modal.title"
      :description="modal.description"
      :open="modals[modal.key]"
      @delete="deleteAssets(modal.key)"
      @close="closeModal(modal.key)"
  />

  <DialogModal key="edit-password-dialog" :open="modals['edit-password-dialog']">
    <EditPassword @close="closeModal('edit-password-dialog')" />
  </DialogModal>

</template>
