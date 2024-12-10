<script setup>
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import { storeToRefs } from 'pinia';
import { onMounted, reactive, watch, watchEffect } from "vue";
import { useQuestionStore } from "@/stores/question";





const props = defineProps(({
  isEditQuestionOpen: Boolean,
  question_id: Number,
  questionText: String,
  choice_1: String,
  choice_2: String,
  choice_3: String,
  choice_4: String,
  correct_choice: String,

}))


const emit = defineEmits(['updateCourse', 'closeEditQuestionModal'])


const { errors } = storeToRefs(useQuestionStore())
const { updateQuestion } = useQuestionStore();


const formData = reactive({
  question_text: "",
  choices: [],
  correct_choice: ""
});


const handleUpdate = () => {
  updateQuestion(formData, props.question_id)
  emit("updateCourse");
  emit("closeEditQuestionModal")

}

onMounted(() => (errors.value = {}));

watchEffect(() => {
  formData.question_text = props.questionText || "";
  formData.choices = [
    props.choice_1 || "",
    props.choice_2 || "",
    props.choice_3 || "",
    props.choice_4 || ""
  ];
  formData.correct_choice = props.correct_choice || "";
});


</script>
<template>

  <TransitionRoot appear :show="isEditQuestionOpen" as="template">
    <Dialog as="div" @close="$emit('closeEditQuestionModal')" class="relative z-10">
      <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
        leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-black/25" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center">
          <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95">
            <DialogPanel
              class="w-full max-w-xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              <DialogTitle as="h3" class="text-lg font-medium leading-6 text-black">
                Edit The Question
              </DialogTitle>
              <div className=" mt-6 w-full    ">
                <div className=" ">
                  <label className="mb-2 md:text-base block text-xs font-bold uppercase tracking-wide text-black"
                    htmlFor="question_text">
                    Question Text
                  </label>
                  <textarea v-model="formData.question_text"
                    className="mb-3  w-full block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                    id="question_text" name="question_text" type="text" />
                  <p v-if="errors.question_text" class="text-sm text-red-500">
                    {{ errors.question_text[0] }}
                  </p>
                </div>
              </div>

              <div className=" mt-8">
                <label
                  className="mb-2 w-[120px] md:text-base block text-xs font-bold uppercase tracking-wide text-black"
                  htmlFor="choice_text">
                  Choice One
                </label>
                <div class="flex gap-x-6 items-center">
                  <input v-model="formData.choices[0]"
                    className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                    id="choice_text_1" name="choice_text" type="text" />
                  <div @click="formData.correct_choice = formData.choices[0]"
                    class="py-2 px-3 border border-gray-500 rounded-md cursor-pointer hover:bg-bg-light-green" :class="{
                      'bg-bg-light-green': formData.correct_choice === formData.choices[0],
                    }">Correct
                  </div>
                </div>
                <p v-if="errors.choices" class="text-sm text-red-500">
                  {{ errors.choices[0] }}
                </p>
              </div>
              <div className=" ">
                <label
                  className="mb-2 w-[120px] md:text-base block text-xs font-bold uppercase tracking-wide text-black"
                  htmlFor="choice_text">
                  Choice Two
                </label>
                <div class="flex gap-x-6 items-center">
                  <input v-model="formData.choices[1]"
                    className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                    id="choice_text_2" name="choice_text" type="text" />
                  <div @click="formData.correct_choice = formData.choices[1]"
                    class="py-2 px-3 border border-gray-500 rounded-md cursor-pointer hover:bg-bg-light-green" :class="{
                      'bg-bg-light-green': formData.correct_choice === formData.choices[1],
                    }">Correct
                  </div>
                </div>
                <p v-if="errors.choices" class="text-sm text-red-500">
                  {{ errors.choices[0] }}
                </p>
              </div>
              <div className=" ">
                <label
                  className="mb-2 w-[120px] md:text-base block text-xs font-bold uppercase tracking-wide text-black"
                  htmlFor="choice_text">
                  Choice Three
                </label>
                <div class="flex gap-x-6 items-center">
                  <input v-model="formData.choices[2]"
                    className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                    id="choice_text_3" name="choice_text" type="text" />
                  <div @click="formData.correct_choice = formData.choices[2]"
                    class="py-2 px-3 border border-gray-500 rounded-md cursor-pointer hover:bg-bg-light-green" :class="{
                      'bg-bg-light-green': formData.correct_choice === formData.choices[2]
                    }">Correct
                  </div>
                </div>
                <p v-if="errors.choices" class="text-sm text-red-500">
                  {{ errors.choices[0] }}
                </p>
              </div>
              <div className=" ">
                <label
                  className="mb-2 w-[120px] md:text-base block text-xs font-bold uppercase tracking-wide text-black"
                  htmlFor="choice_text">
                  Choice Four
                </label>
                <div class="flex gap-x-6 items-center">
                  <input v-model="formData.choices[3]"
                    className="mb-3  min-w-[280px] md:w-[500px] w-[80%] xl:w-[600px] block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                    id="choice_text_4" name="choice_text" type="text" />
                  <div @click="formData.correct_choice = formData.choices[3]"
                    class="py-2 px-3 border border-gray-500 rounded-md cursor-pointer hover:bg-bg-light-green" :class="{
                      'bg-bg-light-green': formData.correct_choice === formData.choices[3]
                    }">Correct
                  </div>
                </div>
                <p v-if="errors.choices" class="text-sm text-red-500">
                  {{ errors.choices[0] }}
                </p>
              </div>

              <div class="mt-4 flex gap-x-4 justify-end">
                <button type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-bg-light-green text-black px-4 py-2 text-sm font-medium  focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="handleUpdate">
                  Update
                </button>
                <button type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="$emit('closeEditQuestionModal')">
                  Cancel
                </button>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
