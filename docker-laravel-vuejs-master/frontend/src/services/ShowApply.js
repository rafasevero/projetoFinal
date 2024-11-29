import HttpService from "./HttpService";

export const ShowApply = {
  getApplications() {
    const token = localStorage.getItem("token");
    console.log("Token de autenticação:", token);  // Verifique se o token está correto
    return HttpService.get("user/getVacanciesForUser", {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
  },
};
