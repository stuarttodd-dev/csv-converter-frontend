<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";
import DeleteModal from "@/Components/Admin/Modals/DeleteModal.vue";
import DialogModal from "@/Components/Admin/Modals/DialogModal.vue";
import ListCheckbox from "@/Components/Admin/ListCheckbox.vue";
import EditAsset from "@/Components/Admin/EditAsset.vue";

const pages = [
  { name: 'Asset Groups', href: route('group-assets.view'), current: false },
  { name: 'Fields', href: '#', current: true },
]

const fields = [
  { id: 1, name: 'Field1', type: 'Text', visibility: 'Public' },
  { id: 2, name: 'Field2', type: 'Text', visibility: 'Private'},
  { id: 3, name: 'Field3', type: 'Text', visibility: 'Public'},
  { id: 4, name: 'Field4', type: 'Text', visibility: 'Private'},
  { id: 5, name: 'Field5', type: 'Text', visibility: 'Public'},
]

const modals = ref({});

const openModal = (id) => {
  modals.value = { ...modals.value, [id]: true }
}

const closeModal = (id) => {
  modals.value = { ...modals.value, [id]: false }
}

const deleteField = (id) => {
  alert('field deleted')
  closeModal(id);
}

const deleteModals = [
  { key: 'delete-field', title: 'Delete Field', description: 'Are you sure you want to field this field? This act is irreversible.' },
]

const files = [
  { id: 1, name: 'Default', total: 21  },
  { id: 2, name: 'Demo - Lifting Equipment', total: 5  },
  { id: 3, name: 'Scaffolding - Demo', total: 1  },
  { id: 4, name: 'JDR Drum Demo', total: 1  },
  { id: 5, name: 'Personal Equipment', total: 3  },
]

const users = [
  { id: 1, name: 'Stu' },
  { id: 2, name: 'Jeff' },
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
            <h1 class="text-base font-semibold leading-6 text-gray-900">Asset Group Fields</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the asset group fields within this group.</p>
            <p>DRAG AND DROP - TO DO.</p>
          </div>
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <button type="button" @click.prevent="openModal('new-field-dialog')" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add field</button>
          </div>
        </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Type</th>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Visibility</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="field in fields" :key="field.id">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ field.name }}</td>
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ field.type }}</td>
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ field.visibility }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6 lg:pr-8">
                    <button type="button" href="#" @click.prevent="openModal('edit-field-dialog')"class="rounded bg-indigo-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</button>
                    <button type="button" href="#" @click.prevent="openModal('user-list-dialog')" class="rounded bg-indigo-500 mx-2 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Manage User Access</button>
                    <button type="button" href="#" @click.prevent="openModal('delete-field')" class="rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 mr-1">Delete</button>
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
        @delete="deleteField(modal.key)"
        @close="closeModal(modal.key)"
    />

    <DialogModal key="new-field-dialog" :open="modals['new-field-dialog']">
      <EditAsset @close="closeModal('new-field-dialog')" />
    </DialogModal>

    <DialogModal key="edit-field-dialog" :open="modals['edit-field-dialog']">
      <EditAsset @close="closeModal('edit-field-dialog')" />
    </DialogModal>

    <DialogModal key="user-list-dialog" :open="modals['user-list-dialog']">
      <ListCheckbox :items="users" title="Users" />
      <div class="mt-5 sm:mt-6 flex justify-center">
        <button type="button" class="mt-3 inline-flex w-full sm:w-auto justify-end rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0" @click="closeModal('user-list-dialog')" ref="userListButtonRef">Close</button>
      </div>
    </DialogModal>

  </AppLayout>
</template>
