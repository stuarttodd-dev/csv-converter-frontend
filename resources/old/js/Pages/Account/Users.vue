<script setup>
import { ref } from 'vue'
import { Head } from '@inertiajs/vue3';
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";
import DeleteModal from "@/Components/Admin/Modals/DeleteModal.vue";
import DialogModal from "@/Components/Admin/Modals/DialogModal.vue";
import ListCheckbox from "@/Components/Admin/ListCheckbox.vue";
import EditAsset from "@/Components/Admin/EditAsset.vue";

const pages = [
  { name: 'Account Users', href: '#', current: true },
]

const users = [
  { id: 1, name: 'Stuart Todd', role: 'Viewer', email: 'hello@halfshellstudios.co.uk', expires_at: '24-07-2024 at 12:39' },
  { id: 2, name: 'Chris Birrell', role: 'Owner', email: 'info@mobtag.info', expires_at: '24-07-2024 at 12:39' },
]

const modals = ref({});

const openModal = (id) => {
  modals.value = { ...modals.value, [id]: true }
}

const closeModal = (id) => {
  modals.value = { ...modals.value, [id]: false }
}

const deleteUser = (id) => {
  alert('user deleted')
  closeModal(id);
}

const deleteModals = [
  { key: 'delete-user', title: 'Delete User', description: 'Are you sure you want to field this user? This act is irreversible.' },
]

</script>

<template>
  <Head title="Account Users" />

  <AppLayout title="Account Users">

    <template #header>
      <Breadcrumbs :pages="pages" />
      <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Account Users</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all users attached to this account.</p>
          </div>
        </div>
        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Email</th>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Role</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="user in users" :key="user.id">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ user.name }}</td>
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ user.email }}</td>
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ user.role }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6 lg:pr-8">
                    <button type="button" href="#" @click.prevent="openModal('change-role-dialog')"class="mr-2 rounded bg-indigo-500 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Change Role</button>
                    <button type="button" href="#" @click.prevent="openModal('delete-user')" class="rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 mr-1">Delete</button>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="p-4 sm:px-6 lg:px-8 border-t border-100 mt-10">
        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Invites</h1>
            <p class="mt-2 text-sm text-gray-700">A list of all invited users attached to this account.</p>
          </div>
        </div>

        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle">
              <table class="min-w-full divide-y divide-gray-300">
                <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Email</th>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Expires At</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="user in users" :key="user.id">
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ user.email }}</td>
                  <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ user.expires_at }}</td>
                  <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-sm font-medium sm:pr-6 lg:pr-8">
                    <button type="button" href="#" @click.prevent="openModal('delete-user')" class="rounded-md bg-red-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600 mr-1">Delete</button>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="mt-10">
            <form>
              <div class="sm:col-span-4">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                  <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                </div>
              </div>
              <div class="mt-6 flex items-center justify-start gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Invite</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </template>

    <DeleteModal
        v-for="modal in deleteModals"
        :key="modal.key"
        :title="modal.title"
        :description="modal.description"
        :open="modals[modal.key]"
        @delete="deleteUser(modal.key)"
        @close="closeModal(modal.key)"
    />

    <DialogModal key="change-role-dialog" :open="modals['change-role-dialog']">
        <form>
          <div class="sm:col-span-3">
            <label for="role" class="block text-sm font-medium leading-6 text-gray-900">
              Edit User Role
            </label>
            <div class="mt-2">
              <select id="role" name="role" autocomplete="role" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                <option>Owner</option>
                <option>Viewer</option>
              </select>
            </div>
          </div>
          <div class="mt-6 flex items-center justify-start gap-x-6">
            <button type="button" @click="closeModal('change-role-dialog')" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
          </div>
        </form>
    </DialogModal>

  </AppLayout>
</template>
