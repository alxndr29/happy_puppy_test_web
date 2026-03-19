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
                        Master Product
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
                                        >Category:</label
                                    >
                                    <div>
                                        <select
                                            class="form-select form-select-solid"
                                            data-placeholder="Select option"
                                            data-dropdown-parent="#kt_menu_633f092552bb4"
                                            data-allow-clear="true"
                                            v-model="filter_categoryId"
                                        >
                                            <option value="">
                                                -- Select Category --
                                            </option>
                                            <option
                                                v-for="cat in categoryList"
                                                :key="cat.id"
                                                :value="cat.id"
                                            >
                                                {{ cat.name }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="mb-10">
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
                                </div> -->
                                <div class="d-flex justify-content-end">
                                    <button
                                        type="reset"
                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                        data-kt-menu-dismiss="true"
                                        @click="resetFilter"
                                    >
                                        Reset
                                    </button>
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-primary"
                                        data-kt-menu-dismiss="true"
                                        @click="applyFilter"
                                    >
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a
                        @click="openModalProduct"
                        class="btn btn-sm fw-bold btn-primary"
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
                                    placeholder="Search Product"
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
                                :fetchFunction="fetchProducts"
                                :extraParams="filters"
                                :reloadKey="reloadKey"
                            >
                                <template #row="{ row }">
                                    <td>{{ row.name }}</td>
                                    <td>{{ row?.category?.name }}</td>
                                    <td>{{ row.price }}</td>
                                    <td>{{ row.stock }}</td>
                                    <td>
                                        <button
                                            class="btn btn-sm btn-primary me-2"
                                            @click="editProduct(row.id)"
                                        >
                                            Edit
                                        </button>
                                        <button
                                            class="btn btn-sm btn-danger"
                                            @click="deleteProduct(row.id)"
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

    <div class="modal fade" id="modal_product" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <!-- Header -->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <button
                        type="button"
                        class="btn btn-sm btn-icon btn-active-color-primary"
                        @click="closeModalProduct"
                    >
                        ✕
                    </button>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">
                            {{
                                productData.id ? "Edit Product" : "Add Product"
                            }}
                        </h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="fs-6 fw-semibold mb-2">
                            <span class="required">Name</span>
                        </label>
                        <input
                            v-model="productData.name"
                            type="text"
                            class="form-control form-control-solid"
                            placeholder="Enter Name"
                        />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="fs-6 fw-semibold mb-2">
                            <span class="required">Price</span>
                        </label>
                        <input
                            v-model="productData.price"
                            type="number"
                            class="form-control form-control-solid"
                            placeholder="Enter Name"
                        />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="fs-6 fw-semibold mb-2">
                            <span class="required">Stock</span>
                        </label>
                        <input
                            v-model="productData.stock"
                            type="number"
                            class="form-control form-control-solid"
                            placeholder="Enter Name"
                        />
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row">
                        <label class="fs-6 fw-semibold mb-2">
                            <span class="required">Category</span>
                        </label>
                        <select
                            v-model="productData.categoryId"
                            class="form-select form-select-solid"
                        >
                            <option value="">-- Select Category --</option>
                            <option
                                v-for="cat in categoryList"
                                :key="cat.id"
                                :value="cat.id"
                            >
                                {{ cat.name }}
                            </option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button
                            type="button"
                            class="btn btn-light me-3"
                            @click="closeModalProduct"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="submitProduct"
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
import { computed, reactive, ref, onMounted } from "vue";
import customApi from "@/utils/api.ts";
import { useAuthStore } from "@/store/auth.ts";
import DataTable from "@/components/Table.vue";
import { showModal, hideModal } from "@/helpers/modal";
import { swalApiResponse, swalConfirm } from "@/utils/swal";
import { showLoading, hideLoading } from "@/utils/loading";
import { Product } from "@/interfaces/product";
import { Category } from "@/interfaces/category";
import { useMutation, useQuery } from "@tanstack/vue-query";

const authStore = useAuthStore();
const search = ref("");
const filter_categoryId = ref("");
const reloadKey = ref(0);

const columns = [
    { key: "id", label: "No", sortable: true },
    { key: "name", label: "Name", sortable: true },
    { key: "category_id", label: "Category", sortable: true },
    { key: "price", label: "Price", sortable: true },
    { key: "stock", label: "Stock", sortable: true },
    { key: "action", label: "Action", sortable: false },
];
const filters = computed(() => ({
    search: search.value,
    categoryId: filter_categoryId.value,
}));
const applyFilter = () => {
    reloadKey.value++;
};
const resetFilter = () => {
    filter_categoryId.value = "";
    reloadKey.value++;
};
const fetchProducts = async (params: any) => {
    const { data } = await customApi.get("/api-web/master/product", {
        headers: {
            Authorization: `Bearer ${authStore.token}`,
        },
        params,
    });
    return data.data;
};

const productData = reactive<Product>({
    id: "",
    name: "",
    categoryId: "",
    price: 0,
    stock: 0,
});

const openModalProduct = () => {
    // showLoading();
    // const res = await fetchCategory();
    // if (res.data) {
    //     categoryList.value = res.data.data;
    //     hideLoading();
    // }
    showModal("modal_product");
};

const closeModalProduct = () => {
    hideModal("modal_product");
};

const storeProductMutation = useMutation({
    mutationFn: async () => {
        const { data } = await customApi.post("/api-web/master/product", {
            name: productData.name,
            categoryId: productData.categoryId,
            price: productData.price,
            stock: productData.stock,
        });
        return data;
    },
    onMutate: () => {
        showLoading();
    },
    onSuccess: (res) => {
        swalApiResponse(res, {
            successMessage: "Success Add Product",
        });
        closeModalProduct();
        reloadKey.value++;
    },
    onError: (err) => {
        swalApiResponse(err);
    },
    onSettled: () => {
        hideLoading();
    },
});

const updateProductMutation = useMutation({
    mutationFn: async () => {
        const { data } = await customApi.post(
            `/api-web/master/product/${productData.id}/update`,
            {
                name: productData.name,
                categoryId: productData.categoryId,
                price: productData.price,
                stock: productData.stock,
            },
        );
        return data;
    },
    onMutate: () => {
        showLoading();
    },
    onSuccess: (res) => {
        swalApiResponse(res, {
            successMessage: "Success Update Product",
        });
        closeModalProduct();
        reloadKey.value++;
    },
    onError: (err) => {
        swalApiResponse(err);
    },
    onSettled: () => {
        hideLoading();
    },
});

const deleteProductMutation = useMutation({
    mutationFn: async (id: string) => {
        const { data } = await customApi.delete(
            `/api-web/master/product/${id}`,
        );
        return data;
    },
    onMutate: () => {
        showLoading();
    },
    onSuccess: (res) => {
        swalApiResponse(res, {
            successMessage: "Success Delete Customer",
        });
        closeModalProduct?.();
        reloadKey.value++;
    },
    onError: (err) => {
        swalApiResponse(err);
    },
    onSettled: () => {
        hideLoading();
    },
});

const showProductMutation = useMutation({
    mutationFn: async (id: string) => {
        const { data } = await customApi.get(`/api-web/master/product/${id}`);
        return data;
    },
    onMutate: () => {
        showLoading();
    },
    onSuccess: (res) => {
        productData.id = res.data.id;
        productData.name = res.data.name;
        productData.categoryId = res.data.category.id;
        productData.price = res.data.price;
        productData.stock = res.data.stock;
        openModalProduct();
    },
    onError: (err) => {
        swalApiResponse(err);
    },
    onSettled: () => {
        hideLoading();
    },
});

const submitProduct = () => {
    if (productData.id) {
        updateProductMutation.mutate();
    } else {
        storeProductMutation.mutate();
    }
};
const editProduct = async (id: string) => {
    showProductMutation.mutate(id);
};
const deleteProduct = async (id: string) => {
    const confirmed = await swalConfirm({
        title: "Delete Product",
        text: "Product will be deleted permanently",
        confirmText: "Yes, delete",
    });
    if (!confirmed) return;
    deleteProductMutation.mutate(id);
};

const categoryList = computed(() => data.value?.data ?? []);
const { data, isLoading, error } = useQuery({
    queryKey: ["product-category"],
    queryFn: async () => {
        console.log("QUERY JALAN");
        const { data } = await customApi.get(
            "/api-web/master/product/category",
        );
        return data;
    },
});

const resetProduct = () => {
    productData.id = "";
    productData.name = "";
    productData.categoryId = "";
    productData.price = 0;
    productData.stock = 0;
};
</script>
