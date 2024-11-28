<script setup>
import { onMounted, ref } from "vue";

const props = defineProps({
  courseTitle: String,
});

const cardBgColor = ref("");
const svgBgColor = ref("");
const svgFillColor = ref("");
const selectedSvg = ref("");

const svgs = [
  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-6"><path d="M256 0c4.6 0 9.2 1 13.4 2.9L457.7 82.8c22 9.3 38.4 31 38.3 57.2c-.5 99.2-41.3 280.7-213.6 363.2c-16.7 8-36.1 8-52.8 0C57.3 420.7 16.5 239.2 16 140c-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.8 1 251.4 0 256 0zm0 66.8l0 378.1C394 378 431.1 230.1 432 141.4L256 66.8s0 0 0 0z"/></svg>`,
  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-6"><path d="M352 256c0 22.2-1.2 43.6-3.3 64l-185.3 0c-2.2-20.4-3.3-41.8-3.3-64s1.2-43.6 3.3-64l185.3 0c2.2 20.4 3.3 41.8 3.3 64zm28.8-64l123.1 0c5.3 20.5 8.1 41.9 8.1 64s-2.8 43.5-8.1 64l-123.1 0c2.1-20.6 3.2-42 3.2-64s-1.1-43.4-3.2-64zm112.6-32l-116.7 0c-10-63.9-29.8-117.4-55.3-151.6c78.3 20.7 142 77.5 171.9 151.6zm-149.1 0l-176.6 0c6.1-36.4 15.5-68.6 27-94.7c10.5-23.6 22.2-40.7 33.5-51.5C239.4 3.2 248.7 0 256 0s16.6 3.2 27.8 13.8c11.3 10.8 23 27.9 33.5 51.5c11.6 26 20.9 58.2 27 94.7zm-209 0L18.6 160C48.6 85.9 112.2 29.1 190.6 8.4C165.1 42.6 145.3 96.1 135.3 160zM8.1 192l123.1 0c-2.1 20.6-3.2 42-3.2 64s1.1 43.4 3.2 64L8.1 320C2.8 299.5 0 278.1 0 256s2.8-43.5 8.1-64zM194.7 446.6c-11.6-26-20.9-58.2-27-94.6l176.6 0c-6.1 36.4-15.5 68.6-27 94.6c-10.5 23.6-22.2 40.7-33.5 51.5C272.6 508.8 263.3 512 256 512s-16.6-3.2-27.8-13.8c-11.3-10.8-23-27.9-33.5-51.5zM135.3 352c10 63.9 29.8 117.4 55.3 151.6C112.2 482.9 48.6 426.1 18.6 352l116.7 0zm358.1 0c-30 74.1-93.6 130.9-171.9 151.6c25.5-34.2 45.2-87.7 55.3-151.6l116.7 0z"/></svg>`,
  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-6"><path d="M448 80l0 48c0 44.2-100.3 80-224 80S0 172.2 0 128L0 80C0 35.8 100.3 0 224 0S448 35.8 448 80zM393.2 214.7c20.8-7.4 39.9-16.9 54.8-28.6L448 288c0 44.2-100.3 80-224 80S0 332.2 0 288L0 186.1c14.9 11.8 34 21.2 54.8 28.6C99.7 230.7 159.5 240 224 240s124.3-9.3 169.2-25.3zM0 346.1c14.9 11.8 34 21.2 54.8 28.6C99.7 390.7 159.5 400 224 400s124.3-9.3 169.2-25.3c20.8-7.4 39.9-16.9 54.8-28.6l0 85.9c0 44.2-100.3 80-224 80S0 476.2 0 432l0-85.9z"/></svg>`,
  `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-6"><path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z"/></svg>`,
];

const getRandomColorCombination = () => {
  const randomIndex = Math.floor(Math.random() * colorCombination.length);
  return colorCombination[randomIndex];
};

const getRandomSvg = () => {
  const randomIndex = Math.floor(Math.random() * svgs.length);
  return svgs[randomIndex];
};

onMounted(() => {
  const { cardBG, svgFill, svgBg } = getRandomColorCombination();
  cardBgColor.value = cardBG;
  svgFillColor.value = svgFill;
  svgBgColor.value = svgBg;
  selectedSvg.value = getRandomSvg();
});

const colorCombination = [
  { cardBG: "#fef2f4", svgFill: "#fe9bac", svgBg: "#fec7d1" },
  { cardBG: "#eefbf5", svgFill: "#0dc06d", svgBg: "#d1f5e4" },
  { cardBG: "#f3f4fe", svgFill: "#dd6daa", svgBg: "#ffdaf0" },
  { cardBG: "#f7f3ff", svgFill: "#af91e9", svgBg: "#dfd4f4" },
  { cardBG: "#eaf6ff", svgFill: "#61a1f0", svgBg: "#d5e9fd" },
  { cardBG: "#fffaef", svgFill: "#e19b00", svgBg: "#fff3d9" },
  { cardBG: "#fff5f7", svgFill: "#ff6f61", svgBg: "#ffd1d1" },
  { cardBG: "#f0fff4", svgFill: "#00c853", svgBg: "#c8e6c9" },
];
</script>

<template>
  <div
    :style="{ backgroundColor: cardBgColor }"
    class="mx-auto flex w-[80%] cursor-pointer items-center gap-x-2 rounded-sm px-2 py-6 shadow-lg lg:hover:scale-105"
  >
    <div
      :style="{ backgroundColor: svgBgColor, borderColor: svgFillColor }"
      class="rounded-full border border-dashed p-2"
    >
      <div v-html="selectedSvg" :style="{ fill: svgFillColor }"></div>
    </div>
    <h2 class="text-sm font-bold">{{ courseTitle }}</h2>
  </div>
</template>
