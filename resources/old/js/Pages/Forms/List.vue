<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'
import DialogModal from "@/Components/Admin/Modals/DialogModal.vue";
import ListCheckbox from "@/Components/Admin/ListCheckbox.vue";

const pages = [
  { name: 'Asset Forms', href: '#', current: true },
]

const modals = ref({});

const openModal = (id) => {
  modals.value = { ...modals.value, [id]: true }
}

const closeModal = (id) => {
  modals.value = { ...modals.value, [id]: false }
}

const removeForm = (id) => {
  alert('Delete' + id);
  closeModal(id)
}

const forms = [
  { id: 1, name: 'Default Form' },
  { id: 2, name: 'Lifting Equipment Form' },
  { id: 3, name: 'Scaffolding Form' },
  { id: 4, name: 'JDR Drum Form' },
  { id: 5, name: 'Personal Equipment Form' },
]

const groups = [
  { id: 1, name: 'Group 1' },
  { id: 2, name: 'Group 2' },
]

</script>

<template>
  <Head title="Forms Manage" />

  <AppLayout title="Forms">
    <template #header>
      <Breadcrumbs :pages="pages" />
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Asset Forms</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all the asset forms in your account.</p>
          </div>
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a :href="route('forms.create')">
              <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create new form</button>
            </a>
          </div>
        </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"> </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="form in forms" :key="form.id">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ form.name }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8">
                    <a :href="route('forms.create')">
                      <button type="button" class="rounded bg-indigo-500 mx-2 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</button>
                    </a>
                    <button type="button" href="#" @click.prevent="openModal('group-list-dialog')" class="rounded bg-indigo-500 mx-2 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Manage Asset Group Access</button>
                    <button @click="openModal(form.id)" type="button" class="rounded bg-red-500 mx-2 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Remove</button>

                    <TransitionRoot :show="modals[form.id] || false" as="template">
                      <Dialog class="relative z-10" @close="modals[form.id] = false">
                        <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                        </TransitionChild>

                        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                          <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                              <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                                <div class="sm:flex sm:items-start">
                                  <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <ExclamationTriangleIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
                                  </div>
                                  <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                    <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">Remove form: {{ form.name }}</DialogTitle>
                                    <div class="mt-2">
                                      <p class="text-sm text-gray-500">Are you sure you want to remove this form? All of your data will be permanently removed from our servers forever. This action cannot be undone.</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                  <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto" @click="removeForm(form.id)">Delete</button>
                                  <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="modals[form.id] = false" ref="cancelButtonRef">Cancel</button>
                                </div>
                              </DialogPanel>
                            </TransitionChild>
                          </div>
                        </div>
                      </Dialog>
                    </TransitionRoot>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <DialogModal key="group-list-dialog" :open="modals['group-list-dialog']">
        <ListCheckbox :items="groups" title="Asset Groups" />
        <div class="mt-5 sm:mt-6 flex justify-center">
          <button type="button" class="mt-3 inline-flex w-full sm:w-auto justify-end rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0" @click="closeModal('group-list-dialog')" ref="userListButtonRef">Close</button>
        </div>
      </DialogModal>

    </template>
  </AppLayout>
</template>
