import { createRouter, createWebHistory } from "vue-router";

import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";
import DefaultLayout from "@/layouts/DefaultLayout.vue";
import Dashboard from "@/views/dashboard/Dashboard.vue";
import Error404 from "@/views/error/Error404.vue";
import { useAuthStore } from "@/store/auth";
import IndexMasterUser from "@/views/master/user/Index.vue";
import IndexMasterCustomer from "@/views/master/customer/Index.vue";
import IndexMasterProduct from "@/views/master/product/Index.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/login",
      name: "login",
      component: Login,
    },
    {
      path: "/register",
      name: "register",
      component: Register,
    },
    {
      path: "/",
      component: DefaultLayout,
      meta: { requiresAuth: true },
      children: [
        {
          path: "dashboard",
          name: "dashboard",
          component: Dashboard,
        },
        {
          path: "master/user",
          name: "masterUser",
          component: IndexMasterUser,
        },
        {
          path: "master/customer",
          name: "masterCustomer",
          component: IndexMasterCustomer,
        },
        {
          path: "master/product",
          name: "masterProduct",
          component: IndexMasterProduct,
        },
      ],
    },
    {
      path: "/:pathMatch(.*)*",
      name: "not-found",
      component: Error404,
    },
  ],
});

router.beforeEach(async (to, from, next) => {
  const auth = useAuthStore();
  if (to.meta.requiresAuth) {
    if (!auth.isAuthenticated || !auth.token) {
      return next({ name: "login" });
    }
  }
  if ((to.name === "login" || to.name === "register") && auth.isAuthenticated) {
    return next({ name: "dashboard" });
  }
  next();
});

export default router;
