import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import Welcome from "@/views/Welcome.vue";
import ProgramPage from "@/views/ProgramPage.vue";
import CoursePage from "@/views/CoursePage.vue";
import LoginPage from "@/views/Auth/LoginPage.vue";
import RegisterPage from "@/views/Auth/RegisterPage.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      name: "welcome",
      component: Welcome,
    },
    {
      path: "/home",
      name: "home",
      component: Home,
    },
    {
      path: "/SoftwareEngineering",
      name: "Program Page",
      component: ProgramPage,
    },
    {
      path: "/webdesign",
      name: "Course Page",
      component: CoursePage,
    },
    {
      path: "/login",
      name: "Login Page",
      component: LoginPage,
    },
    {
      path: "/register",
      name: "Register",
      component: RegisterPage,
    },
  ],
});

export default router;
