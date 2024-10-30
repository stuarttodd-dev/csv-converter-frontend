<template>
  <AppLayout title="Update Administrator">
    <Breadcrumbs :pages="pages"/>
    <Banner
        :open="errorMessage != ''"
        :message="errorMessage"
        bgColour="bg-red-500"
        @close="errorMessage = ''"
    />
    <div class="bg-white py-2 sm:py-6">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="px-4 sm:px-6 lg:px-8">

          <form :action="route('administrators.store')" method="POST" @submit.prevent="submitForm">
            <div class="space-y-12">
              <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                  <h2 class="text-base font-semibold leading-7 text-gray-900">Account</h2>
                  <p class="mt-1 text-sm leading-6 text-gray-600">Update account details.</p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                  <div class="sm:col-span-3">
                    <label for="super_user" class="block text-sm font-medium leading-6 text-gray-900">Super User</label>
                    <div class="mt-2 flex items-center gap-x-3">
                      <input id="super_user"
                             name="super_user"
                             type="checkbox"
                             v-model="administrator.super_user"
                             true-value="1"
                             false-value="0"
                             class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                      />
                      <label for="super_user" class="text-sm leading-6 text-gray-900">Is Super User</label>
                    </div>
                    <span v-if="errors.super_user" class="text-red-500 text-xs">{{ errors.super_user }}</span>
                  </div>

                  <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Name</label>
                    <div class="mt-2">
                      <input v-model="administrator.name" id="name" name="name" type="text"
                             class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                      <span v-if="errors.name" class="text-red-500 text-xs">{{ errors.name }}</span>
                    </div>
                  </div>

                  <div class="sm:col-span-6">
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                      <input v-model="administrator.email" id="email" name="email" type="email" autocomplete="username"
                             class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                      <span v-if="errors.email" class="text-red-500 text-xs">{{ errors.email }}</span>
                    </div>
                  </div>

                  <div class="sm:col-span-6">
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                      <input id="password" name="password" type="password"
                             autocomplete="new-password" ref="passwordInput"
                             class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                      <span v-if="errors.password" class="text-red-500 text-xs">{{ errors.password }}</span>
                    </div>
                  </div>

                  <div class="sm:col-span-6">
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                    <div class="mt-2">
                      <input id="password_confirmation" name="password_confirmation" type="password"
                             autocomplete="new-password" ref="passwordConfirmationInput"
                             class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>
                      <span v-if="errors.password_confirmation" class="text-red-500 text-xs">{{ errors.password_confirmation }}</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                  <h2 class="text-base font-semibold leading-7 text-gray-900">Access Rights</h2>
                  <p class="mt-1 text-sm leading-6 text-gray-600">Assign or update access rights.</p>
                </div>

                <div class="max-w-2xl space-y-6 md:col-span-2">
                  <fieldset>
                    <legend class="text-sm font-semibold leading-6 text-gray-900">Rights</legend>
                    <div class="mt-6 space-y-6">
                      <div v-for="right in permissions" :key="right.id" class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                          <input :id="'right_' + right.id"
                                 name="rights[]"
                                 type="checkbox"
                                 v-model="checkedRights"
                                 :value="right.id"
                                 class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"/>
                        </div>
                        <div class="text-sm leading-6">
                          <label :for="'right_' + right.id" class="font-medium text-gray-900">{{ right.right_display_name }}</label>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-x-6">
              <a :href="route('administrators.index')">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
              </a>
              <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Save
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import {reactive, ref, watch} from 'vue';
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from "@/App/Components/Breadcrumbs.vue";
import Banner from "@/App/Components/Banner.vue";

const props = defineProps({
  permissions: {
    type: Array,
    default: []
  },
  assignedRights: {
    type: Array,
    default: []
  },
  administrator: {
    type: Object,
    default: {}
  },
  systems: {
    type: Array,
    default: []
  },
});

const errors = ref({});
const administrator = reactive(props.administrator);
const checkedRights = ref([...props.assignedRights]);
const passwordInput = ref(null);
const passwordConfirmationInput = ref(null);
const errorMessage = ref('')

const pages = [
  { name: 'Administrators', href: route('administrators.index'), current: false },
  { name: 'Create', href: '#', current: true }
];

watch(administrator, (newVal) => {
  if (!newVal.password) errors.value.password_confirmation = '';
});

function submitForm() {
  errors.value = {};

  const password = passwordInput.value ? passwordInput.value.value : '';
  const passwordConfirmation = passwordConfirmationInput.value ? passwordConfirmationInput.value.value : '';

  if (!administrator.name) errors.value.name = 'Name is required.';
  if (!administrator.email || !/\S+@\S+\.\S+/.test(administrator.email)) errors.value.email = 'Valid email is required.';

  if (password.length < 8) {
    errors.value.password = 'Password must be at least 8 characters.';
  } else if (password !== passwordConfirmation) {
    errors.value.password_confirmation = 'Passwords do not match.';
  }

  if (Object.keys(errors.value).length === 0) {
    //console.log('Form submitted:', { ...administrator.value, checkedRights: checkedRights.value });

    const form = {
      name: administrator.name,
      email: administrator.email,
      super_user: administrator.super_user,
      rights: checkedRights.value,
      password: password ? password : null
    }

    router.post(route('administrators.store'), form);
  } else {
    errorMessage.value = "Error: Unable to submit form."
  }
}
</script>
