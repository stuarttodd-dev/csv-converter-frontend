<template>
  <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex">

        </div>
        <div class="flex items-center">
          <ButtonGroup :items="navigation" />
          <Menu as="div" class="relative inline-block text-left">
            <div class="mx-1">
              <MenuButton class="inline-flex w-full justify-center gap-x-2.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                Languages
                <ChevronDownIcon class="-mr-1 h-5 w-5 text-gray-400" aria-hidden="true"/>
              </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95">
              <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                  <MenuItem v-slot="{ active }" v-for="(language, index) in languages" :key="index">
                    <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-sm']">{{ language.name }}</a>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
          <button @click="show = !show" type="button" class="relative inline-flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <PlusIcon class="-ml-0.5 h-5 w-5" aria-hidden="true"/>
            About OR&A
          </button>
        </div>
      </div>
    </div>
  </Disclosure>

  <Modal :open="show" @update:open="show = $event">
    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full">
      <ApplicationMark aria-hidden="true" />
    </div>
    <div class="mt-3 text-center sm:mt-5">
      <DialogTitle as="h3" class="text-base font-semibold leading-6 text-gray-900">A little bit about us...</DialogTitle>
      <div class="mt-2">
        <p class="text-sm text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius aliquam laudantium explicabo pariatur iste dolorem animi vitae error totam. At sapiente aliquam accusamus facere veritatis.</p>
      </div>
    </div>
  </Modal>
</template>

<script setup>
import {Disclosure, Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {PlusIcon} from '@heroicons/vue/20/solid'
import {ChevronDownIcon} from '@heroicons/vue/20/solid'

import ApplicationMark from "@/Components/ApplicationMark.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
import ButtonGroup from "@/App/Components/ButtonGroup.vue";

defineProps({
  languages: {
    type: Array,
    default: []
  },
  navigation: {
    type: Array,
    default: []
  },
});

const show = ref(false)

</script>
