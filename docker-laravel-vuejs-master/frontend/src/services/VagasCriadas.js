import HttpService from "./HttpService";

export const VagasCriadas = {
    async getJobsCreated() {
        try {
            const response = await HttpService.get('recruiter/getVacancies', {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem("token")}`
                }
            });

            if (response.data.recruiter && response.data.recruiter.id) {
                localStorage.setItem("recruiterLogadoId", response.data.recruiter.id);
            } else {
                console.error("ID do recruiter não encontrado.");
            }

            return response;
        } catch (error) {
            console.error("Erro ao obter vagas:", error);
            throw error;
        }
    }
};
