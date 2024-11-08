import HttpService from "./HttpService";

export const registerRecruiter = async (data) => {
    await HttpService.post("recruiter/recruiter_register", data);
};
