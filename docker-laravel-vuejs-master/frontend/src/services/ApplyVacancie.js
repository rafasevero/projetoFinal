import HttpService from "./HttpService";

export const applyVacancie = async (data, token, vacancy_id) =>{
    try{
        const reponse = await HttpService.post(
            "applyForVacancy/{vacancy_id}",
            data,{
                headers:{
                    Authorization :`Bearer ${token}`,
                }
            }
        );
        return reponse;
    }catch(error){
        console.error("Erro ao aplicar para a vaga:",error.response ? error.response.data : error.message);
        throw error;
    }
}