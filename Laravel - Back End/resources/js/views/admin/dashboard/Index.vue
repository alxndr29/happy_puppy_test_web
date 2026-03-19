<template>
    <div class="container-fluid">
        <div class="card mt-8">
            <div class="card-body">
                <div class="head d-flex align-items-center justify-content-between">
                    <div>
                        <h1>Dashboard</h1>
                        <span class="text-muted">Pantau perkembangan dan aktivitasmu sekarang</span>
                    </div>
                </div>
                <div class="form-group mt-5">
                    <apexchart type="bar" height="350" :options="chartOptions" :series="series" />
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { ref, onMounted } from 'vue';
import VueApexCharts from 'vue3-apexcharts';
import type { ApexOptions } from 'apexcharts';
import { initializeAppPlugins } from '@src/plugins/global';

// import {
//     useDashboardStore
// } from "@stores/dashboard";
// import { IDashboardPayload } from '@/types/dashboard';

// const dashboardStore = useDashboardStore();

// Register chart component
const apexchart = VueApexCharts;

// Reactive state
const series = ref([
    {
        name: 'Pengunjung',
        type: 'column',
        data: [] as number[],
    },
    {
        name: 'Nilai',
        type: 'line',
        data: [] as number[],
    },
]);

const chartOptions = ref<ApexOptions>({
    chart: {
        stacked: false,
        toolbar: { show: false },
    },
    title: {
        text: 'Pengunjung',
        align: 'left',
        style: {
            fontSize: '20px',
            fontWeight: 600,
        },
    },
    dataLabels: {
        enabled: true,
        enabledOnSeries: [1],
        style: {
            colors: ['#fff'],
        },
        background: {
            enabled: true,
            foreColor: '#fff',
            padding: 4,
            borderRadius: 4,
            backgroundColor: '#FFC107',
        },
    },
    stroke: {
        width: [0, 3],
        curve: 'smooth',
    },
    colors: ['#2196F3', '#FFC107'],
    xaxis: {
        categories: [],
    },
    yaxis: [{}, { opposite: true }],
    legend: {
        show: false,
    },
});

// async function getSummaryDashboard(): Promise<void> {
//     try {
//         const res = await dashboardStore.fetchSummary()
//         const result = res.data.data as IDashboardPayload[];

//         const years = result.map((item) => String(item.year));
//         const totals = result.map((item) => item.total);

//         const max = Math.ceil(Math.max(...totals) * 1.01);
//         const min = 0;

//         series.value = [
//             {
//                 name: 'Pengunjung',
//                 type: 'column',
//                 data: totals,
//             },
//             {
//                 name: 'Nilai',
//                 type: 'line',
//                 data: totals,
//             },
//         ];

//         chartOptions.value = {
//             ...chartOptions.value,
//             xaxis: {
//                 ...chartOptions.value.xaxis,
//                 categories: years,
//             },
//             yaxis: [
//                 { min, max },
//                 { opposite: true, min, max },
//             ],
//         };
//     } catch (error) {
//         axiosHandleError(error);
//     }
// }

onMounted(() => {
    initializeAppPlugins();
    // getSummaryDashboard()
});
</script>

<script lang="ts">
export default {
    components: {
        apexchart: VueApexCharts,
    },
};
</script>
