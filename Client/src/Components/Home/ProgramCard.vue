<script setup>
import ProgramIcon from "/public/image/ProgramIcon.png";
defineProps({
  ProgramTitle: String,
});
</script>

<template>
  <div
    class="mx-auto flex w-full max-w-[350px] cursor-pointer items-center gap-x-2 rounded-lg bg-white px-2 py-2 shadow-md shadow-black/30 lg:h-[70px] lg:hover:scale-105"
  >
    <div class="">
      <img :src="ProgramIcon" alt="ProgramIcon" class="w-[50px]" />
    </div>
    <div class="flex flex-col">
      <h1 class="">{{ ProgramTitle }}</h1>
      <p class="">2345+ Questions</p>
    </div>
    <svg
      class="ml-auto mr-4 size-5 fill-blue-accent"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 320 512"
    >
      <path
        d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"
      />
    </svg>
  </div>
</template>
