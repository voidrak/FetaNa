import { defineStore } from "pinia";
import router from "@/router";

export const useChoiceStore = defineStore("choiceStore", {
  state: () => {
    return {
      ChoiceErrors: {},
    };
  },
  actions: {
    /*********************  Create Choice ********************** */
    async createChoice(formData) {
      const res = await fetch("/api/choices", {
        method: "POST",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        body: JSON.stringify(formData),
      });
      const data = await res.json();

      if (data.errors) {
        this.ChoiceErrors = data.errors;
      } else {
        this.ChoiceErrors = {};
        this.router.push({ name: "adminHome" });
      }
    },

  },
});