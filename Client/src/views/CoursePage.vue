<script setup>
import AuthenticatedLayout from "@/Layout/AuthenticatedLayout.vue";
import { useCourseStore } from "@/stores/course";
import { ref, onMounted, reactive, watch } from "vue";
import { useRoute } from "vue-router";

const route = useRoute();

const { getCourse } = useCourseStore();

const course = ref(null);
const questionIndex = ref(0);
const isSideOpen = ref(false);
const selected = ref(null)
const styleOption = ref("")
const questionSolved = ref(false)
const currentSolvedQuestion = ref(null)
const solved = reactive([])


onMounted(async () => {
  course.value = await getCourse(route.params.id);
});

const nextQuestion = () => {
  if (questionIndex.value < course.value.questions.length - 1) {
    questionIndex.value += 1;
  }

};

const prevQuestion = () => {
  if (questionIndex.value > 0) {
    questionIndex.value -= 1;
  }
};
const sideBarClick = (index) => {
  questionIndex.value = index;
  isSideOpen.value = false
}
const truncateText = (text) => {
  const words = text.split(' ');
  if (words.length > 10) {
    return words.slice(0, 10).join(' ') + '...'
  }
  return text
}


const isQuestionSolved = (question_id) => {
  return solved.some(solvedItem => solvedItem.question_id === question_id)
}

const handleCheck = (choice) => {
  selected.value = choice.id;
  questionSolved.value = true
  if (choice.is_correct) {
    styleOption.value = "select"
  } else if (!choice.is_correct) {
    styleOption.value = "wrong"
  }

  solved.push({ question_id: course.value.questions[questionIndex.value].id, choice_id: choice.id });




};

watch([course, questionIndex], ([newCourse, newQuestionIndex]) => {
  if (newCourse && newCourse.questions && newCourse.questions[newQuestionIndex]) {
    questionSolved.value = isQuestionSolved(newCourse.questions[newQuestionIndex].id);
    currentSolvedQuestion.value = solved.find((question) => question.question_id === newCourse.questions[newQuestionIndex].id);
    console.log(currentSolvedQuestion.value);
  }
});

</script>

