<template>
  <div class="d-flex flex-column flex-root" id="kt_app_root">
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
      <div class="d-flex flex-lg-row-fluid">
        <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
          <img
            class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
            src="/assets/media/auth/agency.png"
            alt=""
          />
          <img
            class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
            src="/assets/media/auth/agency-dark.png"
            alt=""
          />

          <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
            Fast, Efficient and Productive
          </h1>
          <div class="text-gray-600 fs-base text-center fw-semibold">
            In this kind of post,
            <a href="#" class="opacity-75-hover text-primary me-1"
              >the blogger</a
            >introduces a person they’ve interviewed <br />and provides some
            background information about
            <a href="#" class="opacity-75-hover text-primary me-1"
              >the interviewee</a
            >and their <br />work following this is a transcript of the
            interview.
          </div>
        </div>
      </div>
      <div
        class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12"
      >
        <div class="bg-body d-flex flex-center rounded-4 w-md-600px p-10">
          <div class="w-md-400px">
            <form
              class="form w-100"
              id="kt_sign_in_form"
              @submit.prevent="AuthSubmitHandle"
            >
              <div class="text-center mb-11">
                <h1 class="text-dark fw-bolder mb-3">Register</h1>
              </div>
              <div class="fv-row mb-8">
                <input
                  type="text"
                  v-model="name"
                  placeholder="Name"
                  autocomplete="off"
                  class="form-control bg-transparent"
                />
              </div>
              <div class="fv-row mb-8">
                <input
                  type="text"
                  v-model="email"
                  placeholder="Email"
                  autocomplete="off"
                  class="form-control bg-transparent"
                />
              </div>
              <div class="fv-row mb-3">
                <input
                  type="password"
                  v-model="password"
                  placeholder="Password"
                  autocomplete="off"
                  class="form-control bg-transparent"
                />
              </div>
              <div
                class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8"
              ></div>
              <div class="d-grid mb-10">
                <button
                  type="submit"
                  id="kt_sign_in_submit"
                  class="btn btn-primary"
                >
                  <span class="indicator-label">Sign Up</span>
                  <span class="indicator-progress"
                    >Please wait...
                    <span
                      class="spinner-border spinner-border-sm align-middle ms-2"
                    ></span
                  ></span>
                </button>
              </div>
              <div class="text-gray-500 text-center fw-semibold fs-6">
                Already have an account?
                <router-link to="/login"> Login </router-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { ref } from "vue";
import { useMutation } from "@tanstack/vue-query";
import customApi from "@/utils/api.ts";
import { useRouter } from "vue-router";
import { useAuthStore } from "@/store/auth.ts";
import { swalApiResponse } from "@/utils/swal";

const router = useRouter();
const authStore = useAuthStore();

const name = ref("");
const email = ref("");
const password = ref("");

const AuthMutation = useMutation({
  mutationFn: async () => {
    const { data } = await customApi.post("/auth/register", {
      email: email.value,
      password: password.value,
      name: name.value,
    });
  },
  onSuccess: (res) => {
    swalApiResponse(res, {
      successMessage: "Register success",
    });
  },
  onError: (err) => {
    swalApiResponse(err);
  },
});

const AuthSubmitHandle = () => {
  AuthMutation.mutate();
};

onMounted(() => {
  document.body.className =
    "app-blank bgi-size-cover bgi-position-center bgi-no-repeat";
});
</script>
<style>
body {
  background-image: url("/assets/media/auth/bg10.jpeg");
}
[data-theme="dark"] body {
  background-image: url("/assets/media/auth/bg10-dark.jpeg");
}
</style>
