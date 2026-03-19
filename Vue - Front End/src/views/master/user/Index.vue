<template>
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div
                id="kt_app_toolbar_container"
                class="app-container container-xxl d-flex flex-stack"
            >
                <div
                    class="page-title d-flex flex-column justify-content-center flex-wrap me-3"
                >
                    <h1
                        class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"
                    >
                        Master User
                    </h1>
                    <ul
                        class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1"
                    >
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted text-hover-primary"
                                >Home</a
                            >
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Master User</li>
                    </ul>
                </div>

                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <a
                            href="javascript:void(0)"
                            class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold"
                            data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end"
                        >
                            <span
                                class="svg-icon svg-icon-6 svg-icon-muted me-1"
                            >
                                <svg
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </span>
                            Filter</a
                        >

                        <div
                            class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                            data-kt-menu="true"
                            id="kt_menu_633f092552bb4"
                        >
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">
                                    Filter Options
                                </div>
                            </div>
                            <div class="separator border-gray-200"></div>
                            <div class="px-7 py-5">
                                <div class="mb-10">
                                    <label class="form-label fw-semibold"
                                        >Status:</label
                                    >
                                    <div>
                                        <select
                                            class="form-select form-select-solid"
                                            data-kt-select2="true"
                                            data-placeholder="Select option"
                                            data-dropdown-parent="#kt_menu_633f092552bb4"
                                            data-allow-clear="true"
                                        >
                                            <option></option>
                                            <option value="1">Approved</option>
                                            <option value="2">Pending</option>
                                            <option value="2">
                                                In Process
                                            </option>
                                            <option value="2">Rejected</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-10">
                                    <label class="form-label fw-semibold"
                                        >Member Type:</label
                                    >
                                    <div class="d-flex">
                                        <label
                                            class="form-check form-check-sm form-check-custom form-check-solid me-5"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value="1"
                                            />
                                            <span class="form-check-label"
                                                >Author</span
                                            >
                                        </label>
                                        <label
                                            class="form-check form-check-sm form-check-custom form-check-solid"
                                        >
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value="2"
                                                checked="checked"
                                            />
                                            <span class="form-check-label"
                                                >Customer</span
                                            >
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-10">
                                    <label class="form-label fw-semibold"
                                        >Notifications:</label
                                    >
                                    <div
                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            name="notifications"
                                            checked="checked"
                                        />
                                        <label class="form-check-label"
                                            >Enabled</label
                                        >
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button
                                        type="reset"
                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                        data-kt-menu-dismiss="true"
                                    >
                                        Reset
                                    </button>
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-primary"
                                        data-kt-menu-dismiss="true"
                                    >
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        href="#"
                        class="btn btn-sm fw-bold btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_app"
                        >Create</a
                    >
                </div>
            </div>
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div
                id="kt_app_content_container"
                class="app-container container-xxl"
            >
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div
                                class="d-flex align-items-center position-relative my-1"
                            >
                                <span
                                    class="svg-icon svg-icon-1 position-absolute ms-6"
                                >
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <rect
                                            opacity="0.5"
                                            x="17.0365"
                                            y="15.1223"
                                            width="8.15546"
                                            height="2"
                                            rx="1"
                                            transform="rotate(45 17.0365 15.1223)"
                                            fill="currentColor"
                                        ></rect>
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor"
                                        ></path>
                                    </svg>
                                </span>
                                <input
                                    type="text"
                                    data-kt-customer-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-15"
                                    placeholder="Search Users"
                                    v-model="search"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div
                            id="kt_customers_table_wrapper"
                            class="dataTables_wrapper dt-bootstrap4 no-footer"
                        >
                            <DataTable
                                :columns="columns"
                                :fetchFunction="fetchUsers"
                                :extraParams="filters"
                            >
                                <template #row="{ row }">
                                    <td>{{ row.name }}</td>
                                    <td>
                                        {{ row.email }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge"
                                            :class="
                                                row.active
                                                    ? 'badge-light-success'
                                                    : 'badge-light-danger'
                                            "
                                        >
                                            {{
                                                row.active
                                                    ? "Active"
                                                    : "Inactive"
                                            }}
                                        </span>
                                    </td>
                                    <td>
                                        <button
                                            class="btn btn-sm btn-primary me-2"
                                            @click="testFunction(row)"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            class="btn btn-sm btn-danger"
                                            @click="testFunction(row.id)"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </template>
                            </DataTable>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from "vue";
import customApi from "@/utils/api.ts";
import { useAuthStore } from "@/store/auth.ts";
import DataTable from "@/components/Table.vue";

const authStore = useAuthStore();

const search = ref("");
const columns = [
    { key: "name", label: "Name", sortable: true, width: "200px" },
    { key: "email", label: "Email", sortable: true, width: "300px" },
    { key: "action", label: "Action", sortable: false, width: "150px" },
    { key: "action", label: "Action", sortable: false, width: "150px" },
];
const filters = computed(() => ({
    search: search.value,
}));

const fetchUsers = async (params: any) => {
    const { data } = await customApi.get("/users", {
        headers: {
            Authorization: `Bearer ${authStore.token}`,
        },
        params,
    });

    return data;
};

const testFunction = (row: any) => {
    alert(JSON.stringify(row, null, 2));
};
</script>
