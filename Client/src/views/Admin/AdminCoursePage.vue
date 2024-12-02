<script setup>
import AdminLayout from "@/Layout/AdminLayout.vue";
import { useCourseStore } from "@/stores/course";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
const { getCourse } = useCourseStore();
const course = ref(null);
const route = useRoute();
onMounted(async () => {
  course.value = await getCourse(route.params.id);
  console.log(course.value.questions);
});

const indexToChar = (index) => {
  const charCode = "A".charCodeAt(0) + index;
  return String.fromCharCode(charCode);
};
</script>

<template>
  <AdminLayout>
    <div v-if="course" class="px-2 sm:py-4 md:py-8">
      <h1
        class="text-2xl lg:text-3xl xl:text-4xl font-semibold text-bg-light-green"
      >
        {{ course.name }}
      </h1>
      <div class="mt-4">
        <h1 class="text-xl md:text-2xl xl:text-3xl lg:ml-10 underline">
          All Questions
        </h1>
        <div class="mt-4 pb-8">
          <div
            v-for="(question, index) in course.questions"
            :key="question.id"
            class="w-full mx-auto px-1 pt-2"
          >
            <div
              class="w-full mx-auto xl:mx-0 xl:ml-16 sm:max-w-[90%] lg:max-w-screen-md rounded-2xl bg-white p-2"
            >
              <Disclosure v-slot="{ open }">
                <DisclosureButton
                  class="flex w-full justify-between rounded-lg bg-purple-100 px-4 py-2 text-left text-sm font-medium text-purple-900 hover:bg-purple-200 focus:outline-none focus-visible:ring focus-visible:ring-purple-500/75"
                >
                  <h1>
                    <span class="font-bold mr-2">{{ index + 1 }}.</span>
                    {{ question.question_text }} ?
                  </h1>

                  <svg
                    :class="!open ? 'rotate-180 transform' : ''"
                    class="min-h-5 min-w-5 max-w-5 max-h-5 fill-purple-500"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512"
                  >
                    <path
                      d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"
                    />
                  </svg>
                </DisclosureButton>
                <div class="divide-bg-light-green divide-y">
                  <DisclosurePanel
                    v-for="(choice, index) in question.choices"
                    class="px-4 b pb-2 pt-4 text-sm text-gray-500"
                    :class="choice.is_correct ? `bg-bg-light-green` : ``"
                  >
                    <p>
                      <span class="">{{ indexToChar(index) }} . </span>
                      {{ choice.choice_text }}
                    </p>
                  </DisclosurePanel>
                </div>
              </Disclosure>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-else class="">No Course Found</div>
  </AdminLayout>
</template>
