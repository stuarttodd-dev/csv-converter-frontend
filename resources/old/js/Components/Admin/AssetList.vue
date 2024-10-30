<script setup>

import { ref, defineProps } from 'vue';

const props = defineProps({
  assets: {
    type: Array,
    default: [],
  },
  title: {
    type: String,
    default: 'Asset Properties'
  },
  class: {
    type: String
  }
});

const assets = ref(props.assets);
const classString = ref(props.class);

</script>

<template>
  <div :class="classString">
    <div class="px-4 sm:px-0">
      <h3 class="text-base font-semibold leading-7 text-gray-900">{{ title }}</h3>
    </div>
    <div class="mt-6 border-t border-gray-100">
      <dl class="divide-y divide-gray-100">
        <div v-for="asset in assets" class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <dt class="text-sm font-medium leading-6 text-gray-900">{{ asset.name }}</dt>
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ asset.value }}</dd>
        </div>
      </dl>
    </div>
  </div>
</template>
