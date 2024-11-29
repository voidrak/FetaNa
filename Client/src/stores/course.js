import { defineStore } from "pinia";
import router from "@/router";

export const useCourseStore = defineStore("courseStore", {
  state: () => {
    return {
      errors: {},
    };
  },

  actions: {
    /*********************  Create Courses ********************** */
    async createCourse(formData) {
      const res = await fetch("/api/courses", {
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
        this.router.push({
          name: "AdminProgramPage",
          params: { id: formData.program_id },
        });
      }
    },

    /*********************  Get a Courses ********************** */

    async getCourse(course) {
      const res = await fetch(`/api/courses/${course}`, {
        method: "GET",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });
      const data = await res.json();

      return data;
    },
  },
});
