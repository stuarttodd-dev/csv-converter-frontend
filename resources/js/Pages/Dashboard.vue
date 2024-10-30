<template>
    <AppLayout title="Dashboard">

      <PageTitle title="Administrator Menu" />
      <Banner
          :open="error"
          :message="error"
          bgColour="bg-red-500"
          @close="error = null"
      />

      <div class="bg-white py-2 sm:py-6" v-if="groups.length > 0">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="-mx-6 grid grid-cols-2 gap-0.5 overflow-hidden sm:mx-0 sm:rounded-2xl md:grid-cols-3">
            <div class="bg-gray-400/5 p-8 sm:p-10 transition-colors duration-300 hover:bg-gray-200" v-for="(group, index) in groups" :key="group.id">
              <a :href="group.href" class="flex flex-col items-center text-center">
                <span :class="`${group.icon_class} text-4xl mb-4`"></span>
                <h2 class="font-bold">{{ group.group_name }}</h2>
              </a>
            </div>
          </div>
        </div>
      </div>

      <EmptyContent
          message="This account has no assigned permissions, please contact your administrator."
          v-if="groups.length == 0"
      />


    </AppLayout>
</template>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import PageTitle from "@/App/Components/PageTitle.vue";
import Banner from "@/App/Components/Banner.vue";
import EmptyContent from "@/App/Components/EmptyContent.vue";

import {ref} from "vue";

const props = defineProps({
  groups: {
    type: Object,
    default: {}
  },
  error: {
    type: String,
    default: ''
  }
});

const error = ref(props.error)

</script>
