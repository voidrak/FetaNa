<script setup>
import ProgramCard from "@/Components/Home/ProgramCard.vue";
import AdminLayout from "@/Layout/AdminLayout.vue";
import { useProgramStore } from "@/stores/program";
import { onMounted, ref } from "vue";

const { getAllPrograms } = useProgramStore();
const programs = ref([]);

onMounted(async () => {
  programs.value = await getAllPrograms();
});
</script>

<template>
  <AdminLayout>
    <div class="py-8">
      <h1
        class="text-bg-light-green font-bold text-3xl sm:text-4xl md:text-5xl"
      >
        Available Programs
      </h1>

      <div
        v-if="programs.length > 0"
        class="mt-16 grid gap-x-4 gap-y-4 lg:grid-cols-2 xl:grid-cols-3"
      >
        <div v-for="program in programs" :key="program.id">
          <ProgramCard
            :ProgramTitle="program.name"
            :id="program.id"
            :isAdmin="true"
          />
        </div>
      </div>

      <div v-else>
        <p>No programs available.</p>
      </div>
    </div>
  </AdminLayout>
</template>
