import HttpService from "./HttpService";

export const applyVacancie = async (data, token, vacancy_id) => {
    try {
        const response = await HttpService.post(
            `user/applyForVacancy/${vacancy_id}`,  // Use template literal para interpolar vacancy_id
            data, {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            }
        );
        return response;
    } catch (error) {
        console.error("Erro ao aplicar para a vaga:", error.response ? error.response.data : error.message);
        throw error;
    }
};
