<script setup>

import {CalendarDateRangeIcon} from "@heroicons/vue/24/outline";

const cards = [
  { name: 'All Notifiable Dates', href: route('assets.list'), icon: CalendarDateRangeIcon, amount: '1453', color: '' },
  { name: 'More Than 30 Days', href: route('assets.list'), icon: CalendarDateRangeIcon, amount: '1304', color: 'bg-green-100'  },
  { name: 'Less Than 30 Days', href: route('assets.list'), icon: CalendarDateRangeIcon, amount: '49', color: 'bg-orange-100'  },
  { name: 'Date Passed', href: route('assets.list'), icon: CalendarDateRangeIcon, amount: '100', color: 'bg-red-100'  },
]

</script>

<template>
    <div class="mx-auto max-w-6xl my-8">
      <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <div v-for="card in cards" :key="card.name" class="overflow-hidden rounded-lg bg-white shadow">
          <a :href="card.href" class="block hover:opacity-50">
            <div :class="['p-5', card.color]">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <component :is="card.icon" class="h-6 w-6 text-gray-400" aria-hidden="true" />
                </div>
                <div class="ml-5 w-0 flex-1">
                  <dl>
                    <dt class="truncate text-sm font-medium">{{ card.name }}</dt>
                    <dd>
                      <div class="text-lg font-medium text-gray-900">{{ card.amount }}</div>
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
</template>
