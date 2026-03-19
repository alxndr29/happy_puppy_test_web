<template>
    <!-- ================= TABLE ================= -->
    <div class="table-responsive">
        <table
            class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
            id="kt_customers_table"
            style="table-layout: fixed"
        >
            <thead>
                <tr
                    class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0"
                >
                 
                    <th
                        v-for="col in columns"
                        :key="col.key"
                        :style="{ width: col.width || 'auto' }"
                        :class="col.sortable ? getSortClass(col.key) : ''"
                        @click="col.sortable && sortColumn(col.key)"
                    >
                        {{ col.label }}
                    </th>
                </tr>
            </thead>
            <tbody class="fw-semibold">
                <tr v-if="isLoading || isFetching">
                    <td :colspan="columns.length + 1" class="text-center py-10">
                        <img
                            src="/assets/media/img-loader.gif"
                            alt="Loading..."
                            width="60"
                        />
                    </td>
                </tr>

                <tr v-else-if="rows.length === 0">
                    <td :colspan="columns.length + 1" class="text-center py-10">
                        No data found
                    </td>
                </tr>

                <tr v-else v-for="(row, index) in rows" :key="row.id">
                    <td>
                        {{ (page - 1) * limit + index + 1 }}
                    </td>

                    <slot name="row" :row="row" :index="index" />
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div
            class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start"
        >
            <div class="dataTables_length">
                <label>
                    <select
                        class="form-select form-select-sm form-select-solid"
                        :value="limit"
                        @change="limit = Number($event.target.value)"
                    >
                        <option :value="10">10</option>
                        <option :value="25">25</option>
                        <option :value="50">50</option>
                        <option :value="100">100</option>
                    </select>
                </label>
            </div>
        </div>
        <div
            class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end"
        >
            <div class="dataTables_paginate paging_simple_numbers">
                <ul class="pagination">
                    <li
                        class="paginate_button page-item previous"
                        :class="{ disabled: page === 1 }"
                    >
                        <a href="#" class="page-link" @click.prevent="prevPage">
                            <i class="previous"></i>
                        </a>
                    </li>
                    <li
                        v-for="(p, i) in pages"
                        :key="i"
                        class="paginate_button page-item"
                        :class="{ active: page === p }"
                    >
                        <a
                            v-if="p !== '...'"
                            href="#"
                            class="page-link"
                            @click.prevent="goToPage(p)"
                        >
                            {{ p }}
                        </a>

                        <span v-else class="page-link">...</span>
                    </li>
                    <li
                        class="paginate_button page-item next"
                        :class="{ disabled: page === lastPage }"
                    >
                        <a href="#" class="page-link" @click.prevent="nextPage">
                            <i class="next"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref, computed, watch } from "vue";
import { useQuery } from "@tanstack/vue-query";
import { useDebounce } from "@vueuse/core";

const props = defineProps({
    columns: Array,
    fetchFunction: Function,
    extraParams: {
        type: Object,
        default: () => ({}),
    },
    reloadKey: {
        type: Number,
        default: 0,
    },
});

const debouncedParams = useDebounce(
    computed(() => props.extraParams),
    500,
);

const page = ref(1);
const limit = ref(10);
const sortBy = ref("id");
const sortOrder = ref("desc");

const fetchData = async () => {
    return await props.fetchFunction({
        page: page.value,
        limit: limit.value,
        sortBy: sortBy.value,
        sortOrder: sortOrder.value,
        ...debouncedParams.value,
    });
};

const { data, isLoading, isFetching, refetch } = useQuery({
    queryKey: ["datatable", page, limit, sortBy, sortOrder, debouncedParams],
    queryFn: fetchData,
    keepPreviousData: true,
    placeholderData: (previousData) => previousData,
});

const rows = computed(() => data.value?.data ?? []);
const lastPage = computed(() => data.value?.lastPage ?? 1);

const nextPage = () => {
    if (page.value < lastPage.value) page.value++;
};

const prevPage = () => {
    if (page.value > 1) page.value--;
};

const goToPage = (p: number) => {
    page.value = p;
};

const sortColumn = (column: string) => {
    if (sortBy.value === column) {
        sortOrder.value = sortOrder.value === "asc" ? "desc" : "asc";
    } else {
        sortBy.value = column;
        sortOrder.value = "asc";
    }

    page.value = 1;
};

const getSortClass = (column: string) => {
    if (sortBy.value !== column) return "sorting";

    return sortOrder.value === "asc"
        ? "sorting sorting_asc"
        : "sorting sorting_desc";
};

const pages = computed<(number | string)[]>(() => {
    const total = lastPage.value;
    const current = page.value;
    const maxVisible = 3;

    if (total <= maxVisible) {
        return Array.from({ length: total }, (_, i) => i + 1);
    }

    const result: (number | string)[] = [];

    let start = current - 1;
    let end = current + 1;

    if (start < 1) {
        start = 1;
        end = 3;
    }

    if (end > total) {
        end = total;
        start = total - 2;
    }

    if (start > 1) {
        result.push(1);
        if (start > 2) result.push("...");
    }

    for (let i = start; i <= end; i++) {
        result.push(i);
    }

    if (end < total) {
        if (end < total - 1) result.push("...");
        result.push(total);
    }

    return result;
});

watch(
    debouncedParams,
    () => {
        page.value = 1;
    },
    { deep: true },
);
watch(limit, () => {
    page.value = 1;
});

watch(
    () => props.reloadKey,
    () => {
        refetch();
    },
);
</script>
