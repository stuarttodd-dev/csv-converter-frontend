<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";
import PageHeader from "@/Components/Admin/PageHeader.vue";
import AssetTable from "@/Components/Admin/AssetTable.vue";
import DialogModal from "@/Components/Admin/Modals/DialogModal.vue";
import EditAsset from "@/Components/Admin/EditAsset.vue";
import EditField from "@/Components/Admin/EditField.vue";

import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot, Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ExclamationTriangleIcon, ChevronDownIcon } from '@heroicons/vue/24/outline'

const open = ref(false)

const fields = ref([
  { id: 1, name: 'Mobtag Id' },
  { id: 2, name: 'Asset Id' },
  { id: 3, name: 'Name' },
  { id: 4, name: 'Password' },
  { id: 5, name: 'What3Words Address' },
])

const items = [
  { name: 'New Asset', href: '#', modal: 'new-asset-dialog' },
  { name: 'New Field', href: '#', modal: 'new-field-dialog' },
  { name: 'New Import', href: route('group-assets.import') },
]

const pages = [
  { name: 'Asset Groups', href: route('group-assets.view'), current: false },
  { name: 'Asset List', href: '#', current: true },
]

const modals = ref({});

const openModal = (id) => {
  modals.value = { ...modals.value, [id]: true }
}

const closeModal = (id) => {
  modals.value = { ...modals.value, [id]: false }
}

</script>

<template>
  <Head title="Assets Manage" />

  <AppLayout title="Assets">
    <template #header>
      <Breadcrumbs :pages="pages" />
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
          <PageHeader title="Assets">
            A list of all the asset within <strong>Default</strong> group.
          </PageHeader>
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <div class="inline-flex rounded-md shadow-sm">
              <button @click="open=true" type="button" class="inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 mx-2 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Visible Fields
              </button>
              <button type="button" class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Add</button>
              <Menu as="div" class="relative -ml-px block">
                <MenuButton class="relative inline-flex items-center rounded-r-md bg-white px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">
                  <ChevronDownIcon class="h-5 w-5" aria-hidden="true" />
                </MenuButton>
                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                  <MenuItems class="absolute right-0 z-10 -mr-1 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <div class="py-1">
                      <MenuItem v-for="item in items" :key="item.name" v-slot="{ active }">
                        <a v-if="item.modal != ''"
                            :href="item.href"
                            :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']"
                            @click="openModal(item.modal)"
                        >{{ item.name }}</a>
                      </MenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Menu>
            </div>
          </div>
        </div>
        <AssetTable />
      </div>

      <TransitionRoot as="template" :show="open">
        <Dialog class="relative z-10" @close="open = false">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
          </TransitionChild>

          <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
              <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                  <fieldset>
                    <legend class="text-base font-semibold leading-6 text-gray-900">Visible Fields</legend>
                    <div class="mt-4 divide-y divide-gray-200 border-b border-t border-gray-200">
                      <div v-for="(asset, assetId) in fields" :key="assetId" class="relative flex items-start py-4">
                        <div class="min-w-0 flex-1 text-sm leading-6">
                          <label :for="`asset-${asset.id}`" class="select-none font-medium text-gray-900">{{ asset.name }}</label>
                        </div>
                        <div class="ml-3 flex h-6 items-center">
                          <input :id="`asset-${asset.id}`" :name="`asset-${asset.id}`" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" @clicked="assetClicked(asset.id)" />
                        </div>
                      </div>
                    </div>
                  </fieldset>
                  <div class="mt-5 sm:mt-6">
                    <button type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" @click="open = false">Close</button>
                  </div>
                </DialogPanel>
              </TransitionChild>
            </div>
          </div>
        </Dialog>
      </TransitionRoot>

      <DialogModal key="new-asset-dialog" :open="modals['new-asset-dialog']">
        <EditAsset @close="closeModal('new-asset-dialog')" />
      </DialogModal>

      <DialogModal key="new-field-dialog" :open="modals['new-field-dialog']">
        <EditField @close="closeModal('new-field-dialog')" />
      </DialogModal>

    </template>
  </AppLayout>
</template>
