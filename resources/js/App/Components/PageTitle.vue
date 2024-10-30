<template>
  <div class="bg-white w-full mb-5">
    <div class="mx-auto max-w-7xl text-center">
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl p-8">
        {{ props.title }}
      </h2>
    </div>
  </div>

</template>

<script setup>

const props = defineProps({
  title: {
    type: String,
    default: ''
  },
});

</script>