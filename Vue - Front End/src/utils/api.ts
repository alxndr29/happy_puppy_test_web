import axios from "axios";
import router from "@/router";
import { useAuthStore } from "@/store/auth";

const api = import.meta.env.VITE_API_URL;

const customApi = axios.create({
  baseURL: `${api}/api`,
});

customApi.interceptors.request.use((config) => {
  const authStore = useAuthStore();

  if (authStore.token) {
    config.headers.Authorization = `Bearer ${authStore.token}`;
  }

  return config;
});

customApi.defaults.headers.get["Cache-Control"] = "no-cache";

customApi.interceptors.response.use(
  (response) => response,
  (error) => {
    const authStore = useAuthStore();
    if (error.response?.status === 401) {
      authStore.$reset?.() || (authStore.token = null);
      if (router.currentRoute.value.path !== "/login") {
        router.push("/login");
      }
    }
    return Promise.reject(error);
  },
);

export default customApi;
