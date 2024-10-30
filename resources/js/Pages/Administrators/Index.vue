<template>
    <AppLayout title="Manage Administrators">
      <Breadcrumbs :pages="pages" />
      <Banner
          :open="bannerShow"
          :message="bannerMessage"
          :bgColour="bgColour"
          @close="updateBanner(false, '', 'bg-green-500')"
      />
      <Banner
          :open="successMessage"
          :message="successMessage"
          @close="successMessage = null"
      />
      <div class="bg-white py-2 sm:py-6">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
              <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">{{ title }}</h1>
                <p class="mt-2 text-sm text-gray-700">{{ description }}</p>
              </div>
              <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a :href="route('administrators.create')">
                  <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add new</button>
                </a>
                  </div>
            </div>
            <div class="mt-8 flow-root">
              <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                  <table class="min-w-full divide-y divide-gray-300" v-if="administrators.length > 0">
                    <thead>
                    <tr>
                      <th scope="col" class="py-2 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-0">Name</th>
                      <th scope="col" class="px-2 py-2 text-left text-[0.625rem] font-medium uppercase tracking-wide text-gray-500" v-for="(permission, index) in permissions" :index="index">
                        {{ permission.right_display_name }}
                      </th>
                      <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-0">
                        <span class="sr-only">Edit</span>
                      </th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="(administrator, index) in administrators" :key="administrator.id">
                      <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0 w-[200px]">
                        <span :class="administrator.super_user ? 'font-bold text-white bg-green-600 rounded px-2 py-1' : 'font-medium'">
                            {{ administrator.name }}
                        </span>
                      </td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500" v-for="(permission, index) in permissions" :index="index">
                        <i :class="hasPermission(permission.id, administrator.rightIds) ? 'fa fa-check text-green-500' : 'fa fa-times text-red-500'"></i>
                      </td>

                      <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                        <a :href="route('administrators.edit', [administrator])">
                          <i class="fa fa-pencil text-blue-500 cursor-pointer" aria-hidden="true"></i>
                        </a>
                      </td>
                      <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                        <i class="fa fa-trash text-red-500 cursor-pointer" aria-hidden="true" @click="updateDeleteModal(administrator.id, true)"></i>
                      </td>

                      <Modal
                          buttonText="Delete"
                          :title="'Are you sure you want to delete \'' + administrator.name + '\'?' "
                          message="Please be aware that performing this action will result in permanent changes. Once completed, this action cannot be undone."
                          :open="deleteModals[administrator.id] || false"
                          @close="updateDeleteModal(administrator.id, false)"
                          @action="deleteAdministrator(administrator)"
                      />
                    </tr>
                    </tbody>
                  </table>

                  <EmptyContent v-if="administrators.length == 0" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AppLayout>
</template>

<script setup>

import {ref} from "vue";

import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from "@/App/Components/Breadcrumbs.vue";
import Modal from "@/App/Components/Modal.vue";
import Banner from "@/App/Components/Banner.vue";
import EmptyContent from "@/App/Components/EmptyContent.vue";

const props = defineProps({
  administrators: {
    type: Array,
    default: {}
  },
  permissions: {
    type: Array,
    default: {}
  },
  successMessage: {
    type: String,
    default: ''
  }
});

const items = ref(props.administrators);
const deleteModals = ref({});
const bannerMessage = ref('');
const bannerShow = ref(false);
const bgColour = ref('bg-green-500');
const successMessage = ref(props.successMessage)

const pages = [
  { name: 'Administrators', href: '#', current: true }
];

const title = 'Administrators'
const description = 'A list of all administrators including their name, email and permission levels.'
const rightIds = props.permissions.map(permission => permission.id);

function updateDeleteModal(id, value) {
  deleteModals.value[id] = value;
}

function updateBanner(show, message, colour) {
  bannerShow.value = show;
  bannerMessage.value = message;
  bgColour.value = colour;
}

async function deleteAdministrator(administrator) {

  try {
    const response = await axios.delete(`/administrators/${administrator.id}`);

    if (response.status === 200) {
      const index = items.value.findIndex(item => item.id === administrator.id);
      if (index !== -1) {
        items.value.splice(index, 1);
      }
      updateBanner(true, `Administrator ${administrator.name} has been successfully removed.`, 'bg-green-500');
    } else {
      updateBanner(true, 'An error occurred', 'bg-red-500');
    }
  } catch (error) {
    updateBanner(true, `Error: ${error.response?.data?.message || 'An error occurred'}`, 'bg-red-500');
  } finally {
    updateDeleteModal(administrator.id, false);
  }

}

function hasPermission(permissionId, rightIds) {

  if (!Array.isArray(rightIds)) {
    return false;
  }

  return rightIds.includes(permissionId);
}

</script>
