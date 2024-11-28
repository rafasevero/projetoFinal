import HttpService from "./HttpService";

export const saveProfile = async (data, headers) => {
    await HttpService.put("user/update/{id}", data, {headers});
};

export const saveProfileRecruiter = async (data, headers) => {
    await HttpService.put("recruiter/update/{id}", data, {headers});
};