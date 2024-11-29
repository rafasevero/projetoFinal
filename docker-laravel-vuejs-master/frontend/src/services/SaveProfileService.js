import HttpService from "./HttpService";

export const saveProfile = async (data) => {
    const token = localStorage.getItem("token");
    const headers = {
        Authorization: `Bearer ${token}`,
    };
    
    await HttpService.put("user/update/{id}", data, { headers });
};

export const saveProfileRecruiter = async (data) => {
    const token = localStorage.getItem("token");
    const headers = {
        Authorization: `Bearer ${token}`,
    };

    await HttpService.put("recruiter/update/{id}", data, { headers });
};
