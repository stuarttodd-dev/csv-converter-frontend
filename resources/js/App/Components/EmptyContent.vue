<template>
  <div className="bg-red-500 my-2">
    <div className="mx-auto max-w-7xl px-3 py-3">
      <div className="flex items-center justify-center">
        <p className="truncate text-center font-bold text-white">
          <span>{{ message }}</span>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  message: {
    type: String,
    default: 'Nothing to see here... try adding some items.'
  },
});
</script>
