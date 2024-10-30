<template>
  <AppLayout title="View System Logs">
    <Breadcrumbs :pages="pages" />
    <Banner
        :open="bannerShow"
        :message="bannerMessage"
        :bgColour="bgColour"
        @close="updateBanner(false, '', 'bg-green-500')"
    />
    <div class="bg-white py-2 sm:py-6">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="px-4 sm:px-6 lg:px-8">
          <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
              <h1 class="text-base font-semibold leading-6 text-gray-900">{{ title }}</h1>
              <p class="mt-2 text-sm text-gray-700">{{ description }}</p>
            </div>
          </div>
          <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
              <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <table class="min-w-full divide-y divide-gray-300" v-if="items.length > 0">
                  <thead>
                  <tr>
                    <th scope="col" class="py-2 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-0">Name</th>
                    <th scope="col" class="py-2 text-left text-xs font-medium uppercase tracking-wide text-gray-500 sm:pl-0">Activity</th>
                    <th scope="col" class="relative py-3 pl-3 pr-4 sm:pr-0">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200 bg-white">
                  <tr v-for="(item, index) in items" :key="item.id">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0 w-[200px]">
                        <span class="font-medium">
                          <a :href="route('administrators.edit', item.user?.id)">
                            {{ item.user?.name }}
                          </a>
                        </span>
                    </td>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0 w-[200px]">
                        <span class="font-medium">
                            {{ item.activity }}
                        </span>
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                      <i class="fa fa-trash text-red-500 cursor-pointer" aria-hidden="true" @click="updateDeleteModal(item.id, true)"></i>
                    </td>

                    <Modal
                        buttonText="Delete"
                        :title="'Are you sure you want to delete \'' + item.activity + '\'?' "
                        message="Please be aware that performing this action will result in permanent changes. Once completed, this action cannot be undone."
                        :open="deleteModals[item.id] || false"
                        @close="updateDeleteModal(item.id, false)"
                        @action="deleteItem(item)"
                    />
                  </tr>
                  </tbody>
                </table>

                <EmptyContent v-if="items.length == 0" />
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
  items: {
    type: Array,
    default: []
  },
  successMessage: {
    type: String,
    default: ''
  }
});

const items = ref(props.items);
const deleteModals = ref({});
const bannerMessage = ref('');
const bannerShow = ref(false);
const bgColour = ref('bg-green-500');
const successMessage = ref(props.successMessage)

const pages = [
  { name: 'System Data', href: '#', current: true }
];

const title = 'System Logs'
const description = 'A list of system activity by administrator.'

function updateDeleteModal(id, value) {
  deleteModals.value[id] = value;
}

function updateBanner(show, message, colour) {
  bannerShow.value = show;
  bannerMessage.value = message;
  bgColour.value = colour;
}

async function deleteItem(item) {

  try {
    const response = await axios.delete(`/system-logs/${item.id}`);

    if (response.status === 200) {
      const index = items.value.findIndex(item => item.id === item.id);
      if (index !== -1) {
        items.value.splice(index, 1);
      }
      updateBanner(true, `Item '${item.name}' has been successfully removed.`, 'bg-green-500');
    } else {
      updateBanner(true, 'An error occurred', 'bg-red-500');
    }
  } catch (error) {
    updateBanner(true, `Error: ${error.response?.data?.message || 'An error occurred'}`, 'bg-red-500');
  } finally {
    updateDeleteModal(item.id, false);
  }

}

</script>
