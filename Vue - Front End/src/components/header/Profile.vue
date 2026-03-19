<template>
    <div class="app-navbar-item ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
        <div
            class="cursor-pointer symbol symbol-35px symbol-md-40px"
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
            data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end"
        >
            <img src="/assets/media/avatars/300-1.jpg" alt="user" />
        </div>
        <div
            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
            data-kt-menu="true"
        >
            <div class="menu-item px-3">
                <div class="menu-content d-flex align-items-center px-3">
                    <div class="symbol symbol-50px me-5">
                        <img alt="Logo" src="/assets/media/avatars/300-1.jpg" />
                    </div>
                    <div class="d-flex flex-column">
                        <div class="fw-bold d-flex align-items-center fs-5">
                            {{ authStore?.user?.data?.name }}
                        </div>
                        <a
                            href="#"
                            class="fw-semibold text-muted text-hover-primary fs-7"
                        >
                            <span class="badge badge-light-success fw-bold">
                                Role:{{
                                    authStore?.user?.data?.role?.name
                                }}</span
                            >
                        </a>
                    </div>
                </div>
            </div>
            <div class="separator my-2"></div>
            <!-- <div class="menu-item px-5">
                <a
                    href="#"
                    class="menu-link px-5"
                    @click="openModalUpdateProfile"
                    >My Profile</a
                >
            </div>
            <div class="separator my-2"></div> -->
            <div class="menu-item px-5">
                <a href="#" class="menu-link px-5" @click="handleLogout()"
                    >Sign Out</a
                >
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_update_profile" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <!-- Header -->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <button
                        type="button"
                        class="btn btn-sm btn-icon btn-active-color-primary"
                        @click="closeModalUpdateProfile"
                    >
                        ✕
                    </button>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Update Profile</h1>
                        <div class="text-muted fw-semibold fs-5">
                            If you need more info, please check
                            <a href="#" class="fw-bold link-primary">
                                Project Guidelines
                            </a>
                        </div>
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="fs-6 fw-semibold mb-2">
                            <span class="required">Name</span>
                        </label>
                        <input
                            type="text"
                            class="form-control form-control-solid"
                            placeholder="Enter Name"
                            v-model="userData.name"
                            readonly="true"
                        />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="fs-6 fw-semibold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input
                            type="email"
                            class="form-control form-control-solid"
                            placeholder="Enter Email"
                            v-model="userData.email"
                            readonly="true"
                        />
                    </div>

                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="fs-6 fw-semibold mb-2">
                            <span class="required">Age</span>
                        </label>
                        <input
                            type="number"
                            class="form-control form-control-solid"
                            placeholder="Enter Age"
                            v-model="userData.profile.age"
                        />
                    </div>
                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-semibold mb-2">Bio</label>
                        <textarea
                            class="form-control form-control-solid"
                            rows="3"
                            placeholder="Type Target Details"
                            v-model="userData.profile.bio"
                        ></textarea>
                    </div>

                    <div class="text-center">
                        <button
                            type="button"
                            class="btn btn-light me-3"
                            @click="closeModalUpdateProfile"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="submitUpdateProfile"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { hideModal, showModal } from "@/helpers/modal";
import type { User } from "@/interfaces/user";
import router from "@/router";
import { useAuthStore } from "@/store/auth";
import customApi from "@/utils/api";
import { swalApiResponse } from "@/utils/swal";
import { useMutation } from "@tanstack/vue-query";
import { onMounted, reactive, ref } from "vue";

const authStore = useAuthStore();

const userData = reactive<User>({
    id: "",
    name: "",
    email: "",
    profile: {
        id: "",
        age: 0,
        bio: "",
    },
});

const updateProfileMutation = useMutation({
    mutationFn: async () => {
        return await customApi.post("/profile", userData.profile, {
            headers: {
                Authorization: `Bearer ${authStore.token}`,
            },
        });
    },
    onSuccess: (response) => {
        swalApiResponse(response, {
            successMessage: "Profile updated succesfully",
        });
        closeModalUpdateProfile();
    },
    onError: (error: any) => {
        swalApiResponse(error);
    },
});
const submitUpdateProfile = () => {
    updateProfileMutation.mutate();
};
const getProfileMutation = useMutation({
    mutationFn: async () => {
        return await customApi.get<User>("/profile", {
            headers: {
                Authorization: `Bearer ${authStore.token}`,
            },
        });
    },
    onSuccess: (response) => {
        Object.assign(userData, response.data);
    },
    onError: (error: any) => {
        swalApiResponse(error);
    },
});

const logOutMutation = useMutation({
    mutationFn: async () => {
        authStore.removeAuth();
    },
    onSuccess: () => {
        router.push({ name: "dashboard" });
    },
    onError: (error) => {
        swalApiResponse(error);
    },
});
const handleLogout = () => {
    logOutMutation.mutate();
};

const openModalUpdateProfile = () => {
    getProfileMutation.mutate();
    showModal("modal_update_profile");
};

const closeModalUpdateProfile = () => {
    hideModal("modal_update_profile");
};
</script>
