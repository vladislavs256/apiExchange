<script setup>
import Table from "@/components/Table.vue";
import Pagination from "@/components/Pagination.vue";
import {computed, onBeforeMount, ref} from 'vue';
import axios from "axios";
import {fetchRates} from "@/http/api.js";

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


onBeforeMount(() => {
  fetchRates(selectedCurrency).then(data => {
    rates.value = data;
  });
});

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



let currencies = ['EUR', 'USD',  'CAD', 'GBP', 'AUD'];
let selectedCurrency = 'EUR';

function changeCurrency(currency) {
  selectedCurrency = currency;
  fetchRates(selectedCurrency).then(data => {
    rates.value = data;
  });
}
</script>

<template>
  <div class="overflow-x-auto">
    <div class="flex items-center flex-col">
      <h2>1
        <select id="currency-selector" @change="changeCurrency($event.target.value)">
          <option v-for="currency in currencies" :key="currency" :value="currency">{{ currency }}</option>
        </select> TO USD Exchange Rate
      </h2>
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
