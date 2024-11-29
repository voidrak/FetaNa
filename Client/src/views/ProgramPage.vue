<script setup>
import CourseCard from "@/Components/ProgramPage/CourseCard.vue";
import AuthenticatedLayout from "@/Layout/AuthenticatedLayout.vue";
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
  <AuthenticatedLayout>
    <div v-if="program" class="px-2 py-8">
      <div class="items-center gap-x-4 px-4 mlg:my-8 lg:flex xl:ml-12">
        <h1 class="text-3xl lg:text-4xl xl:text-5xl">Exit Exam for</h1>
        <h1
          class="text-nowrap text-3xl font-semibold text-bg-light-green lg:text-4xl xl:text-5xl"
        >
          {{ program.name }}
        </h1>
      </div>
      <div
        class="mt-6 flex items-center justify-center gap-x-4 lg:justify-normal lg:px-10 xl:ml-16"
      >
        <h1 class="text-xl">Select Course</h1>
        <h1 class="text-xl">Or</h1>

        <div
          class="flex cursor-pointer items-center gap-x-1 rounded-2xl bg-bg-light-green px-3 py-2"
        >
          <p class="text-sm">Mix Courses</p>
          <svg
            class="size-4"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
          >
            <path
              d="M403.8 34.4c12-5 25.7-2.2 34.9 6.9l64 64c6 6 9.4 14.1 9.4 22.6s-3.4 16.6-9.4 22.6l-64 64c-9.2 9.2-22.9 11.9-34.9 6.9s-19.8-16.6-19.8-29.6l0-32-32 0c-10.1 0-19.6 4.7-25.6 12.8L284 229.3 244 176l31.2-41.6C293.3 110.2 321.8 96 352 96l32 0 0-32c0-12.9 7.8-24.6 19.8-29.6zM164 282.7L204 336l-31.2 41.6C154.7 401.8 126.2 416 96 416l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c10.1 0 19.6-4.7 25.6-12.8L164 282.7zm274.6 188c-9.2 9.2-22.9 11.9-34.9 6.9s-19.8-16.6-19.8-29.6l0-32-32 0c-30.2 0-58.7-14.2-76.8-38.4L121.6 172.8c-6-8.1-15.5-12.8-25.6-12.8l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64 0c30.2 0 58.7 14.2 76.8 38.4L326.4 339.2c6 8.1 15.5 12.8 25.6 12.8l32 0 0-32c0-12.9 7.8-24.6 19.8-29.6s25.7-2.2 34.9 6.9l64 64c6 6 9.4 14.1 9.4 22.6s-3.4 16.6-9.4 22.6l-64 64z"
            />
          </svg>
        </div>
      </div>

      <div class="mt-12 grid gap-y-4 lg:grid-cols-2 2xl:grid-cols-3">
        <div v-for="course in program.courses" :key="course.id">
          <CourseCard :courseTitle="course.name" />
        </div>
      </div>
    </div>
    <div v-else class="">
      <p>No courses available.</p>
    </div>
  </AuthenticatedLayout>
</template>
