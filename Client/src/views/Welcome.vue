<script setup ">
import GuestLayout from "@/Layout/GuestLayout.vue";
import HomeLandingImage from "/public/image/HomeLandingImageEllipse.webp";
</script>

<template>
  <GuestLayout>
    <div class="flex md:grid md:h-[calc(100vh-90px)] md:grid-cols-5">
      <div
        class="col-span-3 mx-auto mt-32 flex max-w-screen-sm flex-col items-center gap-y-8 px-1 text-center min-[425px]:px-4 md:my-auto"
      >
        <h1
          class="font-Montserrat text-3xl font-extrabold uppercase md:text-5xl lg:text-6xl xl:text-7xl min-[1400px]:text-8xl"
        >
          Master Your Exams with
          <span class="text-bg-light-green">Practice</span> and
          <span class="text-bg-light-green"> Contribution</span>
        </h1>

        <p class="max-w-[425px] md:max-w-[525px]">
          Access a diverse question bank to sharpen your skills, or add your own
          questions to help others succeed
        </p>
  <RouterLink :to="{name:'home'}">

    <div
    class="flex w-40 cursor-pointer items-center justify-center rounded-xl bg-bg-dark-green py-4 text-white hover:bg-bg-dark-green/90"
    >
    Start Practicing
    
  </div>
  </RouterLink>
</div>
<div
class="col-span-2 hidden h-full items-center justify-center bg-bg-light-green p-2 md:flex"
>
<img :src="HomeLandingImage" alt="Home Landing Image" class="w-full" />
</div>
</div>
  </GuestLayout>
</template>
