import HttpService from "./HttpService";


export const candidatar = async (data, token) => {
    try {
        const response = await HttpService.post(
            `user/applyForVacancy/${data.vacancy_id}`,
            data,
            {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            }
        );
        if (response.status === 200) {
            console.log('Candidatura realizada com sucesso');
            return response.data; 
        } else {
            throw new Error('Erro ao se candidatar');
        }
    } catch (error) {
        console.error('erro ao enviar candidatura', error)
        if(error.response){
            console.error('Resposta do servidor:', error.response.data);
        }
        throw new Error('Erro ao se candidatar');
    }
};
