import HttpService from "./HttpService";
export const ShowVagas = async() => {
    try{
        const response = await HttpService.get('index_vacancies');
        console.log('response', response);
        return response;
    }catch(error){
        console.error("Erro ao buscar as vagas: ", error);
        throw error;
    }
}