<template>
  <Link :href="'/'">
    <div class="flex justify-center">
      <img :src="logo" alt="Logo" style="width: 350px; height: auto;" />
    </div>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import logo from '../../images/logos/logo.png'
</script>
