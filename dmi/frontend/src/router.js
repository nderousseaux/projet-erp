import { createRouter, createWebHistory } from "vue-router";
import HomeView from "@/views/Home";

const routes = [
  {
    path: "/",
    name: "home",
    component: HomeView,
  },
  {
    path: "/login",
    name: "login",
    component: () => import("@/views/Login"),
  },
  {
    path: "/signup",
    name: "signup",
    component: () => import("@/views/Signup"),
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
