<script setup>
import { computed, defineProps, defineEmits } from 'vue';

// Define props
const props = defineProps({
  currentPage: Number,
  rates: Array,
  itemsPerPage: Number,
});
const emit = defineEmits(['update:currentPage']);

const totalPages = computed(() => Math.ceil(props.rates.length / props.itemsPerPage));

const nextPage = () => {
  if (props.currentPage < totalPages.value) {
    emit('update:currentPage', props.currentPage + 1);
  }
};

const prevPage = () => {
  if (props.currentPage > 1) {
    emit('update:currentPage', props.currentPage - 1);
  }
};

const getPageRange = () => {
  const range = [];
  const total = totalPages.value;
  const current = props.currentPage;

  let start = Math.max(current - 1, 2);
  let end = Math.min(current + 1, total - 1);
  for (let i = start; i <= end; i++) {
    range.push(i);
  }

  return range;
};
</script>

<template>
  <div class="flex justify-center items-center">
    <button @click="prevPage" :disabled="props.currentPage === 1"> &lt; </button>
    <span v-if="props.currentPage > 3">
      <button @click="emit('update:currentPage', 1)">1</button>
      <span>...</span>
    </span>
    <span v-for="pageNumber in getPageRange()" :key="pageNumber">
      <button v-if="pageNumber !== '...'" @click="emit('update:currentPage', pageNumber)">{{ pageNumber }}</button>
      <span v-else>...</span>
    </span>
    <span v-if="totalPages - props.currentPage > 2">
      <span>...</span>
      <button @click="emit('update:currentPage', totalPages)">{{ totalPages }}</button>
    </span>
    <button @click="nextPage" :disabled="props.currentPage === totalPages"> &gt;</button>
  </div>
</template>

<style scoped>

</style>
