import HttpService from "./HttpService";

export const login = async (email, password) => {
    try {
        const response = await HttpService.post('/login', {
            email,
            password
        });
        
        console.log(response);
        localStorage.setItem("token", response.data.token);
        
        // Retorna o usuário
        return response.data.user;
    } catch (error) {
        console.error("Erro ao fazer login:", error);
        throw error;
    }
};
