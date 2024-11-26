<script setup>
import { ref } from "vue";
import HamburgerNav from "./HamburgerNav.vue";
import Logo from "/public/FetaNaLogo.png";
import { useAuthStore } from "@/stores/auth";

const isSideOpen = ref(false);

const toggleSideBar = () => {
  isSideOpen.value = !isSideOpen.value;
};

const authStore = useAuthStore();
</script>

<template>
  <div
    class="flex items-center justify-between border-y border-gray-400 px-2 py-5 md:justify-around md:py-5"
  >
    <RouterLink :to="{ name: 'welcome' }">
      <div class="">
        <img :src="Logo" alt="FetaNa Logo" class="w-[100px]" />
      </div>
    </RouterLink>
    <ul class="hidden gap-x-6 md:flex">
      <li
        class="cursor-pointer text-xl font-bold hover:font-extrabold hover:text-gray-600"
      >
        About Us
      </li>
      <li
        class="cursor-pointer text-xl font-bold hover:font-extrabold hover:text-gray-600"
      >
        Contact Us
      </li>
      <li
        class="cursor-pointer text-xl font-bold hover:font-extrabold hover:text-gray-600"
      >
        Github
      </li>
    </ul>
    <div
      @click="toggleSideBar"
      class="md:hidden"
      :class="[`${isSideOpen ? `hidden` : ``}`]"
    >
      <svg
        class="size-5"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512"
      >
        <path
          d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"
        />
      </svg>
    </div>
    <HamburgerNav :isSideOpen="isSideOpen" @close="toggleSideBar" />
    <RouterLink v-if="!authStore.user" :to="{ name: 'Register' }">
      <div
        class="group hidden w-[150px] cursor-pointer items-center justify-center gap-x-3 rounded-xl bg-bg-light-green px-2 py-3 md:flex"
      >
        <h1 class="font-bold text-bg-dark-green">Register</h1>
        <svg
          class="size-0 duration-300 group-hover:size-5"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 448 512"
        >
          <path
            d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
          />
        </svg>
      </div>
    </RouterLink>
    <div
      v-else
      class="cursor-pointer hidden md:block rounded-full bg-bg-light-green p-3"
    >
      <svg
        class="size-5"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512"
      >
        <path
          d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z"
        />
      </svg>
    </div>
  </div>
</template>
