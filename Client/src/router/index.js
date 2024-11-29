import { createRouter, createWebHistory } from "vue-router";
import Home from "@/views/Home.vue";
import Welcome from "@/views/Welcome.vue";
import ProgramPage from "@/views/ProgramPage.vue";
import CoursePage from "@/views/CoursePage.vue";
import LoginPage from "@/views/Auth/LoginPage.vue";
import RegisterPage from "@/views/Auth/RegisterPage.vue";
import { useAuthStore } from "@/stores/auth";
import TestUi from "@/Components/Ui/TestUi.vue";
import AdminHome from "@/views/Admin/AdminHome.vue";
import AdminAddProgram from "@/Components/Admin/AdminAddProgram.vue";
import AdminProgramPage from "@/views/Admin/AdminProgramPage.vue";
import AdminAddCourse from "@/Components/Admin/AdminAddCourse.vue";

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
      path: "/admin",
      name: "adminHome",
      component: AdminHome,
      meta: { admin: true },
    },
    {
      path: "/admin/add-program",
      name: "addProgram",
      component: AdminAddProgram,
      meta: { admin: true },
    },
    {
      path: "/admin/add-course",
      name: "addCourse",
      component: AdminAddCourse,
      meta: { admin: true },
    },
    {
      path: "/programs/:id",
      name: "AdminProgramPage",
      component: AdminProgramPage,
      meta: { admin: true },
    },
    {
      path: "/programs/:id",
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

    {
      path: "/testUi",
      name: "TestUi",
      component: TestUi,
      meta: { auth: true },
    },
  ],
});

router.beforeEach(async (to, from) => {
  const authStore = useAuthStore();
  await authStore.getUser();

  if (authStore.user?.role === "admin" && to.meta.guest) {
    return { name: "adminHome" };
  }
  if (authStore.user?.role === "admin" && to.meta.auth) {
    return { name: "adminHome" };
  }
  if (authStore.user?.role !== "admin" && to.meta.admin) {
    return { name: "home" };
  }
  if (authStore.user && to.meta.guest) {
    return { name: "home" };
  }
  if (!authStore.user && to.meta.auth) {
    return { name: "Login" };
  }
});

export default router;
