<script setup>
import CourseCard from "@/Components/ProgramPage/CourseCard.vue";
import AdminLayout from "@/Layout/AdminLayout.vue";
import { useProgramStore } from "@/stores/program";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";

const { getProgram } = useProgramStore();
const program = ref(null);

const route = useRoute();

onMounted(async () => {
  program.value = await getProgram(route.params.id);
  console.log(program.value.name);
});
</script>

<template>
  <AdminLayout>
    <div class="mt-6">
      <div v-if="program" class="">
        <h1
          class="text-nowrap text-center text-3xl font-semibold text-bg-light-green lg:text-4xl xl:text-5xl"
        >
          {{ program.name }}
        </h1>
        <div class="mt-12 grid gap-y-4 lg:grid-cols-2 2xl:grid-cols-3">
          <div v-for="course in program.courses" :key="course.id">
            <CourseCard :courseTitle="course.name" />
          </div>
        </div>
      </div>
      <div v-else class="">
        <p>No courses available.</p>
      </div>
    </div>
  </AdminLayout>
</template>
