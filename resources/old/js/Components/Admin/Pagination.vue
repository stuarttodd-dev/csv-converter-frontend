<script setup>

import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid'
import { ref } from 'vue'

const props = defineProps({
  total: {
    type: Number,
    default: 95,
  },
  start: {
    type: Number,
    default: 11,
  },
  end: {
    type: Number,
    default: 20,
  },
  page: {
    type: Number,
    default: 2,
  },
  perPage: {
    type: Number,
    default: 10,
  },
  totalPages: {
    type: Number,
    default: 10,
  },
});

const page = ref(props.page);
const start = ref(props.start);
const end = ref(props.end);

const previousPage = () => {
  if (page.value > 1) {
    page.value--;
  }

  start.value = (page.value - 1) * props.perPage + 1
  end.value = page.value * props.perPage;
};

const nextPage = () => {
  if (page.value !== props.totalPages) {
    page.value++;
  }

  start.value = (page.value - 1) * props.perPage + 1
  end.value = page.value * props.perPage;
};

const setPage = (newPage) => {
  page.value = newPage;

  start.value = (page.value - 1) * props.perPage + 1
  end.value = page.value * props.perPage;
};

</script>

<template>
  <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
    <div class="flex flex-1 justify-between sm:hidden">
      <a href="#" @click.prevent="previousPage" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
      <a href="#" @click.prevent="nextPage" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
    </div>
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Showing
          {{ ' ' }}
          <span class="font-medium">{{ start }}</span>
          {{ ' ' }}
          to
          {{ ' ' }}
          <span class="font-medium">{{ end > total ? total : end }}</span>
          {{ ' ' }}
          of
          {{ ' ' }}
          <span class="font-medium">{{ total }}</span>
          {{ ' ' }}
          results
        </p>
      </div>
      <div v-if="totalPages > 1">
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          <a href="#" @click.prevent="previousPage" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
            <span class="sr-only">Previous</span>
            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
          </a>

          <a href="#" v-for="n in totalPages" :key="n" @click.prevent="setPage(n)" :class="n !== page ? 'relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' : 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'">
            {{ n }}
          </a>

          <a href="#" @click.prevent="nextPage" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
          <span class="sr-only">Next</span>
            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
          </a>
        </nav>
      </div>
    </div>
  </div>
</template>
