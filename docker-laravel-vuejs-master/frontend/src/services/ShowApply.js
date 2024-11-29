import HttpService from "./HttpService"; // Certifique-se de que o caminho está correto

export const ShowApply = {
  getApplications() {
    return HttpService.get("user/getVacanciesForUser", {
      headers: {
        Authorization: `Bearer ${localStorage.getItem("token")}`,
      },
    });
  },
};
