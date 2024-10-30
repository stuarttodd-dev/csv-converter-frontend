<template>
  <nav aria-label="Progress">
    <ol role="list" class="divide-y divide-gray-300 rounded-md border border-gray-300 md:flex md:divide-y-0">
      <li v-for="(step, stepIdx) in steps" :key="step.name" class="relative md:flex md:flex-1">
        <a :href="step.href" class="group flex items-center">
          <span class="flex items-center px-6 py-4 text-sm font-medium">
            <span v-if="step.key.length > 0" :style="{ backgroundColor: step.colour }" class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-gray-300 group-hover:border-gray-400">
              <span class="text-white group-hover:opacity-50">{{ step.key }}</span>
            </span>
            <span class="ml-4 text-sm font-medium text-gray-900 group-hover:text-gray-900">{{ step.name }}</span>
          </span>
        </a>
        <template v-if="stepIdx !== steps.length - 1">
          <div class="absolute right-0 top-0 hidden h-full w-5 md:block" aria-hidden="true">
            <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
              <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
            </svg>
          </div>
        </template>
      </li>
    </ol>
  </nav>
</template>

<script setup>
import { CheckIcon } from '@heroicons/vue/24/solid'
import {ref} from "vue";

const props = defineProps({
  steps: {
    type: Array,
    default: []
  },
});

const steps = ref(props.steps)

</script>