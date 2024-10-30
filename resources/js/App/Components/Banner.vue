<template>
  <div
      :class="`flex items-center gap-x-6 px-6 py-2.5 sm:px-3.5 sm:before:flex-1 ${bgColour}`"
      v-if="open"
  >
    <p class="text-sm leading-6 text-white font-bold">
      {{ message }}
    </p>
    <div class="flex flex-1 justify-end">
      <button type="button" class="-m-3 p-3 focus-visible:outline-offset-[-4px]">
        <span class="sr-only">Dismiss</span>
        <XMarkIcon class="h-5 w-5 text-white" aria-hidden="true" @click="$emit('close')" />
      </button>
    </div>
  </div>
</template>

<script setup>
import { XMarkIcon } from '@heroicons/vue/20/solid'
import { ref, watch } from 'vue'

const props = defineProps({
  open: {
    type: Boolean,
    default: false
  },
  message: {
    type: String,
    default: ''
  },
  bgColour: {
    type: String,
    default: 'bg-green-500'
  }
})

const open = ref(props.open)

watch(() => props.open, (newValue) => {
  open.value = newValue
})
</script>

<style scoped>
/* Add any additional scoped styles here */
</style>
