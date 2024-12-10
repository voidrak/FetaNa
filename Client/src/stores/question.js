import router from "@/router";
import { defineStore } from "pinia";

export const useQuestionStore = defineStore("questionStore", {
  state: () => {
    return {
      errors: {},
    };
  },

  actions: {
    /*********************  Create Questions ********************** */

    async createQuestion(formData) {
      const res = await fetch('/api/questions', {
        method: 'POST',
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
          name: 'AdminCoursePage',
          params: { id: formData.course_id }
        })
        return data;
      }
    },

    /*********************  Update Questions ********************** */

    async updateQuestion(formData, question) {

      const res = await fetch(`/api/questions/${question}`, {
        method: "PUT",
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
        body: JSON.stringify(formData)
      })

      const data = await res.json();

      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.errors = {};
        return data;
      }
    },


    /*********************  Delete Questions ********************** */

    async deleteQuestion(question) {
      const res = await fetch(`/api/questions/${question}`, {
        method: 'DELETE',
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`
        },
      });
      const data = await res.json();
      if (data.errors) {
        this.errors = data.errors;
      } else {
        this.errors = {};
        // console.log(routeId);
        return data;
      }

    },
  },

});
