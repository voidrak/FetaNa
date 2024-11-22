<script setup>
import { reactive } from "vue";
import GuestLayout from "@/Layout/GuestLayout.vue";
import Logo from "/public/FetaNaLogo.png";

const formData = reactive({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
});
</script>

<template>
  <GuestLayout>
    <div
      class="flex max-h-[calc(100vh-90px)] my-4 flex-col justify-center py-0 px-4"
    >
      <div
        class="mx-auto w-full max-w-md rounded-2xl border border-gray-300 p-8"
      >
        <div class="mb-12 text-center">
          <img :src="Logo" alt="logo" class="inline-block w-40" />
        </div>

        <form @submit.prevent="console.log(formData)">
          <div class="space-y-6">
            <div>
              <label for="name" class="mb-2 block text-sm text-gray-800"
                >Full Name</label
              >
              <input
                v-model="formData.name"
                id="name"
                name="name"
                type="text"
                autocomplete="name"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter name"
              />
            </div>
            <div>
              <label for="email" class="mb-2 block text-sm text-gray-800"
                >Email
              </label>
              <input
                v-model="formData.email"
                id="email"
                name="email"
                type="text"
                autocomplete="email"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter email"
              />
            </div>
            <div>
              <label for="password" class="mb-2 block text-sm text-gray-800"
                >Password</label
              >
              <input
                v-model="formData.password"
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter password"
              />
            </div>
            <div>
              <label
                for="password_confirmation"
                class="mb-2 block text-sm text-gray-800"
                >Confirm Password</label
              >
              <input
                v-model="formData.password_confirmation"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter confirm password"
              />
            </div>
          </div>

          <div class="!mt-12">
            <button
              type="submit"
              class="w-full rounded-md bg-blue-600 px-4 py-3 text-sm font-semibold tracking-wider text-white hover:bg-blue-700 focus:outline-none"
            >
              Create an account
            </button>
          </div>
          <p class="mt-6 text-center text-sm text-gray-800">
            Already have an account?
            <a
              href="javascript:void(0);"
              class="ml-1 font-semibold text-blue-600 hover:underline"
              >Login here</a
            >
          </p>
        </form>
      </div>
    </div>
  </GuestLayout>
</template>
