<script setup>
defineProps( {
    currentPage: Number,
    totalPages: Number,
    getPageRange: Function,
    nextPage: Function,
    prevPage: Function,
  }
)
</script>

<template>
  <div class="flex justify-center items-center">
    <button @click="prevPage" :disabled="currentPage === 1"> < </button>
    <span v-if="currentPage > 3">
      <button @click="currentPage = 1">1</button>
      <span>...</span>
    </span>
    <span v-for="pageNumber in getPageRange()" :key="pageNumber">
      <button v-if="pageNumber !== '...'" @click="currentPage = pageNumber">{{ pageNumber }}</button>
      <span v-else>...</span>
    </span>
    <span v-if="totalPages - currentPage > 2">
      <span>...</span>
      <button @click="currentPage = totalPages">{{ totalPages }}</button>
    </span>
    <button @click="nextPage" :disabled="currentPage === totalPages"> > </button>
  </div>
</template>

<style scoped>

</style>