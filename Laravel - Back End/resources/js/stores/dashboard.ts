import { defineStore } from 'pinia';
import Api from '@/services/api';
export const useDashboardStore = defineStore('dashboard', {
    actions: {
        async fetchSummary() {
            const response = await Api().get('/api-web/dashboard');
            return response;
        },
    },
});
