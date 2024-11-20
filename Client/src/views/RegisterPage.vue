<script setup>
import GuestLayout from "../Layout/GuestLayout.vue";
import Logo from "/public/FetaNaLogo.png";
</script>

<template>
  <GuestLayout>
    <div class="flex max-h-[calc(100vh-90px)] my-8 flex-col justify-center p-4">
      <div
        class="mx-auto w-full max-w-md rounded-2xl border border-gray-300 p-8"
      >
        <div class="mb-12 text-center">
          <a href="javascript:void(0)"
            ><img :src="Logo" alt="logo" class="inline-block w-40" />
          </a>
        </div>

        <form>
          <div class="space-y-6">
            <div>
              <label class="mb-2 block text-sm text-gray-800">First Name</label>
              <input
                name="name"
                type="text"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter name"
              />
            </div>
            <div>
              <label class="mb-2 block text-sm text-gray-800">Email </label>
              <input
                name="email"
                type="text"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter email"
              />
            </div>
            <div>
              <label class="mb-2 block text-sm text-gray-800">Password</label>
              <input
                name="password"
                type="password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter password"
              />
            </div>
            <div>
              <label class="mb-2 block text-sm text-gray-800"
                >Confirm Password</label
              >
              <input
                name="cpassword"
                type="password"
                class="w-full rounded-md border border-gray-300 bg-white px-4 py-3 text-sm text-gray-800 outline-bg-light-green"
                placeholder="Enter confirm password"
              />
            </div>

            <div class="flex items-center">
              <input
                id="remember-me"
                name="remember-me"
                type="checkbox"
                class="h-4 w-4 shrink-0 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
              />
              <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                I accept the
                <a
                  href="javascript:void(0);"
                  class="ml-1 font-semibold text-blue-600 hover:underline"
                  >Terms and Conditions</a
                >
              </label>
            </div>
          </div>

          <div class="!mt-12">
            <button
              type="button"
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
