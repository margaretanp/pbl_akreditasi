import axios from "axios";
import authService from "../services/authService";
import router from "../router";

// Set default base URL
axios.defaults.baseURL = "http://localhost:8000/api";

// Set default headers
axios.defaults.headers.common["Accept"] = "application/json";
axios.defaults.headers.common["Content-Type"] = "application/json";

// Attach Bearer token if it exists
const token = authService.getAccessToken();
if (token) {
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
}

// Interceptor to refresh token before every request
axios.interceptors.request.use((config) => {
    const token = authService.getAccessToken();
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
}, (error) => {
    return Promise.reject(error);
});

// Interceptor for handling responses
axios.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            authService.removeTokens();
            router.push("/")
        }
        return Promise.reject(error);
    }
);
