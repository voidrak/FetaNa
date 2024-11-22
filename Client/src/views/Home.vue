<script setup>
import ProgramCard from "@/Components/Home/ProgramCard.vue";
import AuthenticatedLayout from "@/Layout/AuthenticatedLayout.vue";
import graduationCap from "/public/image/graduationCap.png";
import homePattern from "/public/image/home-bottom-pattern.png";
</script>

<template>
  <AuthenticatedLayout>
    <div class="px-4 py-8">
      <div class="relative mx-auto flex justify-center gap-x-4 text-center">
        <div class="text-nowrap">
          <h1 class="mb-4 text-3xl sm:text-5xl md:text-6xl">
            Welcome ,
            <span class="font-bold text-bg-light-green">Rak</span>
          </h1>
          <h2 class="text-xl sm:text-2xl md:text-3xl">Choose Your Program</h2>
        </div>
        <img :src="graduationCap" alt="graduationCap" class="translate-y-2" />
      </div>

      <div class="mt-16 grid gap-x-4 gap-y-4 lg:grid-cols-2 xl:grid-cols-3">
        <ProgramCard ProgramTitle="Software Engineering" />
        <ProgramCard ProgramTitle="Chemical Engineering" />
        <ProgramCard ProgramTitle="Computer Science" />
        <ProgramCard ProgramTitle="Mechanical Engineering" />
        <ProgramCard ProgramTitle="Information Technology" />
        <ProgramCard ProgramTitle="Accounting" />
        <ProgramCard ProgramTitle="Medical Doctor" />
        <ProgramCard ProgramTitle="Pharmacy" />
        <ProgramCard ProgramTitle="Hotel Management" />
        <ProgramCard ProgramTitle="Agriculture" />
      </div>
      <h1 class="mt-12 text-center text-bg-dark-green sm:text-lg md:text-xl">
        More Programs
        <span class="font-bold text-bg-light-green">Coming Soon</span>
      </h1>

      <img :src="homePattern" alt="" class="absolute bottom-0 right-0" />
    </div>
  </AuthenticatedLayout>
</template>
