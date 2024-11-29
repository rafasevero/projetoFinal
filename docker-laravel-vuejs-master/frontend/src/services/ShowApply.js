import HttpService from "./HttpService";

export const VagasCandidate = {
  async getApplications() {
      try {
          const response = await HttpService.get('user/getVacanciesForUser', {
              headers: {
                  Authorization: `Bearer ${localStorage.getItem("token")}`
              }
              
            });
            
            // Verifica se a empresa está presente na resposta e salva o ID
            console.log("Token:", localStorage.getItem("token"));
            console.log("Resposta completa:", response.data);

            if (response.data.applications?.length > 0) {
              const firstApplication = response.data.applications[0];
              localStorage.setItem("usuarioLogadoId", firstApplication.user_id);
            } else {
              console.warn("Nenhuma candidatura encontrada para salvar o ID.");
            }
            
          

          return response; // Retorna a resposta para o componente
      } catch (error) {
          console.error("Erro ao obter vagas:", error);
          throw error; // Lança o erro para o componente lidar com ele
      }
  }
}

