<script setup>
import ProgramCard from "@/Components/Home/ProgramCard.vue";
import AuthenticatedLayout from "@/Layout/AuthenticatedLayout.vue";
import graduationCap from "/public/image/graduationCap.png";
import homePattern from "/public/image/home-bottom-pattern.png";
import { useAuthStore } from "@/stores/auth";
import { onMounted, ref } from "vue";
import { useProgramStore } from "@/stores/program";

const authStore = useAuthStore();
const { getAllPrograms } = useProgramStore();
const programs = ref([]);

onMounted(async () => {
  programs.value = await getAllPrograms();
});
</script>

<template>
  <AuthenticatedLayout>
    <div class="px-4 py-8">
      <div class="relative mx-auto flex justify-center gap-x-4 text-center">
        <div class="text-nowrap">
          <h1 class="mb-4 text-3xl sm:text-5xl md:text-6xl">
            Welcome ,
            <span v-if="authStore.user" class="font-bold text-bg-light-green">{{
              authStore.user.name
            }}</span>
          </h1>
          <h2 class="text-xl sm:text-2xl md:text-3xl">Choose Your Program</h2>
        </div>
        <img :src="graduationCap" alt="graduationCap" class="translate-y-2" />
      </div>

      <div
        v-if="programs.length > 0"
        class="mt-16 grid gap-x-4 gap-y-4 lg:grid-cols-2 xl:grid-cols-3"
      >
        <div v-for="program in programs" :key="program.id">
          <ProgramCard :ProgramTitle="program.name" :id="program.id" />
        </div>
      </div>
      <div v-else>
        <p>No programs available.</p>
      </div>
      <h1 class="mt-12 text-center text-bg-dark-green sm:text-lg md:text-xl">
        More Programs
        <span class="font-bold text-bg-light-green">Coming Soon</span>
      </h1>

      <img :src="homePattern" alt="" class="absolute bottom-0 right-0 z-0" />
    </div>
  </AuthenticatedLayout>
</template>
