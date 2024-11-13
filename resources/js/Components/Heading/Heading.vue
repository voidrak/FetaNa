<script setup>
import { ref } from "vue";
import HamburgerNav from "./HamburgerNav.vue";
import Logo from "/public/FetaNaLogo.png";

const isSideOpen = ref(false);

const toggleSideBar = () => {
  isSideOpen.value = !isSideOpen.value;
  console.log(isSideOpen.value);
};
</script>

<template>
  <div class="flex justify-between py-2 bg-yellow-200 items-center px-2">
    <div class="">
      <img :src="Logo" alt="FetaNa Logo" class="w-[100px]" />
    </div>
    <ul class="hidden">
      <li class="">About Us</li>
      <li class="">Contact Us</li>
      <li class="">Github</li>
    </ul>
    <div
      class="flex items-center justify-center p-2 bg-bg-light-green gap-x-2 rounded-xl"
    >
      <h1 class="font-bold text-sm text-bg-dark-green">Register</h1>
      <svg
        class="size-3"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 448 512"
      >
        <path
          d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"
        />
      </svg>
    </div>
    <div @click="toggleSideBar" class="">
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
    <HamburgerNav v-if="isSideOpen" @close="toggleSideBar" />
  </div>
</template>
