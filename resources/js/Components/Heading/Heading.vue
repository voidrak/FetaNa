<script setup>
import { ref } from "vue";
import HamburgerNav from "./HamburgerNav.vue";
import Logo from "/public/FetaNaLogo.png";

const isSideOpen = ref(false);

const toggleSideBar = () => {
  isSideOpen.value = !isSideOpen.value;
};
</script>

<template>
  <div
    class="flex items-center justify-between border-y border-gray-400 px-2 py-5 md:justify-around md:py-5"
  >
    <div class="">
      <img :src="Logo" alt="FetaNa Logo" class="w-[100px]" />
    </div>
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
  </div>
</template>
