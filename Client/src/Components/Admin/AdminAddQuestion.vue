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
import { useQuestionStore } from "@/stores/question";
import { useChoiceStore } from "@/stores/choice";

const { getAllPrograms } = useProgramStore();
const { getAllCourses } = useCourseStore();
const { createQuestion } = useQuestionStore();
const { createChoice } = useChoiceStore();
const { errors } = storeToRefs(useQuestionStore());
const { ChoiceErrors } = storeToRefs(useChoiceStore());


const programs = ref([]);
const courses = ref([]);
const generalError = ref("")
const questionResponse = ref(null)

onMounted(async () => {
  programs.value = await getAllPrograms();
});

const formData = reactive({
  question_text: "",
  course_id: "",
});
const choicesFormData = reactive({
  choice_text_1: "",
  choice_text_2: "",
  choice_text_3: "",
  choice_text_4: "",
});

let selected = ref(programs.value[0]);
let selectedCourse = ref(courses.value[0]);
let query = ref("");
let CoursesQuery = ref("");
let correctChoice = ref(0)


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
let filteredCourse = computed(() =>
  CoursesQuery.value === ""
    ? courses.value
    : courses.value.filter((course) =>
      course.name
        .toLowerCase()
        .replace(/\s+/g, "")
        .includes(CoursesQuery.value.toLowerCase().replace(/\s+/g, ""))
    )
);

watch(selected, async (newSelected) => {
  courses.value = await getAllCourses(newSelected.id);

});
watch(selectedCourse, async (newSelected) => {
  formData.course_id = newSelected.id;
  courses.value = await getAllCourses(newSelected.id);

});

onMounted(() => (errors.value = {}));

const handleCreateQuestion = async () => {
  if (correctChoice.value !== 0) {

    questionResponse.value = await createQuestion(formData);

    if (questionResponse.value.id) {

      createChoice({ choice_text: choicesFormData.choice_text_1, question_id: questionResponse.value?.id, is_correct: correctChoice.value === 1 })
      createChoice({ choice_text: choicesFormData.choice_text_2, question_id: questionResponse.value?.id, is_correct: correctChoice.value === 2 })
      createChoice({ choice_text: choicesFormData.choice_text_3, question_id: questionResponse.value?.id, is_correct: correctChoice.value === 3 })
      createChoice({ choice_text: choicesFormData.choice_text_4, question_id: questionResponse.value?.id, is_correct: correctChoice.value === 4 })
    }
  } else {
    generalError.value = "At least one correct choice is required per question."
  }
  // console.log(questionResponse.value);
  // console.log(choicesFormData)


}

</script>

