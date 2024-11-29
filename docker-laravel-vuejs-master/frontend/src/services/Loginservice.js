import HttpService from "./HttpService";

export const login = async (email, password) => {
    try {
        const response = await HttpService.post('user/login', {
            email,
            password
        });
        
        console.log(response);

        localStorage.setItem("token", response.data.token);

        
        // Armazena o token no localStorage
        localStorage.setItem("token", response.data.token);

        // Verifique se o ID da empresa está disponível e armazene corretamente
        

        // Retorna o usuário
        return response.data;
    } catch (error) {
        console.error("Erro ao fazer login:", error);
        throw error;
    }
};
