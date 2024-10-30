<template>
    <AppLayout title="Page Under Construction">
      <Breadcrumbs :pages="pages" />
      <PageTitle title="Page Under Construction" />
      <EmptyContent message="We're working behind the scenes to get this page operational. Please check back later." />
    </AppLayout>
</template>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import EmptyContent from "@/App/Components/EmptyContent.vue";
import PageTitle from "@/App/Components/PageTitle.vue";
import Breadcrumbs from "@/App/Components/Breadcrumbs.vue";

const pages = [
  { name: 'Page Under Construction', href: '#', current: true }
];

</script>
