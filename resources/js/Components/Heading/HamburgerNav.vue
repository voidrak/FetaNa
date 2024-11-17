<script setup>
defineProps({
  isSideOpen: Boolean,
});
</script>

<template>
  <div
    class="absolute right-0 top-0 z-50 flex h-screen w-full max-w-[450px] flex-col items-center justify-center gap-y-8 bg-black pt-8 duration-500 ease-linear md:hidden"
    :class="[`${isSideOpen ? `` : `w-[0px]`}`]"
  >
    <div
      @click="$emit('close')"
      class="absolute right-5 top-5 rounded-xl bg-bg-light-green p-2 duration-300 ease-linear"
      :class="[`${isSideOpen ? `opacity-1` : `opacity-0`}`]"
    >
      <svg
        class="size-6 fill-black"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 384 512"
      >
        <path
          d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
        />
      </svg>
    </div>

    <ul
      class="flex flex-col items-center gap-y-4 text-2xl text-white"
      :class="[`${isSideOpen ? `` : `hidden`}`]"
    >
      <li class="">About Us</li>
      <li class="">Contact Us</li>
      <li class="">Github</li>
    </ul>

    <div
      :class="[`${isSideOpen ? `` : `hidden`}`]"
      class="flex w-[150px] items-center justify-center gap-x-2 rounded-xl bg-bg-light-green p-2"
    >
      <h1 class="text-sm font-bold text-bg-dark-green">Register</h1>
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
  </div>
</template>
