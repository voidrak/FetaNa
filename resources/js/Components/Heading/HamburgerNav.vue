<script setup></script>

<template>
  <div
    class="w-full pt-8 max-w-[450px] bg-black h-screen absolute top-0 right-0"
  >
    <div @click="$emit('close')" class="absolute top-0 right-0">
      <svg
        class="size-5 fill-red-500"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 384 512"
      >
        <path
          d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
        />
      </svg>
    </div>

    <ul class="flex flex-col gap-y-4 text-white items-center pt">
      <li class="">About Us</li>
      <li class="">Contact Us</li>
      <li class="">Github</li>
    </ul>
  </div>
</template>
