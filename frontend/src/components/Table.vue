<script setup>

defineProps({
  paginatedRates: Array,
  formatDate: Function,
  isAscending: Boolean,
  toggleSortOrder: Function,
  minRate: String,
  maxRate: String,
  avgRate: String,
})

</script>

<template>
  <table class="table-auto w-full">
    <thead>
    <tr>
      <th class="px-4 py-2" @click="toggleSortOrder">
        Update Date
        <span v-if="isAscending">^</span>
        <span v-else>↓</span>
      </th>
      <th class="px-4 py-2">EUR TO USD</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="rate in paginatedRates" :key="rate.lastUpdate">
      <td class="border px-4 py-2">{{ formatDate(rate.lastUpdate) }}</td>
      <td class="border px-4 py-2">{{ rate.rates && rate.rates['USD'] }}</td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
      <td colspan="2" class="border px-4 py-2">Minimum: {{ minRate }}, Maximum: {{ maxRate}}, Average: {{ avgRate }}</td>
    </tr>
    </tfoot>
  </table>
</template>

<style scoped>

</style>