<script setup>
import { ref, computed, watch } from "vue";
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from "@headlessui/vue";
import AdminLayout from "@/Layout/AdminLayout.vue";
import { useCourseStore } from "@/stores/course";
import { storeToRefs } from "pinia";
import { onMounted, reactive } from "vue";
import { useProgramStore } from "@/stores/program";

const { getAllPrograms } = useProgramStore();
const { createCourse } = useCourseStore();
const { errors } = storeToRefs(useCourseStore());

const programs = ref([]);

onMounted(async () => {
  programs.value = await getAllPrograms();
});

const formData = reactive({
  name: "",
  program_id: "",
});

let selected = ref(programs.value[0]);
let query = ref("");

let filteredProgram = computed(() =>
  query.value === ""
    ? programs.value
    : programs.value.filter((program) =>
        program.name
          .toLowerCase()
          .replace(/\s+/g, "")
          .includes(query.value.toLowerCase().replace(/\s+/g, ""))
      )
);

watch(selected, (newSelected) => {
  formData.program_id = newSelected.id;
});

onMounted(() => (errors.value = {}));
</script>

<template>
  <AdminLayout>
    <div class="mt-24 ml-1 md:mx-auto md:flex flex-col items-center">
      <h1 class="font-Montserrat text-xl md:text-3xl lg:text-4xl my-8">
        Create New <span class="text-bg-light-green font-bold">Course</span>
      </h1>
      <form @submit.prevent="createCourse(formData)">
        <div className=" mt-6 w-full  px-3 ">
          <div className=" ">
            <label
              className="mb-2 md:text-base block text-xs font-bold uppercase tracking-wide text-black"
              htmlFor="name"
            >
              Course Name
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
          <div class="">
            <label
              className="mb-2 md:text-base block text-xs font-bold uppercase tracking-wide text-black"
              htmlFor="name"
            >
              Select The Program
            </label>
            <Combobox v-model="selected">
              <div
                class="relative mt-1 min-w-[280px] md:w-[500px] w-[80%] border-gray-200 focus:bg-white bg-gray-200"
              >
                <div class="">
                  <ComboboxInput
                    class="mb-3 block appearance-none w-full rounded border border-gray-200 bg-gray-200 py-3 leading-tight text-gray-700 ml-2 focus:border-gray-500 focus:bg-white focus:outline-none"
                    :displayValue="(person) => person.name"
                    @change="query = $event.target.value"
                  />
                  <ComboboxButton
                    class="absolute inset-y-0 right-0 flex items-center pr-2"
                  >
                    <svg
                      class="h-5 w-5 fill-gray-400"
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512"
                    >
                      <path
                        d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"
                      />
                    </svg>
                  </ComboboxButton>
                </div>
                <TransitionRoot
                  leave="transition ease-in duration-100"
                  leaveFrom="opacity-100"
                  leaveTo="opacity-0"
                  @after-leave="query = ''"
                >
                  <ComboboxOptions
                    class="absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm"
                  >
                    <div
                      v-if="filteredProgram.length === 0 && query !== ''"
                      class="relative cursor-default select-none px-4 py-2 text-gray-700"
                    >
                      Nothing found.
                    </div>

                    <ComboboxOption
                      v-for="person in filteredProgram"
                      as="template"
                      :key="person.id"
                      :value="person"
                      v-slot="{ selected, active }"
                    >
                      <li
                        class="relative cursor-default select-none py-2 pl-10 pr-4"
                        :class="{
                          'bg-teal-600 text-white': active,
                          'text-gray-900': !active,
                        }"
                      >
                        <span
                          class="block truncate"
                          :class="{
                            'font-medium': selected,
                            'font-normal': !selected,
                          }"
                        >
                          {{ person.name }}
                        </span>
                        <span
                          v-if="selected"
                          class="absolute inset-y-0 left-0 flex items-center pl-3"
                          :class="{
                            'text-white': active,
                            'text-teal-600': !active,
                          }"
                        >
                          <!-- <CheckIcon class="h-5 w-5" aria-hidden="true" /> -->
                        </span>
                      </li>
                    </ComboboxOption>
                  </ComboboxOptions>
                </TransitionRoot>
              </div>
            </Combobox>
            <p v-if="errors.program_id" class="text-sm text-red-500">
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
