<script setup>

import { useCourseStore } from '@/stores/course';
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'
import { storeToRefs } from 'pinia';
import { onMounted, reactive, watch } from 'vue';

const props = defineProps(({
  isEditOpen: Boolean,
  course_id: Number,
  courseName: String,
  program_id: Number

}))

const { errors } = storeToRefs(useCourseStore())
const { updateCourse } = useCourseStore()

const formData = reactive({
  name: props.courseName,
});



const handleUpdate = () => {

  updateCourse(props.course_id, formData, props.program_id)


}

onMounted(() => (errors.value = {}));

watch(() => props.courseName, (newProgramName) => {
  if (newProgramName) {
    formData.name = newProgramName
  }
})


</script>
<template>

  <TransitionRoot appear :show="isEditOpen" as="template">
    <Dialog as="div" @close="$emit('closeEditModal')" class="relative z-10">
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
              class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
              <DialogTitle as="h3" class="text-lg font-medium leading-6 text-black">
                Edit The Course
              </DialogTitle>
              <div class="mt-2">
                <div className=" mt-6 flex flex-wrap">
                  <div className="w-full  px-3">
                    <label className="mb-2 md:text-base block text-xs font-bold uppercase tracking-wide text-black"
                      htmlFor="name">
                      Course Name
                    </label>
                    <input v-model="formData.name"
                      className="mb-3   w-full block  appearance-none rounded border border-gray-200 bg-gray-200 px-4 py-3 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                      id="name" name="name" type="text" />
                    <p v-if="errors.name" class="text-sm text-red-500">
                      {{ errors.name[0] }}
                    </p>
                  </div>
                </div>
              </div>

              <div class="mt-4 flex gap-x-4 justify-end">
                <button type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-bg-light-green text-black px-4 py-2 text-sm font-medium  focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="handleUpdate">
                  Submit
                </button>
                <button type="button"
                  class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                  @click="$emit('closeEditModal')">
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
