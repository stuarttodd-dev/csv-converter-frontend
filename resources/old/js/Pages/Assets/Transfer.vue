<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid'
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";

const pages = [
  { name: 'Transfer Assets', href: '#', current: true },
]

</script>

<template>
    <AppLayout title="Transfer Assets">
      <Breadcrumbs :pages="pages" />
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form>
                  <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                      <h2 class="text-base font-semibold leading-7 text-gray-900">Transfer Assets</h2>
                      <p class="mt-1 text-sm leading-6 text-gray-600">This is a potentially dangerous operation, please make be 100% sure you want to transfer assets before continuing.</p>

                      <div class="sm:col-span-3 mt-4">
                        <label for="from" class="block text-sm font-medium leading-6 text-gray-900">From:</label>
                        <div class="mt-2">
                          <select id="from" name="from" autocomplete="from" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>United States</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                          </select>
                        </div>
                      </div>

                      <div class="sm:col-span-3 mt-4">
                        <label for="to" class="block text-sm font-medium leading-6 text-gray-900">To:</label>
                        <div class="mt-2">
                          <select id="to" name="to" autocomplete="to" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option>United States</option>
                            <option>Canada</option>
                            <option>Mexico</option>
                          </select>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="mt-6 flex items-center justify-start gap-x-6">
                    <a :href="route('dashboard')">
                      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    </a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </AppLayout>
</template>



