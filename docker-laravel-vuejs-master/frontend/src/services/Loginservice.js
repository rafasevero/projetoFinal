import HttpService from "./HttpService";

export const login = async (email, password) =>{
    await HttpService.post('/login',{
        email,
        password
    })
    .then(Response => {
        console.log(Response)
        localStorage.setItem("token", Response.data.token);
        return Response.data.user;
    })
    .catch(error => {
        console.error("Erro ao fazer login:", error);
        throw error;
    });
}