import HttpService from "./HttpService";

export const VagasCriadas = {
    async getJobsCreated() {
        try {
            const response = await HttpService.get('recruiter/getVacancies', {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            });

            // Verifica se a empresa está presente na resposta e salva o ID
            if (response.data.empresa && response.data.empresa.id) {
                localStorage.setItem("empresaLogadaId", response.data.empresa.id);
            } else {
                console.error("ID da empresa não encontrado.");
            }

            return response; // Retorna a resposta para o componente
        } catch (error) {
            console.error("Erro ao obter vagas:", error);
            throw error; // Lança o erro para o componente lidar com ele
        }
    }
}
