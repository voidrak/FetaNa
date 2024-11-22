import { createRouter, createWebHistory } from "vue-router";
import Home from "@/views/Home.vue";
import Welcome from "@/views/Welcome.vue";
import ProgramPage from "@/views/ProgramPage.vue";
import CoursePage from "@/views/CoursePage.vue";
import LoginPage from "@/views/Auth/LoginPage.vue";
import RegisterPage from "@/views/Auth/RegisterPage.vue";
import { useAuthStore } from "@/stores/auth";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "welcome",
      component: Welcome,
    },

    {
      path: "/login",
      name: "Login",
      component: LoginPage,
      meta: { guest: true },
    },
    {
      path: "/register",
      name: "Register",
      component: RegisterPage,
      meta: { guest: true },
    },

    {
      path: "/home",
      name: "home",
      component: Home,
      meta: { auth: true },
    },
    {
      path: "/SoftwareEngineering",
      name: "ProgramPage",
      component: ProgramPage,
      meta: { auth: true },
    },
    {
      path: "/webdesign",
      name: "CoursePage",
      component: CoursePage,
      meta: { auth: true },
    },
  ],
});

router.beforeEach(async (to, from) => {
  const authStore = useAuthStore();
  await authStore.getUser();
  if (authStore.user && to.meta.guest) {
    return { name: "home" };
  }
  if (!authStore.user && to.meta.auth) {
    return { name: "Login" };
  }
});

export default router;
