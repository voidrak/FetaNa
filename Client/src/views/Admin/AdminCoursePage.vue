<script setup>
import AdminLayout from "@/Layout/AdminLayout.vue";
import { useCourseStore } from "@/stores/course";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { useQuestionStore } from "@/stores/question";


const { getCourse } = useCourseStore();
const { deleteQuestion } = useQuestionStore()

const course = ref(null);

const route = useRoute();
onMounted(async () => {
  course.value = await getCourse(route.params.id);
  // console.log(course.value);
});

const indexToChar = (index) => {
  const charCode = "A".charCodeAt(0) + index;
  return String.fromCharCode(charCode);
};

const DeleteQuestion = (id) => {
  console.log(route.params.id);
  deleteQuestion(id, route.params.id);
}

</script>

<template>
  <AdminLayout>
    <div v-if="course && course.questions.length > 0" class="px-2 sm:py-4 md:py-8">
      <h1 class="text-2xl lg:text-3xl xl:text-4xl font-semibold text-bg-light-green">
        {{ course.name }}
      </h1>
      <div class="mt-4 lg:mt-8">
        <h1 class="text-xl md:text-2xl xl:text-3xl lg:ml-10 underline">
          All Questions
        </h1>
        <div class="mt-4 pb-8">
          <div v-for="(question, index) in course.questions" :key="question.id" class="w-full mx-auto px-1 pt-2">
            <div
              class="w-full mx-auto xl:mx-0 xl:ml-16 sm:max-w-[90%] lg:max-w-screen-md xl:max-w-[900px] 2xl:ml-32 rounded-2xl bg-white p-2">
              <Disclosure v-slot="{ open }">
                <DisclosureButton
                  class="flex w-full justify-between rounded-lg bg-purple-100 px-4 py-2 text-left text-sm font-medium text-purple-900 hover:bg-purple-200 focus:outline-none focus-visible:ring focus-visible:ring-purple-500/75">
                  <h1 class="xl:text-xl">
                    <span class="font-bold mr-2 ">{{ index + 1 }}.</span>
                    {{ question.question_text }} ?
                  </h1>

                  <svg :class="!open ? 'rotate-180 transform' : ''"
                    class="min-h-5 min-w-5 max-w-5 max-h-5 fill-purple-500" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512">
                    <path
                      d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                  </svg>
                </DisclosureButton>

                <DisclosurePanel class="">
                  <div class="divide-bg-light-green divide-y">
                    <div v-for="(choice, index) in question.choices" class="px-4  pb-2 pt-4 text-sm text-gray-500"
                      :class="choice.is_correct ? `bg-bg-light-green` : ``">
                      <p>
                        <span class="">{{ indexToChar(index) }} . </span>
                        {{ choice.choice_text }}
                      </p>
                    </div>
                  </div>
                  <div class="w-full flex justify-end px-4 gap-x-4 my-4">
                    <svg class=" cursor-pointer size-6 fill-blue-accent" xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 512 512">
                      <path
                        d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152L0 424c0 48.6 39.4 88 88 88l272 0c48.6 0 88-39.4 88-88l0-112c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 112c0 22.1-17.9 40-40 40L88 464c-22.1 0-40-17.9-40-40l0-272c0-22.1 17.9-40 40-40l112 0c13.3 0 24-10.7 24-24s-10.7-24-24-24L88 64z" />
                    </svg>
                    <svg @click.prevent="DeleteQuestion(question.id)" class=" cursor-pointer size-6 fill-red-500"
                      xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                      <path
                        d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                    </svg>
                  </div>

                </DisclosurePanel>


              </Disclosure>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="h-full w-full flex justify-center items-center text-2xl text-red-500">No Question Found</div>
  </AdminLayout>
</template>
