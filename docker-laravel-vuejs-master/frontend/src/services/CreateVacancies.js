import HttpService from "./HttpService";

export const createVacancy = async (data, token) => {
    try {
        const response = await HttpService.post(
            "recruiter/vacancy_register",
            data,
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        );
        return response; // Certifique-se de retornar a resposta
    } catch (error) {
        console.error("Erro na criação da vaga:", error.response ? error.response.data : error.message);
        throw error;
    }
};