<template>
  <AdminLayout>
    <div class="mt-8 ml-1 md:mx-auto md:flex flex-col items-center">
      <h1 class="font-Montserrat text-xl md:text-3xl lg:text-4xl my-8">
        Create New <span class="text-bg-light-green font-bold">Question</span>
      </h1>
      <p v-if="generalError" class="text-lg font-bold text-red-500">
        {{ generalError }}
      </p>
      <form @submit.prevent="handleCreateQuestion" class=" pb-8">
        <div className=" mt-6 w-full    ">
          <div className=" ">
            <label className="mb-2 md:text-base block text-xs font-bold uppercase tracking-wide text-black"
              htmlFor="question_text">
              Question Text
            </label>
            <textarea v-model="formData.question_text"
              className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
              id="question_text" name="question_text" type="text" />
            <p v-if="errors.question_text" class="text-sm text-red-500">
              {{ errors.question_text[0] }}
            </p>
          </div>
        </div>
        <div class="">
          <label className="mb-2 md:text-base block text-xs font-bold uppercase tracking-wide text-black"
            htmlFor="name">
            Select The Program
          </label>
          <Combobox v-model="selected">
            <div class="relative mt-1 min-w-[280px] md:w-[500px] xl:w-[600px] w-[80%] border-gray-200 bg-gray-200">
              <div class="">
                <ComboboxInput
                  class="mb-3 block appearance-none w-full pl-3 rounded border border-gray-200 bg-gray-200 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                  :displayValue="(person) => person.name" @change="query = $event.target.value" aria-required="true" />
                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                  <svg class="h-5 w-5 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                      d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                  </svg>
                </ComboboxButton>
              </div>
              <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
                @after-leave="query = ''">
                <ComboboxOptions
                  class="absolute mt-1 z-50  max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">
                  <div v-if="filteredProgram.length === 0 && query !== ''"
                    class="relative cursor-default select-none px-4 py-2 text-gray-700">
                    Nothing found.
                  </div>

                  <ComboboxOption v-for="person in filteredProgram" as="template" :key="person.id" :value="person"
                    v-slot="{ selected, active }">
                    <li class="relative z-50 cursor-default select-none py-2 pl-10 pr-4" :class="{
                      'bg-teal-600 text-white': active,
                      'text-gray-900': !active,
                    }">
                      <span class="block truncate" :class="{
                        'font-medium': selected,
                        'font-normal': !selected,
                      }">
                        {{ person.name }}
                      </span>
                      <span v-if="selected" class="absolute inset-y-0 left-0 flex items-center pl-3" :class="{
                        'text-white': active,
                        'text-teal-600': !active,
                      }">
                        <!-- <CheckIcon class="h-5 w-5" aria-hidden="true" /> -->
                      </span>
                    </li>
                  </ComboboxOption>
                </ComboboxOptions>
              </TransitionRoot>
            </div>
          </Combobox>
          <p v-if="errors.program_id" class="text-sm text-red-500">
            {{ errors.program_id[0] }}
          </p>
        </div>
        <div class="mt-10">
          <label className="mb-2 md:text-base block text-xs font-bold uppercase tracking-wide text-black"
            htmlFor="name">
            Select The Courses
          </label>
          <Combobox v-model="selectedCourse">
            <div class="relative  mt-1 min-w-[280px] md:w-[500px] xl:w-[600px] w-[80%] border-gray-200 bg-gray-200">
              <div class="">
                <ComboboxInput
                  class="mb-3 block appearance-none w-full pl-3 rounded border border-gray-200 bg-gray-200 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                  :displayValue="(course) => course.name" @change="CoursesQuery = $event.target.value"
                  aria-required="true" />
                <ComboboxButton class="absolute inset-y-0 right-0 flex items-center pr-2">
                  <svg class="h-5 w-5 fill-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                      d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z" />
                  </svg>
                </ComboboxButton>
              </div>
              <TransitionRoot leave="transition ease-in duration-100" leaveFrom="opacity-100" leaveTo="opacity-0"
                @after-leave="CoursesQuery = ''">
                <ComboboxOptions v-if="selected"
                  class="absolute debug  z-50 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">
                  <div v-if="filteredCourse.length === 0 && CoursesQuery !== ''"
                    class="relative cursor-default select-none px-4 py-2 text-gray-700">
                    Nothing found.
                  </div>

                  <ComboboxOption v-for="course in filteredCourse" as="template" :key="course.id" :value="course"
                    v-slot="{ selectedCourse, active }">
                    <li class="relative cursor-default select-none py-2 pl-10 pr-4" :class="{
                      'bg-teal-600 text-white': active,
                      'text-gray-900': !active,
                    }">
                      <span class="block truncate" :class="{
                        'font-medium': selectedCourse,
                        'font-normal': !selectedCourse,
                      }">
                        {{ course.name }}
                      </span>
                      <span v-if="selectedCourse" class="absolute inset-y-0 left-0 flex items-center pl-3" :class="{
                        'text-white': active,
                        'text-teal-600': !active,
                      }">
                        <!-- <CheckIcon class="h-5 w-5" aria-hidden="true" /> -->
                      </span>
                    </li>
                  </ComboboxOption>
                </ComboboxOptions>
                <ComboboxOptions v-else
                  class="absolute    z-50 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-none sm:text-sm">
                  <div class="relative cursor-default select-none px-4 py-2 text-gray-700">
                    Select The Program First
                  </div>


                </ComboboxOptions>
              </TransitionRoot>
            </div>
          </Combobox>
          <p v-if="errors.course_id" class="text-sm text-red-500">
            {{ errors.course_id[0] }}
          </p>
          <div className=" mt-8">
            <label className="mb-2 w-[120px] md:text-base block text-xs font-bold uppercase tracking-wide text-black"
              htmlFor="choice_text">
              Choice One
            </label>
            <div class="flex gap-x-6 items-center">
              <input v-model="choicesFormData.choice_text_1"
                className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="choice_text_1" name="choice_text" type="text" />
              <div @click="correctChoice = 1"
                class="py-2 px-3 border border-gray-500 rounded-md cursor-pointer hover:bg-bg-light-green" :class="{
                  'bg-bg-light-green': correctChoice === 1,
                }">Correct
              </div>
            </div>
            <p v-if="ChoiceErrors.is_correct" class="text-sm text-red-500">
              {{ ChoiceErrors.is_correct }}
            </p>
          </div>
          <div className=" ">
            <label className="mb-2 w-[120px] md:text-base block text-xs font-bold uppercase tracking-wide text-black"
              htmlFor="choice_text">
              Choice Two
            </label>
            <div class="flex gap-x-6 items-center">
              <input v-model="choicesFormData.choice_text_2"
                className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="choice_text_2" name="choice_text" type="text" />
              <div @click="correctChoice = 2"
                class="py-2 px-3 border border-gray-500 rounded-md cursor-pointer hover:bg-bg-light-green" :class="{
                  'bg-bg-light-green': correctChoice === 2,
                }">Correct
              </div>
            </div>
            <p v-if="ChoiceErrors.is_correct" class="text-sm text-red-500">
              {{ ChoiceErrors.is_correct }}
            </p>
          </div>
          <div className=" ">
            <label className="mb-2 w-[120px] md:text-base block text-xs font-bold uppercase tracking-wide text-black"
              htmlFor="choice_text">
              Choice Three
            </label>
            <div class="flex gap-x-6 items-center">
              <input v-model="choicesFormData.choice_text_3"
                className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="choice_text_3" name="choice_text" type="text" />
              <div @click="correctChoice = 3"
                class="py-2 px-3 border border-gray-500 rounded-md cursor-pointer hover:bg-bg-light-green" :class="{
                  'bg-bg-light-green': correctChoice === 3,
                }">Correct
              </div>
            </div>
            <p v-if="ChoiceErrors.is_correct" class="text-sm text-red-500">
              {{ ChoiceErrors.is_correct }}
            </p>
          </div>
          <div className=" ">
            <label className="mb-2 w-[120px] md:text-base block text-xs font-bold uppercase tracking-wide text-black"
              htmlFor="choice_text">
              Choice Four
            </label>
            <div class="flex gap-x-6 items-center">
              <input v-model="choicesFormData.choice_text_4"
                className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="choice_text_4" name="choice_text" type="text" />
              <div @click="correctChoice = 4"
                class="py-2 px-3 border border-gray-500 rounded-md cursor-pointer hover:bg-bg-light-green" :class="{
                  'bg-bg-light-green': correctChoice === 4,
                }">Correct
              </div>
            </div>
            <p v-if="ChoiceErrors.is_correct" class="text-sm text-red-500">
              {{ ChoiceErrors.is_correct }}
            </p>
          </div>

        </div>

        <button type="submit"
          className="ml-4  mt-4 rounded-lg bg-blue-700 px-8 py-2 text-center text-base font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
          Create
        </button>
      </form>
    </div>
  </AdminLayout>
</template>
