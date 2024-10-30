<template>
  <Head title="CSV Converter" />
  <div class="bg-white">
    <div class="relative isolate px-6 pt-14 lg:px-8">
      <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
        <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
      </div>
      <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
        <div class="text-center">
          <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl mt-10">CSV Converter</h1>
          <button
              @click="downloadCSV()"
              class="bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 my-5"
              v-if="actionAttributes.length > 0">
            DOWNLOAD CSV
          </button>

          <div class="mt-8" v-if="count == 0">
            <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload CSV File</label>
            <input
                id="file_input"
                type="file"
                @change="handleFileChange"
                accept=".csv"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
            />
            <button
                @click="uploadCsv"
                class="mt-4 px-4 py-2 bg-blue-600 text-white rounded"
            >
              Upload
            </button>
            <p v-if="errorMessage" class="mt-4 text-red-600">{{ errorMessage }}</p>
          </div>
          <div class="mt-8" v-else>
            <div class="px-4 sm:px-6 lg:px-8 my-8">
              <div class="sm:flex">
                <div class="sm:flex-auto text-left">
                  <h1 class="text-base font-semibold text-gray-900">Rules</h1>
                  <p class="mt-2 text-sm text-gray-700">Filter records by a set of rules.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                  <button @click="modalNewRule = true" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add new</button>
                </div>
              </div>
              <div class="mt-8 flow-root" v-if="rules.length > 0">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead>
                      <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Type</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Field</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Value</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0"> </th>
                      </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
                      <tr v-for="(rule, index) in rules" :key="index">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0 text-left">{{ rule.type }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-left">{{ rule.field }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-left">{{ rule.value }}</td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                          <a href="#" @click="setEditIndex(index)" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        </td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                          <a href="#" @click="setDeleteIndex(index)" class="text-indigo-600 hover:text-indigo-900">Delete</a>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="mt-8 flow-root" v-else>
                <div class="rounded-md bg-blue-50 p-4">
                  <div class="flex">
                    <div class="flex-shrink-0">
                      <InformationCircleIcon class="h-5 w-5 text-blue-400" aria-hidden="true" />
                    </div>
                    <div class="ml-3">
                      <p class="text-sm font-medium text-blue-800">No rules defined.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="px-4 sm:px-6 lg:px-8 my-8">
              <div class="sm:flex">
                <div class="sm:flex-auto text-left">
                  <h1 class="text-base font-semibold text-gray-900">Action Attributes</h1>
                  <p class="mt-2 text-sm text-gray-700">Changes to be applied to the applicable data rows.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                  <button @click="modalNewActionAttribute = true"  type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add new</button>
                </div>
              </div>
              <div class="mt-8 flow-root" v-if="actionAttributes.length > 0">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead>
                      <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Type</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Field</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Find</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Replace</th>
                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                          <span class="sr-only">Edit</span>
                        </th>
                      </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200">
                      <tr v-for="(actionAttribute, index) in actionAttributes" :key="index">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0 text-left">{{ actionAttribute.type }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-left">{{ actionAttribute.field }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-left">{{ actionAttribute.find }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-left">{{ actionAttribute.replace }}</td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                          <a href="#" @click="setEditActionAttributeIndex(index)" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        </td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                          <a href="#" @click="setDeleteActionAttributeIndex(index)" class="text-indigo-600 hover:text-indigo-900">Delete</a>
                        </td>
                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="mt-8 flow-root" v-else>
                <div class="rounded-md bg-blue-50 p-4">
                  <div class="flex">
                    <div class="flex-shrink-0">
                      <InformationCircleIcon class="h-5 w-5 text-blue-400" aria-hidden="true" />
                    </div>
                    <div class="ml-3">
                      <p class="text-sm font-medium text-blue-800">No action attributes defined.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
      </div>
    </div>
  </div>

  <TransitionRoot as="template" :show="modalNewRule">
    <Dialog class="relative z-10" @close="modalNewRule = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
              <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                  <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                </div>
                <div class="mt-3 text-center sm:mt-5">
                  <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Add New Rule</DialogTitle>
                  <div class="mt-2">

                    <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3 flex flex-col">
                        <label class="block text-sm font-medium text-gray-900 text-left">Rule</label>
                        <div class="mt-2 w-full">
                          <select v-model="chosenRuleType" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            <option v-for="type in ruleTypes" :value="type">{{ type }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3 flex flex-col">
                        <label class="block text-sm font-medium text-gray-900 text-left">Field</label>
                        <div class="mt-2 w-full">
                          <select v-model="chosenRuleField" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            <option v-for="field in headers" :value="field">{{ field }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3">
                        <label class="block text-sm/6 font-medium text-gray-900 text-left">Value</label>
                        <div class="mt-2">
                          <input type="text" v-model="chosenRuleValue" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                <button type="button" @click="addRule()" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Add Rule</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0" @click="modalNewRule = false" ref="cancelButtonRef">Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
  <TransitionRoot as="template" :show="modalEditRule">
    <Dialog class="relative z-10" @close="modalEditRule = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
              <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                  <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                </div>
                <div class="mt-3 text-center sm:mt-5">
                  <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Edit Existing Rule</DialogTitle>
                  <div class="mt-2">

                    <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3 flex flex-col">
                        <label class="block text-sm font-medium text-gray-900 text-left">Rule</label>
                        <div class="mt-2 w-full">
                          <select v-model="chosenRuleType" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            <option v-for="type in ruleTypes" :value="type">{{ type }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3 flex flex-col">
                        <label class="block text-sm font-medium text-gray-900 text-left">Field</label>
                        <div class="mt-2 w-full">
                          <select v-model="chosenRuleField" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            <option v-for="field in headers" :value="field">{{ field }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3">
                        <label class="block text-sm/6 font-medium text-gray-900 text-left">Value</label>
                        <div class="mt-2">
                          <input type="text" v-model="chosenRuleValue" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                <button type="button" @click="editRule()" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Edit Rule</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0" @click="modalEditRule = false" ref="cancelButtonRef">Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
  <TransitionRoot as="template" :show="modalDeleteRule">
    <Dialog class="relative z-10" @close="modalDeleteRule = false">
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
                  <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Delete Rule</DialogTitle>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">Are you sure you want to delete this rule? This action cannot be undone.</p>
                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto" @click="deleteRule()">Delete Rule</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="modalDeleteRule = false" ref="cancelButtonRef">Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
  <TransitionRoot as="template" :show="modalNewActionAttribute">
    <Dialog class="relative z-10" @close="modalNewActionAttribute = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
              <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                  <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                </div>
                <div class="mt-3 text-center sm:mt-5">
                  <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Add New Action Attribute</DialogTitle>
                  <div class="mt-2">

                    <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3 flex flex-col">
                        <label class="block text-sm font-medium text-gray-900 text-left">Action Attribute</label>
                        <div class="mt-2 w-full">
                          <select v-model="chosenActionAttributeType" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            <option v-for="type in actionAttributeTypes" :value="type">{{ type }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3 flex flex-col">
                        <label class="block text-sm font-medium text-gray-900 text-left">Field</label>
                        <div class="mt-2 w-full">
                          <select v-model="chosenActionAttributeField" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            <option v-for="field in headers" :value="field">{{ field }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3">
                        <label class="block text-sm/6 font-medium text-gray-900 text-left">Find Value</label>
                        <div class="mt-2">
                          <input type="text" v-model="chosenActionAttributeFindValue" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3">
                        <label class="block text-sm/6 font-medium text-gray-900 text-left">Replace Value</label>
                        <div class="mt-2">
                          <input type="text" v-model="chosenActionAttributeReplaceValue" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2" @click="addActionAttribute()">Add Action Attribute</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0" @click="modalNewActionAttribute = false" ref="cancelButtonRef">Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
  <TransitionRoot as="template" :show="modalEditActionAttribute">
    <Dialog class="relative z-10" @close="modalEditActionAttribute = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
              <div>
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                  <CheckIcon class="h-6 w-6 text-green-600" aria-hidden="true" />
                </div>
                <div class="mt-3 text-center sm:mt-5">
                  <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Edit Action Attribute</DialogTitle>
                  <div class="mt-2">

                    <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3 flex flex-col">
                        <label class="block text-sm font-medium text-gray-900 text-left">Action Attribute</label>
                        <div class="mt-2 w-full">
                          <select v-model="chosenActionAttributeType" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            <option v-for="type in actionAttributeTypes" :value="type">{{ type }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3 flex flex-col">
                        <label class="block text-sm font-medium text-gray-900 text-left">Field</label>
                        <div class="mt-2 w-full">
                          <select v-model="chosenActionAttributeField" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                            <option v-for="field in headers" :value="field">{{ field }}</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3">
                        <label class="block text-sm/6 font-medium text-gray-900 text-left">Find Value</label>
                        <div class="mt-2">
                          <input type="text" v-model="chosenActionAttributeFindValue" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>
                    </div>

                    <div class="mt-10 gap-x-6 gap-y-8 w-full">
                      <div class="sm:col-span-3">
                        <label class="block text-sm/6 font-medium text-gray-900 text-left">Replace Value</label>
                        <div class="mt-2">
                          <input type="text" v-model="chosenActionAttributeReplaceValue" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" />
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2" @click="editActionAttribute()">Edit Action Attribute</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0" @click="modalEditActionAttribute = false" ref="cancelButtonRef">Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
  <TransitionRoot as="template" :show="modalDeleteActionAttribute">
    <Dialog class="relative z-10" @close="modalDeleteActionAttribute = false">
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
                  <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Delete Action Attribute</DialogTitle>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">Are you sure you want to delete this action attribute? This action cannot be undone.</p>
                  </div>
                </div>
              </div>
              <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto" @click="deleteActionAttribute()">Delete Rule</button>
                <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="modalDeleteActionAttribute = false" ref="cancelButtonRef">Cancel</button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { InformationCircleIcon } from '@heroicons/vue/20/solid'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { CheckIcon, ExclamationTriangleIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
  ruleTypes: {
    type: Object,
    default: {},
  },
  actionAttributeTypes: {
    type: Object,
    default: {},
  }
});

const csvFile = ref(null);
const headers = ref({});
const records = ref({});
const count = ref(0);
const errorMessage = ref("");
const csvFilePath = ref("");

const rules = ref([]);
const ruleTypes = ref(props.ruleTypes);
const chosenRuleType = ref('');
const chosenRuleField = ref('');
const chosenRuleValue = ref('');
const currentRuleIndex = ref(null);

const actionAttributes = ref([]);
const actionAttributeTypes = ref(props.actionAttributeTypes);
const chosenActionAttributeType = ref('');
const chosenActionAttributeField = ref('');
const chosenActionAttributeFindValue = ref('');
const chosenActionAttributeReplaceValue = ref('');
const currentActionAttributeIndex = ref(null);

const modalNewRule = ref(false);
const modalEditRule = ref(false);
const modalDeleteRule = ref(false);

const modalNewActionAttribute = ref(false);
const modalEditActionAttribute = ref(false);
const modalDeleteActionAttribute = ref(false);

function handleFileChange(event) {
  csvFile.value = event.target.files[0];
}

const addRule = () => {
  errorMessage.value = '';

  if (!chosenRuleValue.value || !chosenRuleField.value || !chosenRuleType.value) {
    errorMessage.value = 'Please fill in all fields.';
    return;
  }

  const newRule = {
    type: chosenRuleType.value,
    field: chosenRuleField.value,
    value: chosenRuleValue.value,
  };

  rules.value.push(newRule);

  chosenRuleType.value = '';
  chosenRuleField.value = '';
  chosenRuleValue.value = '';
  modalNewRule.value = false;
};

const addActionAttribute = () => {
  errorMessage.value = '';

  if (!chosenActionAttributeType.value || !chosenActionAttributeField.value) {
    errorMessage.value = 'Please fill add a type and/or a field.';
    return;
  }

  const newActionAttribute = {
    type: chosenActionAttributeType.value,
    field: chosenActionAttributeField.value,
    find: chosenActionAttributeFindValue.value,
    replace: chosenActionAttributeReplaceValue.value,
  };

  actionAttributes.value.push(newActionAttribute);

  chosenActionAttributeType.value = '';
  chosenActionAttributeField.value = '';
  chosenActionAttributeFindValue.value = '';
  chosenActionAttributeReplaceValue.value = '';
  modalNewActionAttribute.value = false;
};

const setEditIndex = (index) => {
  currentRuleIndex.value = index;
  chosenRuleType.value = rules.value[index].type;
  chosenRuleField.value = rules.value[index].field;
  chosenRuleValue.value = rules.value[index].value;
  modalEditRule.value = true;
};

const setDeleteIndex = (index) => {
  currentRuleIndex.value = index;
  modalDeleteRule.value = true;
};

const setEditActionAttributeIndex = (index) => {
  currentActionAttributeIndex.value = index;
  chosenActionAttributeType.value = actionAttributes.value[index].type;
  chosenActionAttributeField.value = actionAttributes.value[index].field;
  chosenActionAttributeFindValue.value = actionAttributes.value[index].find;
  chosenActionAttributeReplaceValue.value = actionAttributes.value[index].replace;
  modalEditActionAttribute.value = true;
};

const setDeleteActionAttributeIndex = (index) => {
  currentActionAttributeIndex.value = index;
  modalDeleteActionAttribute.value = true;
};

const editRule = () => {
  errorMessage.value = '';

  if (!chosenRuleValue.value || !chosenRuleField.value || !chosenRuleType.value) {
    errorMessage.value = 'Please fill in all fields.';
    return;
  }

  let index = currentRuleIndex.value

  rules.value[index].type = chosenRuleType.value;
  rules.value[index].field = chosenRuleField.value;
  rules.value[index].value = chosenRuleValue.value;

  chosenRuleType.value = '';
  chosenRuleField.value = '';
  chosenRuleValue.value = '';
  modalEditRule.value = false;
  currentRuleIndex.value = null;
};

const editActionAttribute = () => {
  errorMessage.value = '';

  if (!chosenActionAttributeType.value || !chosenActionAttributeField.value) {
    errorMessage.value = 'Please fill add a type and/or a field.';
    return;
  }

  let index = currentActionAttributeIndex.value

  actionAttributes.value[index].type = chosenActionAttributeType.value;
  actionAttributes.value[index].field = chosenActionAttributeField.value;
  actionAttributes.value[index].find = chosenActionAttributeFindValue.value;
  actionAttributes.value[index].replace = chosenActionAttributeReplaceValue.value;

  chosenActionAttributeType.value = '';
  chosenActionAttributeField.value = '';
  chosenActionAttributeFindValue.value = '';
  chosenActionAttributeReplaceValue.value = '';
  modalEditActionAttribute.value = false;
  currentActionAttributeIndex.value = null;
};

const deleteRule = () => {
  errorMessage.value = '';

  let index = currentRuleIndex.value
  if (index !== null && index >= 0 && index < rules.value.length) {
    rules.value.splice(index, 1);
  }

  chosenRuleType.value = '';
  chosenRuleField.value = '';
  chosenRuleValue.value = '';
  modalDeleteRule.value = false;
  currentRuleIndex.value = null;
};

const deleteActionAttribute = () => {
  errorMessage.value = '';

  let index = currentActionAttributeIndex.value

  if (index !== null && index >= 0 && index < actionAttributes.value.length) {
    actionAttributes.value.splice(index, 1);
  }

  chosenActionAttributeType.value = '';
  chosenActionAttributeField.value = '';
  chosenActionAttributeFindValue.value = '';
  chosenActionAttributeReplaceValue.value = '';
  modalDeleteActionAttribute.value = false;
  currentActionAttributeIndex.value = null;
};

const downloadCSV = async () => {

  const payload = {
    rules: rules.value,
    actionAttributes: actionAttributes.value,
    csvFilePath: csvFilePath.value
  };

  try {
    const response = await axios.post(route('csv.download'), payload, {
      responseType: 'blob',
      headers: {
        'Content-Type': 'application/json'
      }
    });

    const blob = new Blob([response.data], { type: 'text/csv' });
    const downloadUrl = URL.createObjectURL(blob);

    const link = document.createElement('a');
    link.href = downloadUrl;
    link.download = 'export.csv';

    document.body.appendChild(link);
    link.click();

    document.body.removeChild(link);
    URL.revokeObjectURL(downloadUrl);

  } catch (error) {
    errorMessage.value = error;
  }

};

const uploadCsv = async () => {

  if (!csvFile.value) {
    errorMessage.value = 'Please select a CSV file to upload.';
    return;
  }

  const formData = new FormData();
  formData.append('file', csvFile.value);

  try {
    const response = await axios.post(route('csv.upload'), formData);
    errorMessage.value = "";

    headers.value = response.data.headers;
    records.value = response.data.records;
    count.value = response.data.count;
    csvFilePath.value = response.data.csvFilePath;

  } catch (error) {
    errorMessage.value = 'There was an error submitting the form';
  }
};

</script>
