<script setup>
import { ref } from 'vue'
import { TrashIcon, DocumentArrowUpIcon } from '@heroicons/vue/20/solid'

const filelist = ref([])

const emit = defineEmits(['filesChanged'])

const onChange = (event) => {
  filelist.value = [...filelist.value, ...event.target.files]
  emit('filesChanged', filelist.value)
}

const remove = (index) => {
  filelist.value.splice(index, 1)
  emit('filesChanged', filelist.value)
}

const dragover = (event) => {
  event.preventDefault()
  if (!event.currentTarget.classList.contains('bg-green-300')) {
    event.currentTarget.classList.remove('bg-gray-100')
    event.currentTarget.classList.add('bg-green-300')
  }
}

const dragleave = (event) => {
  event.currentTarget.classList.add('bg-gray-100')
  event.currentTarget.classList.remove('bg-green-300')
}

const drop = (event) => {
  event.preventDefault()
  const files = event.dataTransfer.files
  filelist.value = [...files]
  event.currentTarget.classList.add('bg-gray-100')
  event.currentTarget.classList.remove('bg-green-300')
}

</script>

<template>
  <div class="flex w-full items-center justify-center text-center">
    <div class="p-12 bg-gray-100 border border-gray-300" @dragover="dragover" @dragleave="dragleave" @drop="drop">
      <input type="file" multiple name="fields[assetsFieldHandle][]" id="assetsFieldHandle"
             class="w-px h-px opacity-0 overflow-hidden absolute" @change="onChange" ref="file"
             accept=".pdf,.jpg,.jpeg,.png"/>
      <label for="assetsFieldHandle" class="block cursor-pointer">
          Drop files in here or <span class="underline">double click</span> to upload files.
      </label>
      <ul class="mt-4" v-if="filelist.length" v-cloak>
        <li class="text-sm p-1 flex items-center" v-for="(file, index) in filelist" :key="index">
          <div class="px-4 py-1 sm:col-span-1 sm:px-0 flex items-center">
            <dt class="text-sm font-medium leading-6 text-gray-900 font-semibold flex items-center">
              <DocumentArrowUpIcon class="mr-1 w-4" />
              {{ file.name }}
            </dt>
            <dd class="text-sm leading-6 text-gray-700">
              <TrashIcon class="ml-2 w-4 cursor-pointer" @click="remove(index)" />
            </dd>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<style>
[v-cloak] {
  display: none;
}
</style>
