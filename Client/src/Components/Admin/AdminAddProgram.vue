<script setup>
import AdminLayout from "@/Layout/AdminLayout.vue";
import { useProgramStore } from "@/stores/program";
import { storeToRefs } from "pinia";
import { onMounted, reactive } from "vue";

const { createProgram } = useProgramStore();
const { errors } = storeToRefs(useProgramStore());
const formData = reactive({
  name: "",
});

onMounted(() => (errors.value = {}));
</script>

<template>
  <AdminLayout>
    <div class="mt-24 ml-1 md:mx-auto md:flex flex-col items-center">
      <h1 class="font-Montserrat text-xl md:text-3xl lg:text-4xl my-8">
        Create New <span class="text-bg-light-green font-bold">Program</span>
      </h1>
      <form @submit.prevent="createProgram(formData)">
        <div className=" mt-6 flex flex-wrap">
          <div className="w-full  px-3">
            <label
              className="mb-2 md:text-base block text-xs font-bold uppercase tracking-wide text-black"
              htmlFor="name"
            >
              Program Name
            </label>
            <input
              v-model="formData.name"
              className="mb-3  min-w-[280px] md:w-[500px] w-[80%] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
              id="name"
              name="name"
              type="text"
            />
            <p v-if="errors.name" class="text-sm text-red-500">
              {{ errors.name[0] }}
            </p>
          </div>
        </div>
        <button
          type="submit"
          className="ml-4  mt-4 rounded-lg bg-blue-700 px-8 py-2 text-center text-base font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300"
        >
          Create
        </button>
      </form>
    </div>
  </AdminLayout>
</template>
