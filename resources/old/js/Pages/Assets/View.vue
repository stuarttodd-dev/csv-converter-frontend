<script setup>

import { ref } from 'vue'
import { Head } from '@inertiajs/vue3';
import { MenuItem, MenuItems } from '@headlessui/vue'
import { GoogleMap, Marker } from 'vue3-google-map'

import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";
import ConfirmationModal from "@/Components/Admin/Modals/ConfirmationModal.vue";
import AssetList from "@/Components/Admin/AssetList.vue";
import MenuButtonWithDropdown from "@/Components/Admin/Menus/MenuButtonWithDropdown.vue";
import ImageList from "@/Components/Admin/ImageList.vue";
import FileList from "@/Components/Admin/FileList.vue";
import FileUploader from "@/Components/Admin/FileUploader.vue";
import DialogModal from "@/Components/Admin/Modals/DialogModal.vue";
import EditAsset from "@/Components/Admin/EditAsset.vue";
import EditAssetImage from "@/Components/Admin/EditAssetImage.vue";

const props = defineProps({
  w3w: Object,
})

const center = props.w3w.coordinates
const words = props.w3w.words
const map = props.w3w.map
const modals = ref({})

const openModal = (id) => {
  modals.value = { ...modals.value, [id]: true }
}

const closeModal = (id) => {
  modals.value = { ...modals.value, [id]: false }
}

const confirmationModals = [
  { key: 'copy-asset-page', title: 'Copy Asset URL', description: 'Asset URL has been successfully copied to clipboard.' },
  { key: 'print-page', title: 'Print Page', description: 'Page been has successfully printed.' },
  { key: 'download-qr-code', title: 'Download QR Code', description: 'QR Code has been successfully downloaded.' },
]

const pages = [
  { name: 'Asset Groups', href: route('group-assets.view'), current: false },
  { name: 'Asset List', href: route('assets.list'), current: false },
  { name: 'Asset', href: '#', current: true },
]

const assets = [
  { id: 1, name: 'Equipment Type', value: 'Generator' },
  { id: 2, name: 'Equipment Weight', value: '50kg' },
  { id: 3, name: 'Equipment Length', value: '5000m' },
]

const images = [
  { src: '@/../images/placeholders/logo.png', alt: 'Logo' },
  { src: '@/../images/placeholders/qr.png', alt: 'QR Code' },
];

const assetFiles = ref([])
const relatedFiles = ref([])

const updateAssetFiles = (files) => {
  const updatedFiles = [...assetFiles.value];
  files.forEach(newFile => {
    const existingFileIndex = updatedFiles.findIndex(file => file.name === newFile.name);
    if (existingFileIndex !== -1) {
      updatedFiles[existingFileIndex] = newFile;
    } else {
      updatedFiles.push(newFile);
    }
  });
  assetFiles.value = updatedFiles;
};

const updateRelatedFiles = (files) => {
  const updatedFiles = [...relatedFiles.value];
  files.forEach(newFile => {
    const existingFileIndex = updatedFiles.findIndex(file => file.name === newFile.name);
    if (existingFileIndex !== -1) {
      updatedFiles[existingFileIndex] = newFile;
    } else {
      updatedFiles.push(newFile);
    }
  });
  relatedFiles.value = updatedFiles;
};

const deleteAssetFile = (index) => {
  assetFiles.value.splice(index, 1)
}

const deleteRelatedFile = (index) => {
  relatedFiles.value.splice(index, 1)
}

</script>

