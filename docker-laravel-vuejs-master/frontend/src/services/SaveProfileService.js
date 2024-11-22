import HttpService from "./HttpService";

export const saveProfile = async (data, headers) => {
    await HttpService.put("user/user_profile", data, {headers});
};