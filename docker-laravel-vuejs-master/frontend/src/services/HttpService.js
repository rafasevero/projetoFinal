import axios from "axios";

const HttpService = axios.create({
  baseURL: "http://localhost:8001/api",
  headers: {
    "Content-type": "application/json",
    Accept: "application/json",
  },
});

export default HttpService;
