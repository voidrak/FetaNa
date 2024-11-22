<script setup>
import { ref } from "vue";
const isSideOpen = ref(false);
import Logo from "/public/FetaNaLogo.png";
import SmallSideBar from "@/Components/Home/SmallSideBar.vue";
import LargeSideBar from "@/Components/Home/LargeSideBar.vue";

const toggleSideBar = () => {
  isSideOpen.value = !isSideOpen.value;
};
</script>

<template>
  <div
    class="grid h-screen w-full grid-cols-10 overflow-y-hidden bg-bg-tan font-DMSans lg:flex"
  >
    <LargeSideBar />

    <div class="inside col-span-10 w-full overflow-auto md:col-span-7">
      <!-- heading -->
      <div class="border-y border-gray-400">
        <div class="hidden items-center px-4 py-5 md:flex">
          <ul class="mx-auto flex gap-x-6 xl:ml-[35%]">
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
            class="ml-auto cursor-pointer rounded-full bg-bg-light-green p-3"
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
        <div class="flex items-center justify-between p-3 md:hidden">
          <SmallSideBar :isSideOpen="isSideOpen" @close="toggleSideBar" />
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
          <div class="">
            <img :src="Logo" alt="FetaNa Logo" class="w-[100px]" />
          </div>
        </div>
      </div>
      <slot> </slot>
    </div>
  </div>
</template>
