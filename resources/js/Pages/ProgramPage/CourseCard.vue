<script setup>
import { onMounted, ref } from "vue";

defineProps({
  ProgramTitle: String,
});
const cardBgColor = ref("");
const svgBgColor = ref("");
const svgFillColor = ref("");

const getRandomColorCombination = () => {
  const randomIndex = Math.floor(Math.random() * colorCombination.length);
  return colorCombination[randomIndex];
};

onMounted(() => {
  const { cardBG, svgFill, svgBg } = getRandomColorCombination();
  cardBgColor.value = cardBG;
  svgFillColor.value = svgFill;
  svgBgColor.value = svgBg;
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
      <slot :fill="svgFillColor" name="svg"></slot>
    </div>
    <h2 class="text-sm font-bold">{{ ProgramTitle }}</h2>
  </div>
</template>
<style scoped></style>