<template>
  <Head title="Asset Details" />

  <AppLayout title="Asset Details">
    <template #header>
      <Breadcrumbs :pages="pages" />

      <div class="px-4 sm:px-6 lg:px-8">
        <div class="border-b border-gray-200 bg-white px-4 py-5 sm:px-6">
          <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
            <div class="ml-4 mt-2">
              <p class="text-sm font-medium text-gray-600">Asset</p>
              <p class="text-lg font-bold text-gray-900 sm:text-2xl">OTDR (TE129)</p>
            </div>
            <MenuButtonWithDropdown class="ml-4 mt-2 flex-shrink-0">
              <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <a href="#" @click.prevent="openModal('copy-asset-page')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Copy Asset URL</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" @click.prevent="openModal('edit-asset-dialog')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Edit Asset</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" @click.prevent="openModal('edit-asset-image-dialog')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Edit Asset Image</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" @click.prevent="openModal('print-page')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Print Page</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" @click.prevent="openModal('download-qr-code')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Download QR Code</a>
                  </MenuItem>
                </div>
              </MenuItems>
            </MenuButtonWithDropdown>
          </div>
        </div>
      </div>

      <ImageList class="bg-white mx-auto max-w-7xl px-6 lg:px-8" :images="images" />
      <AssetList class="mt-5 pt-5 border-t border-gray-200" :assets="assets" />

      <div class="mt-5">
        <div class="px-4 sm:px-0">
          <div>
            <h3 class="text-base font-semibold leading-7 text-gray-900">What3Words Location</h3>
            <p class="mb-5"><a :href="map">{{ words }}</a></p>
          </div>
          <div>
            <GoogleMap api-key="AIzaSyCimUeHeYQNjexCHHElOqDGW8jFnlSGk5I" style="width: 100%; height: 500px" :center="center" :zoom="17">
              <Marker :options="{ position: center }" />
            </GoogleMap>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <div class="px-4 sm:px-0">
          <div class="flex items-center justify-between">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Files</h3>
            <MenuButtonWithDropdown title="Add">
              <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <a href="#" @click.prevent="openModal('add-asset-files-dialog')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Add Asset Files</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" @click.prevent="openModal('add-related-files-dialog')" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">Add Related Files</a>
                  </MenuItem>
                </div>
              </MenuItems>
            </MenuButtonWithDropdown>
          </div>
        </div>
        <FileList class="mt-6 border-t border-gray-100" title="Asset files" :files="assetFiles" @fileDeleted="deleteAssetFile" />
        <FileList class="mt-6 border-t border-gray-100" title="Related files" :files="relatedFiles" @fileDeleted="deleteRelatedFile" />
        <FileList class="mt-6 border-t border-gray-100" title="Asset forms" :files="relatedFiles" @fileDeleted="deleteRelatedFile" />
      </div>

      <div class="space-y-10 divide-y divide-gray-900/10">

        <div class="grid grid-cols-1 gap-x-8 gap-y-8 pt-10 md:grid-cols-3">
          <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">An Attached Form </h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Dummy form the user has to fill out</p>
          </div>

          <form class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
              <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                  <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                  <div class="mt-2">
                    <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="sm:col-span-3">
                  <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                  <div class="mt-2">
                    <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                  <div class="mt-2">
                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="sm:col-span-4">
                  <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                  <div class="mt-2">
                    <select id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                      <option>United States</option>
                      <option>Canada</option>
                      <option>Mexico</option>
                    </select>
                  </div>
                </div>

                <div class="col-span-full">
                  <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                  <div class="mt-2">
                    <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                  <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                  <div class="mt-2">
                    <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="region" class="block text-sm font-medium leading-6 text-gray-900">State / Province</label>
                  <div class="mt-2">
                    <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>

                <div class="sm:col-span-2">
                  <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                  <div class="mt-2">
                    <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                  </div>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
              <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
              <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
          </form>
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

      <DialogModal key="add-asset-files-dialog" :open="modals['add-asset-files-dialog']" @close="closeModal('add-asset-files-dialog')">
        <div>
          <FileUploader @filesChanged="updateAssetFiles" />
        </div>
        <div class="mt-5 sm:mt-6 flex justify-end">
          <button type="button" class="mt-3 inline-flex w-full sm:w-auto rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0" @click="closeModal('add-asset-files-dialog')" ref="cancelButtonRef">Close</button>
        </div>
      </DialogModal>

      <DialogModal key="add-related-files-dialog" :open="modals['add-related-files-dialog']" @close="closeModal('add-related-files-dialog')">
        <div>
          <FileUploader @filesChanged="updateRelatedFiles" />
        </div>
        <div class="mt-5 sm:mt-6 flex justify-end">
          <button type="button" class="mt-3 inline-flex w-full sm:w-auto rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0" @click="closeModal('add-related-files-dialog')" ref="cancelButtonRef">Close</button>
        </div>
      </DialogModal>

      <DialogModal key="edit-asset-dialog" :open="modals['edit-asset-dialog']" @close="closeModal('edit-asset-dialog')">
        <div>
          <EditAsset @close="closeModal('edit-asset-dialog')" />
        </div>

      </DialogModal>

      <DialogModal key="edit-asset-image-dialog" :open="modals['edit-asset-image-dialog']" @close="closeModal('edit-asset-image-dialog')">
        <div>
          <EditAssetImage @close="closeModal('edit-asset-image-dialog')" />
        </div>
      </DialogModal>

    </template>
  </AppLayout>
</template>
