<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid'
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";

const pages = [
  { name: 'Asset Groups', href: route('group-assets.view'), current: false },
  { name: 'Update', href: '#', current: true },
]

</script>

<template>
  <AppLayout title="Update Asset Group">
    <Breadcrumbs :pages="pages" />
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
          <form>
            <div class="space-y-12">
              <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                  <h2 class="text-base font-semibold leading-7 text-gray-900">Asset Group</h2>
                  <p class="mt-1 text-sm leading-6 text-gray-600">Update an existing asset group.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
                  <div class="sm:col-span-4">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                      <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <input type="text" name="name" id="name" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Enter asset group name here" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="mt-6 flex items-center justify-start gap-x-6">
              <a :href="route('group-assets.view')">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
              </a>
              <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>



