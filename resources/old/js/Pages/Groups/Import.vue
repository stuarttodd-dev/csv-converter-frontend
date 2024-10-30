<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid'
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";

const pages = [
  { name: 'Import Assets', href: '#', current: true },
]

</script>

<template>
    <AppLayout title="Import Assets">
      <Breadcrumbs :pages="pages" />
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <form>
                  <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                      <h2 class="text-base font-semibold leading-7 text-gray-900">Import Assets</h2>
                      <p class="mt-1 text-sm leading-6 text-gray-600">You can import assets by uploading a CSV file in the form below. Please allow a few minutes for the import to run and your assets to be created. In order for the import to be successful, please use the CSV headers below or alternatively, <a href="#">download a CSV template</a> containing your fields.</p>

                      <ul class="mt-1 text-sm leading-6 text-gray-600 list-disc list-inside">
                        <li><code class="text-red-500">mobtag_id</code> (fill only if you'd like to update an existing asset)</li>
                        <li><code class="text-red-500">name</code> (required)</li>
                        <li><code class="text-red-500">internal_identifier</code></li>
                        <li><code class="text-red-500">what3words_address</code></li>
                        <li><code class="text-red-500">serial_no</code> (Text)</li>
                        <li><code class="text-red-500">calinspection_expires</code> (Text)</li>
                        <li><code class="text-red-500">manufacturermodel</code> (Text)</li>
                        <li><code class="text-red-500">category</code> (Text)</li>
                        <li><code class="text-red-500">global_location</code> (Text)</li>
                        <li><code class="text-red-500">qualifications</code> (Text)</li>
                        <li><code class="text-red-500">category_1</code> (Text)</li>
                        <li><code class="text-red-500">location_2</code> (Text)</li>
                        <li><code class="text-red-500">rating</code> (Text)</li>
                        <li><code class="text-red-500">fuel_type</code> (Text)</li>
                        <li><code class="text-red-500">next_service_due</code> (Text)</li>
                        <li><code class="text-red-500">year_of_manufacture</code> (Text)</li>
                        <li><code class="text-red-500">combustion_checks</code> (Text)</li>
                        <li><code class="text-red-500">weight</code> (Text)</li>
                        <li><code class="text-red-500">extra_work</code> (Text)</li>
                        <li><code class="text-red-500">renewal_date</code> (Text)</li>
                        <li><code class="text-red-500">location</code> (Text)</li>
                        <li><code class="text-red-500">last_thorough_examination</code> (Date) (dd/mm/yyyy)</li>
                        <li><code class="text-red-500">next_thorough_examination</code> (Date) (dd/mm/yyyy)</li>
                      </ul>

                      <div class="col-span-full mt-5">
                        <label for="file-upload" class="block text-sm font-medium leading-6 text-gray-900">Import File</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                          <div class="text-center">
                            <div class="mt-4 flex text-sm leading-6 text-gray-600">
                              <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                <span>Upload a file</span>
                                <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                              </label>
                              <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs leading-5 text-gray-600">CSV up to 10MB</p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="mt-6 flex items-center justify-start gap-x-6">
                    <a :href="route('group-assets.view')">
                      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    </a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Import Files</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </AppLayout>
</template>



