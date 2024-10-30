<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue'
import { CalendarDateRangeIcon, BuildingOfficeIcon, CheckCircleIcon } from '@heroicons/vue/24/outline'
import AssetTable from "@/Components/Admin/AssetTable.vue";
import logo from '../../images/logos/hss-black.png';
</script>

<template>
  <AppLayout title="Dashboard">
    <div class="min-h-full">
          <div class="bg-white shadow">
            <div class="px-4 sm:px-6 lg:mx-auto lg:max-w-6xl lg:px-8">
              <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
                <div class="min-w-0 flex-1">
                  <div class="flex items-center">
                    <img class="hidden h-16 w-16 rounded-full sm:block" :src="logo" alt="" />
                    <div>
                      <div class="flex items-center">
                        <img class="h-16 w-16 rounded-full sm:hidden" :src="logo" alt="" />
                        <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:leading-9">Good morning, Half Shell Studios!</h1>
                      </div>
                      <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                        <dt class="sr-only">Mob Tag Ltd</dt>
                        <dd class="flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6">
                          <BuildingOfficeIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                          Eaglescliffe, Stockton On Tees, TS16 0JB
                        </dd>
                        <dt class="sr-only">Account status</dt>
                        <dd class="mt-3 flex items-center text-sm font-medium capitalize text-gray-500 sm:mr-6 sm:mt-0">
                          <CheckCircleIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-green-400" aria-hidden="true" />
                          Active account
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
                <div class="mt-6 flex space-x-3 md:ml-4 md:mt-0">
                  <a :href="route('account.settings')">
                    <button type="button" class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Settings</button>
                  </a>
                  <a :href="route('group-assets.view')">
                    <button type="button" class="inline-flex items-center rounded-md bg-cyan-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-cyan-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-600">Asset Groups</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4 bg-white p-5">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
              <AssetTable />
            </div>
          </div>
        </div>
  </AppLayout>
</template>
