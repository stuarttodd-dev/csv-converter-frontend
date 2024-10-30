<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";

const pages = [
  { name: 'Switch Account', href: '#', current: true },
]

</script>

<template>
    <AppLayout title="Switch Account">
      <Breadcrumbs :pages="pages" />
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form>
                  <div>
                    <div class="border-b border-gray-900/10 pb-6">
                      <h2 class="text-base font-semibold leading-7 text-gray-900">Switch Account</h2>
                      <p class="mt-1 text-sm leading-6 text-gray-600">Currently logged in as <strong>Half Shell Studios</strong>.</p>
                    </div>

                    <div class="border-b border-gray-900/10 pb-6">
                      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                          <label for="account" class="block text-sm font-medium leading-6 text-gray-900">Account</label>
                          <div class="mt-2">
                            <select id="account" name="account" autocomplete="account" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                              <option>United States</option>
                              <option>Canada</option>
                              <option>Mexico</option>
                            </select>
                          </div>
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
