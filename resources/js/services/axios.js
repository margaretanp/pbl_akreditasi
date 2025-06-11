import axios from "axios";
import { authService } from "./authService";
import router from "../router"

axios.defaults.baseURL = "http://localhost:8000/api";

axios.interceptors.request.use(
  (config) => {
    const accessToken = authService.getToken();

    if (accessToken && authService.isAuthenticated()) {
      config.headers["Authorization"] = `Bearer ${accessToken}`;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

axios.interceptors.response.use(
  (response) => {
    return response;
  },
  (error) => {
    if (error.response && error.response.status === 401) {
      console.error("Unauthorized - Token expired or invalid");
      authService.removeTokens();
      router.push("/")
    }
  }
);

export default axios;