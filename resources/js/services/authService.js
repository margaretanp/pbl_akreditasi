import axios from "axios";

const ACCESS_TOKEN_KEY = "access_token";
const TOKEN_EXPIRES_KEY = "token_expires";

export const authService = {
    setTokens({ access_token, expires_at }) {
        localStorage.setItem(ACCESS_TOKEN_KEY, access_token);
        localStorage.setItem(TOKEN_EXPIRES_KEY, expires_at);
    },

    getAccessToken() {
        return localStorage.getItem(ACCESS_TOKEN_KEY);
    },

    getTokenExpires() {
        return localStorage.getItem(TOKEN_EXPIRES_KEY);
    },

    removeTokens() {
        localStorage.removeItem(ACCESS_TOKEN_KEY);
        localStorage.removeItem(TOKEN_EXPIRES_KEY);
        localStorage.removeItem("user");
    },

    isAuthenticated() {
        const token = this.getAccessToken();
        const expiresAt = this.getTokenExpires();

        if (!token || !expiresAt) return false;

        try {
            return new Date(expiresAt).getTime() > Date.now();
        } catch {
            return false;
        }
    },

    getLoggedInUser() {
        const user = this.getAccessToken();
        return user ? user : null;
    },
};

export const fetchCurrentUser = async () => {
    const response = await axios.get("profile");
    return response.data;
};
