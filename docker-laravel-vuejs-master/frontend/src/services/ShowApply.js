import HttpService from "./HttpService";
export const ShowApply = async(id) => {
    try{
        const response = await HttpService.get(`user/getVacancyForUser/`);
        console.log('response', response);
        return response;
    }catch(error){
        console.error("Erro ao buscar as vagas: ", error);
        throw error;
    }
}