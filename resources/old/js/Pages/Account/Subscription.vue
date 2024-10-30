<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumbs from "@/Components/Admin/Breadcrumbs.vue";

const pages = [
  { name: 'Account Subscription', href: '#', current: true },
]

</script>

<template>
    <AppLayout title="Account Subscription">
      <Breadcrumbs :pages="pages" />
        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                <div>
                  <div class="border-b border-gray-900/10 pb-6">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Your Subscription</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Please click the button below to manage your subscription.  We use Stripe to securely handle payments.</p>
                  </div>

                  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <button type="button" class="w-full rounded-md bg-indigo-600 px-3.5 py-2.5 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Manage Subscription</button>
                  </div>

                </div>
              </div>
            </div>
        </div>
    </AppLayout>
</template>
