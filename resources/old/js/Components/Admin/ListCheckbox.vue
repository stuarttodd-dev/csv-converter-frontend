<script setup>

import { ref, defineProps } from 'vue';

const props = defineProps({
  items: {
    type: Array,
    default: [],
  },
  title: {
    type: String,
    default: 'List'
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
        <div v-for="item in items" :key="item.id" class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
          <div class="text-sm font-medium leading-6 text-gray-900 sm:col-span-2">{{ item.name }}</div>
          <div class="ml-3 flex h-6 items-center sm:ml-0">
            <input :id="`asset-${item.id}`" :name="`asset-${item.id}`" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
          </div>
        </div>
      </dl>
    </div>
  </div>
</template>
