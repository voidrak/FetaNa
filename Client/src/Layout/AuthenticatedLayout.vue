<script setup>
import { ref } from "vue";
const isSideOpen = ref(false);
import Logo from "/public/FetaNaLogo.png";
import SmallSideBar from "@/Components/Home/SmallSideBar.vue";
import LargeSideBar from "@/Components/Home/LargeSideBar.vue";
import ProfileModal from "@/Components/Ui/ProfileModal.vue";

const toggleSideBar = () => {
  isSideOpen.value = !isSideOpen.value;
};
</script>

<template>
  <div class="grid h-screen w-full grid-cols-10 overflow-y-hidden bg-bg-tan font-DMSans lg:flex">
    <LargeSideBar />

    <div class="inside col-span-10 w-full overflow-auto md:col-span-7">
      <!-- heading -->
      <div class="border-y border-gray-400">
        <div class="hidden items-center px-4 py-5 md:flex">
          <ul class="mx-auto flex gap-x-6 xl:ml-[35%]">
            <li class="cursor-pointer text-xl font-bold hover:font-extrabold hover:text-gray-600">
              About Us
            </li>
            <li class="cursor-pointer text-xl font-bold hover:font-extrabold hover:text-gray-600">
              Contact Us
            </li>
            <li class="cursor-pointer text-xl font-bold hover:font-extrabold hover:text-gray-600">
              Github
            </li>
          </ul>
          <ProfileModal class="mr-16" />
        </div>
        <div class="flex items-center justify-between p-3 md:hidden">
          <SmallSideBar :isSideOpen="isSideOpen" @close="toggleSideBar" />
          <div @click="toggleSideBar" class="md:hidden" :class="[`${isSideOpen ? `hidden` : ``}`]">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
              <path
                d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
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
