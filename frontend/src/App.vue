<script setup>
import Table from "@/components/Table.vue";
import Pagination from "@/components/Pagination.vue";
import {computed, onBeforeMount, ref} from 'vue';
import axios from "axios";

const lastUpdatedTime = ref('2024.12.12');
const rates = ref([]);
const currentPage = ref(1);
const itemsPerPage = ref(10);
let isAscending = true;

const paginatedRates = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage.value;
  const end = start + itemsPerPage.value;
  return rates.value.slice(start, end);
});

const toggleSortOrder = () => {
  isAscending = !isAscending;

  rates.value.sort((a, b) => {
    const order = isAscending ? 1 : -1;
    return order * (a.lastUpdate - b.lastUpdate);
  });
};

const formatDate = (timestamp) => {
  const date = new Date(timestamp * 1000);
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  return `${day}.${month}.${year}`;
};

// can separate to http/main.js
const fetchRates = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8080/rates/EUR');
    rates.value = response.data.items;
    const maxLastUpdate = Math.max(...rates.value.map(rate => rate.lastUpdate));
    lastUpdatedTime.value = formatDate(maxLastUpdate);
  } catch (error) {
    console.error('There was a problem with the fetch operation:', error);
  }
};

onBeforeMount(fetchRates);

const usdRates = computed(() => {
  return rates.value
      .map(rate => rate.rates && rate.rates['USD'])
      .filter(rate => typeof rate === 'number');
});

const minRate = computed(() => {
  if (usdRates.value.length === 0) return 0.0000;
  return usdRates.value.reduce((a, b) => Math.min(a, b), Infinity).toFixed(4);
});

const maxRate = computed(() => {
  if (usdRates.value.length === 0) return 0.0000;
  return usdRates.value.reduce((a, b) => Math.max(a, b), -Infinity).toFixed(4);
});

const avgRate = computed(() => {
  const length = usdRates.value.length;
  if (length === 0) return 0.0000;
  const sum = usdRates.value.reduce((acc, rate) => acc + rate, 0);
  return (sum / length).toFixed(4);
});
</script>

<template>
  <div class="overflow-x-auto">
    <div class="flex items-center flex-col ">
      <h2>1 EUR TO USD Exchange Rate</h2>
      <h3 class="ml-5">Last Updated: {{ lastUpdatedTime }}</h3>
    </div>
    <Pagination
        :currentPage="currentPage"
        :rates="rates"
        :itemsPerPage="itemsPerPage"
        @update:currentPage="currentPage = $event"
    />
    <Table
        :paginatedRates="paginatedRates"
        :formatDate="formatDate"
        :isAscending="isAscending"
        :toggleSortOrder="toggleSortOrder"
        :minRate="minRate"
        :maxRate="maxRate"
        :avgRate="avgRate"
    />
    <Pagination
        :currentPage="currentPage"
        :rates="rates"
        :itemsPerPage="itemsPerPage"
    />
  </div>
</template>

<style scoped>
/* Your scoped styles here */
</style>
