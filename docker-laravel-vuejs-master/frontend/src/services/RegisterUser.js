import HttpService from "./HttpService";

export const registerUser = async (data) => {
    await HttpService.post("/user_register", data);
};
