<template>
  <router-view />
  <div
    v-if="loadingState.isLoading"
    id="page-loading"
    class="d-flex justify-content-center align-items-center"
  >
    <img src="/assets/media/img-loader.gif" alt="Loading..." />
  </div>
</template>

<script setup lang="ts">
import { loadingState } from "@/utils/loading";
</script>

<style scoped>
#page-loading {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 99999;
  background-color: rgba(230, 241, 255, 0.611);
}
</style>