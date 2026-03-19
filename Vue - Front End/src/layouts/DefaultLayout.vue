<script setup lang="ts">
import Header from "@/components/header/Header.vue";
import Sidebar from "@/components/sidebar/Sidebar.vue";

import { onMounted, onUnmounted, nextTick } from "vue";

onMounted(async () => {
  await nextTick();
  if (window.KTComponents) {
    window.KTComponents.init();
  }
  if (window.initTemplate) {
    window.initTemplate();
  }
});

onMounted(() => {
  const body = document.body;

  body.id = "kt_app_body";
  body.className = "app-default";

  body.setAttribute("data-kt-app-layout", "light-sidebar");
  body.setAttribute("data-kt-app-sidebar-enabled", "true");
  body.setAttribute("data-kt-app-sidebar-fixed", "true");
  body.setAttribute("data-kt-app-sidebar-hoverable", "true");
  body.setAttribute("data-kt-app-sidebar-push-header", "true");
  body.setAttribute("data-kt-app-sidebar-push-toolbar", "true");
  body.setAttribute("data-kt-app-sidebar-push-footer", "true");
  body.setAttribute("data-kt-app-toolbar-enabled", "true");
});

onUnmounted(() => {
  const body = document.body;
  // cleanup saat pindah layout (misal ke login)
  body.id = "";
  body.className = "";
  body.removeAttribute("data-kt-app-layout");
  body.removeAttribute("data-kt-app-sidebar-enabled");
  body.removeAttribute("data-kt-app-sidebar-fixed");
  body.removeAttribute("data-kt-app-sidebar-hoverable");
  body.removeAttribute("data-kt-app-sidebar-push-header");
  body.removeAttribute("data-kt-app-sidebar-push-toolbar");
  body.removeAttribute("data-kt-app-sidebar-push-footer");
  body.removeAttribute("data-kt-app-toolbar-enabled");
});
</script>
<template>
  <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
      <Header />
      <Sidebar />
    </div>
  </div>
</template>
