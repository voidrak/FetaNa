<script setup>
import CourseCard from "@/Components/ProgramPage/CourseCard.vue";
import AdminLayout from "@/Layout/AdminLayout.vue";
import { useProgramStore } from "@/stores/program";
import { onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import DeleteProgramModal from "@/Components/ProgramPage/DeleteProgramModal.vue";
import EditProgramModal from "@/Components/ProgramPage/EditProgramModal.vue";

const { getProgram } = useProgramStore();
const program = ref(null);

const route = useRoute();

onMounted(async () => {
  program.value = await getProgram(route.params.id);

});

const isDeleteOpen = ref(false)
const isEditOpen = ref(false)

function closeDeleteModal() {
  isDeleteOpen.value = false
}
function openDeleteModal() {
  isDeleteOpen.value = true
}
function closeEditModal() {
  isEditOpen.value = false
}
function openEditModal() {
  isEditOpen.value = true
}
</script>

<template>
  <AdminLayout>
    <div class="mt-6">
      <DeleteProgramModal @closeDeleteModal="closeDeleteModal" @openDeleteModal="openDeleteModal"
        :isDeleteOpen="isDeleteOpen" :program_id="program?.id" />
      <EditProgramModal @closeEditModal="closeEditModal" @openEditModal="openEditModal" :isEditOpen="isEditOpen"
        :program_id="program?.id" />

      <div v-if="program" class="">
        <div class="flex items-center justify-center gap-x-1 min-[425px]:gap-x-2 sm:gap-x-4 lg:gap-x-6">
          <h1
            class="text-nowrap text-center text-2xl min-[425px]:text-3xl  font-semibold text-bg-light-green lg:text-4xl xl:text-5xl">
            {{ program.name }}
          </h1>
          <div class="  text-right">
            <Menu as="div" class="relative inline-block text-left">
              <div>
                <MenuButton
                  class="inline-flex w-full justify-center rounded-md   px-4 py-2 text-sm font-medium text-white hover:bg-black/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75">
                  <svg class="min-w-6 cursor-pointer max-w-6 lg:min-w-8 lg:max-w-8 mt-1 lg:mt-2" viewBox="0 0 24 25"
                    fill="#343C54" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M11.9992 8.7743C9.88118 8.7743 8.16419 10.4913 8.16419 12.6093C8.16419 14.7273 9.88118 16.4443 11.9992 16.4443C14.1172 16.4443 15.8342 14.7273 15.8342 12.6093C15.8342 10.4913 14.1172 8.7743 11.9992 8.7743ZM9.66419 12.6093C9.66419 11.3197 10.7096 10.2743 11.9992 10.2743C13.2888 10.2743 14.3342 11.3197 14.3342 12.6093C14.3342 13.8989 13.2888 14.9443 11.9992 14.9443C10.7096 14.9443 9.66419 13.8989 9.66419 12.6093Z"
                      fill="#343C54" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M2.5809 8.9224C1.96404 9.99083 2.33012 11.357 3.39854 11.9739C3.88777 12.2563 3.88776 12.9625 3.39856 13.2449C2.33013 13.8618 1.96407 15.2279 2.58092 16.2964L4.09692 18.9222C4.71391 19.9908 6.08044 20.3568 7.14896 19.7399C7.63844 19.4573 8.25011 19.8106 8.25011 20.3754C8.25011 21.6092 9.2503 22.6094 10.4841 22.6094H13.5165C14.7502 22.6094 15.7501 21.6091 15.7501 20.3756C15.7501 19.8108 16.3615 19.458 16.8503 19.7402C17.9185 20.357 19.2845 19.991 19.9012 18.9227L21.4176 16.2963C22.0344 15.2279 21.6684 13.8617 20.6 13.2449C20.1108 12.9624 20.1108 12.2563 20.6 11.9739C21.6684 11.3571 22.0345 9.99089 21.4176 8.92247L19.9012 6.29604C19.2845 5.2278 17.9185 4.86179 16.8503 5.47854C16.3615 5.76076 15.7501 5.40794 15.7501 4.84314C15.7501 3.60961 14.7502 2.60938 13.5165 2.60938H10.4841C9.2503 2.60938 8.25011 3.60957 8.25011 4.84337C8.25011 5.40822 7.63842 5.76152 7.14894 5.47892C6.08042 4.86201 4.71388 5.22797 4.09689 6.29663L2.5809 8.9224ZM4.14854 10.6748C3.79755 10.4722 3.6773 10.0234 3.87994 9.6724L5.39593 7.04663C5.59863 6.69554 6.04772 6.57518 6.39894 6.77796C7.88811 7.63773 9.75011 6.56327 9.75011 4.84337C9.75011 4.43799 10.0787 4.10937 10.4841 4.10937L13.5165 4.10937C13.9216 4.10937 14.2501 4.43788 14.2501 4.84314C14.2501 6.56227 16.1112 7.63733 17.6003 6.77758C17.9511 6.57504 18.3997 6.69524 18.6022 7.04604L20.1186 9.67247C20.3212 10.0234 20.201 10.4722 19.85 10.6749C18.3608 11.5346 18.3608 13.6841 19.85 14.5439C20.2009 14.7465 20.3212 15.1953 20.1186 15.5463L18.6022 18.1727C18.3996 18.5235 17.9511 18.6437 17.6003 18.4412C16.1112 17.5815 14.2501 18.6565 14.2501 20.3756C14.2501 20.7809 13.9216 21.1094 13.5165 21.1094H10.4841C10.0787 21.1094 9.75011 20.7808 9.75011 20.3754C9.75011 18.6555 7.88812 17.5811 6.39896 18.4408C6.04774 18.6436 5.59866 18.5232 5.39596 18.1722L3.87996 15.5464C3.67732 15.1954 3.79757 14.7466 4.14856 14.5439C5.63778 13.6841 5.63775 11.5346 4.14854 10.6748Z"
                      fill="#343C54" />
                  </svg>
                  <!-- <ChevronDownIcon
            class="-mr-1 ml-2 h-5 w-5 text-violet-200 hover:text-violet-100"
            aria-hidden="true"
          /> -->
                </MenuButton>
              </div>

              <transition enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in" leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0">
                <MenuItems
                  class="absolute right-0 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                  <div @click="openEditModal" class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                    <button :class="[
                      active ? 'bg-bg-light-green text-white' : 'text-gray-900',
                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                    ]">

                      <svg :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" viewBox="0 0 24 24"
                        fill="#343C54" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M19.3028 3.7801C18.4241 2.90142 16.9995 2.90142 16.1208 3.7801L14.3498 5.5511C14.3442 5.55633 14.3387 5.56166 14.3333 5.5671C14.3279 5.57253 14.3225 5.57803 14.3173 5.58359L5.83373 14.0672C5.57259 14.3283 5.37974 14.6497 5.27221 15.003L4.05205 19.0121C3.9714 19.2771 4.04336 19.565 4.23922 19.7608C4.43508 19.9567 4.72294 20.0287 4.98792 19.948L8.99703 18.7279C9.35035 18.6203 9.67176 18.4275 9.93291 18.1663L20.22 7.87928C21.0986 7.0006 21.0986 5.57598 20.22 4.6973L19.3028 3.7801ZM14.8639 7.15833L6.89439 15.1278C6.80735 15.2149 6.74306 15.322 6.70722 15.4398L5.8965 18.1036L8.56029 17.2928C8.67806 17.257 8.7852 17.1927 8.87225 17.1057L16.8417 9.13619L14.8639 7.15833ZM17.9024 8.07553L19.1593 6.81862C19.4522 6.52572 19.4522 6.05085 19.1593 5.75796L18.2421 4.84076C17.9492 4.54787 17.4743 4.54787 17.1814 4.84076L15.9245 6.09767L17.9024 8.07553Z"
                          fill="#343C54" />
                      </svg>


                      Edit
                    </button>
                    </MenuItem>
                  </div>
                  <div class="px-1 py-1">
                  </div>

                  <div class="px-1 py-1">
                    <MenuItem v-slot="{ active }">
                    <button @click="openDeleteModal" :class="[
                      active ? 'bg-bg-light-green text-white' : 'text-gray-900',
                      'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                    ]">


                      <svg :active="active" class="mr-2 h-5 w-5 text-violet-400" aria-hidden="true" viewBox="0 0 24 24"
                        fill="#343C54" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M14.7223 12.7585C14.7426 12.3448 14.4237 11.9929 14.01 11.9726C13.5963 11.9522 13.2444 12.2711 13.2241 12.6848L12.9999 17.2415C12.9796 17.6552 13.2985 18.0071 13.7122 18.0274C14.1259 18.0478 14.4778 17.7289 14.4981 17.3152L14.7223 12.7585Z"
                          fill="#343C54" />
                        <path
                          d="M9.98802 11.9726C9.5743 11.9929 9.25542 12.3448 9.27577 12.7585L9.49993 17.3152C9.52028 17.7289 9.87216 18.0478 10.2859 18.0274C10.6996 18.0071 11.0185 17.6552 10.9981 17.2415L10.774 12.6848C10.7536 12.2711 10.4017 11.9522 9.98802 11.9726Z"
                          fill="#343C54" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M10.249 2C9.00638 2 7.99902 3.00736 7.99902 4.25V5H5.5C4.25736 5 3.25 6.00736 3.25 7.25C3.25 8.28958 3.95503 9.16449 4.91303 9.42267L5.54076 19.8848C5.61205 21.0729 6.59642 22 7.78672 22H16.2113C17.4016 22 18.386 21.0729 18.4573 19.8848L19.085 9.42267C20.043 9.16449 20.748 8.28958 20.748 7.25C20.748 6.00736 19.7407 5 18.498 5H15.999V4.25C15.999 3.00736 14.9917 2 13.749 2H10.249ZM14.499 5V4.25C14.499 3.83579 14.1632 3.5 13.749 3.5H10.249C9.83481 3.5 9.49902 3.83579 9.49902 4.25V5H14.499ZM5.5 6.5C5.08579 6.5 4.75 6.83579 4.75 7.25C4.75 7.66421 5.08579 8 5.5 8H18.498C18.9123 8 19.248 7.66421 19.248 7.25C19.248 6.83579 18.9123 6.5 18.498 6.5H5.5ZM6.42037 9.5H17.5777L16.96 19.7949C16.9362 20.191 16.6081 20.5 16.2113 20.5H7.78672C7.38995 20.5 7.06183 20.191 7.03807 19.7949L6.42037 9.5Z"
                          fill="#343C54" />
                      </svg>

                      Delete
                    </button>
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
          </div>


        </div>
        <div class="mt-12 grid gap-y-4 lg:grid-cols-2 2xl:grid-cols-3">
          <div v-for="course in program.courses" :key="course.id">
            <CourseCard :courseTitle="course.name" :id="course.id" :isAdmin="true" />
          </div>
        </div>
      </div>
      <div v-else class="">
        <p>No courses available.</p>
      </div>
    </div>
  </AdminLayout>
</template>
