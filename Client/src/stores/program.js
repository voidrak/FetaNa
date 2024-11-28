import { defineStore } from "pinia";
import router from "@/router";
export const useProgramStore = defineStore("programStore", {
  state: () => {
    return {
      errors: {},
    };
  },

  actions: {
    /*********************  Get All Programs ********************** */

    async getAllPrograms() {
      const res = await fetch("/api/programs", {
        method: "GET",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();
      console.log(data);
      return data;
    },
    /*********************  Get A Program ********************** */

    async getProgram(program) {
      const res = await fetch(`/api/programs/${program}`, {
        method: "GET",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();
      console.log(data);
      return data;
    },

    /*********************  Create Program ********************** */

    async createProgram(formData) {
      const res = await fetch("/api/programs", {
        method: "POST",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },

        body: JSON.stringify(formData),
      });

      const data = await res.json();

      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.errors = {};
        this.router.push({ name: "adminHome" });
      }
    },
  },
});
