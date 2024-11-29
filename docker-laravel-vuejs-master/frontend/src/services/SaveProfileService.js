import HttpService from "./HttpService";

export const saveProfile = async (data, userId) => {
    const token = localStorage.getItem("token");
    const headers = { Authorization: `Bearer ${token}` };

    // Corrige a URL, substituindo o {id} pelo userId
    await HttpService.put(`user/update/${userId}`, data, { headers });
};



export const saveProfileRecruiter = async (data) => {
    const token = localStorage.getItem("token");
    const headers = {
        Authorization: `Bearer ${token}`,
    };

    await HttpService.put("recruiter/update/{id}", data, { headers });
};