<template>
  <AuthenticatedLayout>
    <div class="xl:px-8 relative">
      <div :class="isSideOpen ? `` : 'hidden  '"
        class="bg-white duration-500 z-50 h-screen md:h-[calc(100vh-100px)] absolute  top-0 right-0 w-full py-4 max-w-[450px]">
        <div @click="isSideOpen = false"
          class=" cursor-pointer ml-auto mr-10 w-[50px] flex justify-center items-center rounded-xl bg-bg-light-green p-2 duration-300 ease-linear"
          :class="[`${isSideOpen ? `opacity-1` : `opacity-0`}`]">
          <svg class="size-6 fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
            <path
              d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
          </svg>
        </div>
        <div v-if="course" class=" divide-y divide-bg-light-green mt-8 space-y-4 px-3">
          <div v-for="(question, index) in course.questions " @click="sideBarClick(index)"
            class=" cursor-pointer group flex gap-x-1 items-center   hover:bg-bg-light-green  overflow-hidden">
            <p class="px-1 md:px-3  text-pretty  ">
              <span class="">{{ index + 1 }} . </span>
              {{ truncateText(question.question_text) }}?
            </p>
            <svg class="w-0 duration-300 mr-5  group-hover:min-w-5" xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 448 512">
              <path
                d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
            </svg>

          </div>
        </div>

      </div>
      <div v-if="course" class="mx-auto relative max-w-[1200px] px-2 py-4 mlg:px-4 sm:py-10  ">

        <div class="flex gap-x-2 lg:justify-between ">

          <h1 class="pb-4 text-xl font-bold mlg:text-2xl md:text-3xl">
            <span class="text-bg-light-green">{{ course.name }}</span>
            Questions
          </h1>
          <svg @click="isSideOpen = true"
            class=" mt-2 min-w-5  cursor-pointer max-w-5  min-h-5 max-h-5   fill-black lg:min-h-7 lg:max-h-7  lg:min-w-7  lg:max-w-7"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path
              d="M40 48C26.7 48 16 58.7 16 72l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24L40 48zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L192 64zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l288 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-288 0zM16 232l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24l0 48c0 13.3 10.7 24 24 24l48 0c13.3 0 24-10.7 24-24l0-48c0-13.3-10.7-24-24-24l-48 0z" />
          </svg>
        </div>

        <div class="flex flex-col bg-white py-2 md:mt-8 xl:px-4">
          <div class="ml-auto flex gap-x-3 p-3 md:my-2">
            <div class="flex cursor-pointer items-center gap-x-2 rounded-lg bg-bg-tan px-3 py-1">
              <h1 class="text-sm">Note</h1>
              <svg class="size-4 fill-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                  d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l224 0 0-112c0-26.5 21.5-48 48-48l112 0 0-224c0-35.3-28.7-64-64-64L64 32zM448 352l-45.3 0L336 352c-8.8 0-16 7.2-16 16l0 66.7 0 45.3 32-32 64-64 32-32z" />
              </svg>
            </div>
            <div class="flex cursor-pointer items-center gap-x-2 rounded-lg bg-bg-tan px-3 py-1">
              <h1 class="text-sm">Report</h1>
              <svg class="size-4 fill-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path
                  d="M256 0c53 0 96 43 96 96l0 3.6c0 15.7-12.7 28.4-28.4 28.4l-135.1 0c-15.7 0-28.4-12.7-28.4-28.4l0-3.6c0-53 43-96 96-96zM41.4 105.4c12.5-12.5 32.8-12.5 45.3 0l64 64c.7 .7 1.3 1.4 1.9 2.1c14.2-7.3 30.4-11.4 47.5-11.4l112 0c17.1 0 33.2 4.1 47.5 11.4c.6-.7 1.2-1.4 1.9-2.1l64-64c12.5-12.5 32.8-12.5 45.3 0s12.5 32.8 0 45.3l-64 64c-.7 .7-1.4 1.3-2.1 1.9c6.2 12 10.1 25.3 11.1 39.5l64.3 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c0 24.6-5.5 47.8-15.4 68.6c2.2 1.3 4.2 2.9 6 4.8l64 64c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0l-63.1-63.1c-24.5 21.8-55.8 36.2-90.3 39.6L272 240c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 239.2c-34.5-3.4-65.8-17.8-90.3-39.6L86.6 502.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l64-64c1.9-1.9 3.9-3.4 6-4.8C101.5 367.8 96 344.6 96 320l-64 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l64.3 0c1.1-14.1 5-27.5 11.1-39.5c-.7-.6-1.4-1.2-2.1-1.9l-64-64c-12.5-12.5-12.5-32.8 0-45.3z" />
              </svg>
            </div>
          </div>
          <div v-if="course" class="cursor-pointer px-1">
            <h1 class="px-1 md:px-3 md:text-xl lg:text-2xl">
              <span class="">{{ questionIndex + 1 }} . </span>
              {{ course.questions[questionIndex].question_text }}?
            </h1>
            <div v-for="(choice, index) in course.questions[questionIndex].choices"
              class="mt-4 space-y-4 px-4 lg:text-xl">
              <button @click=" handleCheck(choice)" class="flex w-full  p-2 gap-x-4 group" :class="{
                'bg-bg-dark-green': styleOption === 'select' && selected == choice.id,
                'bg-red-500': styleOption === 'wrong' && selected == choice.id,
                'bg-bg-light-green': choice.is_correct && questionSolved,
                'bg-red-400': !choice.is_correct && questionSolved && currentSolvedQuestion?.choice_id === choice.id,
              }
                " :disabled="questionSolved">
                <div
                  class="mt-1 max-h-4 min-h-4 min-w-4 max-w-4 rounded-full border-2 border-gray-500 bg-transparent group-hover:bg-bg-light-green   ">
                </div>
                <p class="">
                  {{ choice.choice_text }}
                </p>
              </button>
            </div>
          </div>
          <div class="my-6 flex justify-around md:mt-10 lg:mt-16">
            <div @click="prevQuestion"
              class="flex cursor-pointer items-center gap-x-3 rounded-xl bg-bg-light-green px-3 py-1">
              <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                  d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
              </svg>
              <p class="">Back</p>
            </div>
            <div @click="nextQuestion"
              class="flex cursor-pointer items-center gap-x-3 rounded-xl bg-bg-light-green px-3 py-1">
              <p class="">Next</p>
              <svg class="size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <path
                  d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z" />
              </svg>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="">
        <h1 class=" ">No Question Found</h1>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
