<template>
  <div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="auth-bg"></div>
    <div class="d-flex flex-column flex-center flex-column-fluid">
      <div class="d-flex flex-column flex-center text-center p-10">
        <div class="card card-flush w-lg-650px py-5">
          <div class="card-body py-15 py-lg-20">
            <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">
              Oops!
            </h1>

            <div class="fw-semibold fs-6 text-gray-500 mb-7">
              We can't find that page.
            </div>

            <div class="mb-3">
              <img
                src="/assets/media/auth/404-error.png"
                class="mw-100 mh-300px theme-light-show"
                alt="404"
              />

              <img
                src="/assets/media/auth/404-error-dark.png"
                class="mw-100 mh-300px theme-dark-show"
                alt="404"
              />
            </div>

            <div class="mb-0">
              <router-link
                to="/"
                class="btn btn-sm btn-primary"
              >
                Return Home
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">

</script>

<style scoped>
.auth-bg {
  position: fixed;
  inset: 0;
  background-image: url('/assets/media/auth/bg1.jpg');
  background-size: cover;
  background-position: center;
  z-index: -1;
}

[data-theme='dark'] .auth-bg {
  background-image: url('/assets/media/auth/bg1-dark.jpg');
}
</style>
