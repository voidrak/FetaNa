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
        return data;
      }
    },
  },
});
