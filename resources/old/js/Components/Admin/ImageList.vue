<script setup>

import { ref, defineProps } from 'vue';

const props = defineProps({
  images: {
    type: Array,
    default: [],
  },
  class: {
    type: String
  }
});

const images = ref(props.images);
const classString = ref(props.class);

</script>

<template>
  <div :class="classString">
    <ul role="list" class="mx-auto mt-5 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-2">
      <li>
        <img class="aspect-[3/2] w-full rounded-2xl object-cover" src="@/../images/placeholders/logo.png" alt="" />
      </li>
      <li>
        <img class="aspect-[3/2] w-full rounded-2xl object-cover" src="@/../images/placeholders/qr.png" alt="" />
      </li>
    </ul>
  </div>
</template>
