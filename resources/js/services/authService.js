import { jwtDecode } from "jwt-decode";

const ACCESS_TOKEN_KEY = "access_token";
const JWT_KEY = "jwt";
const TOKEN_EXPIRES_KEY = "token_expires";

const authService = {
    setTokens(responseData) {
        const { access_token, jwt_key, expires_at } = responseData;
        localStorage.setItem(ACCESS_TOKEN_KEY, access_token);
        localStorage.setItem(JWT_KEY, jwt_key);
        localStorage.setItem(TOKEN_EXPIRES_KEY, expires_at);
    },
    getAccessToken() {
        return localStorage.getItem(ACCESS_TOKEN_KEY);
    },
    getJwt() {
        return localStorage.getItem(JWT_KEY);
    },
    getTokenExpires() {
        return localStorage.getItem(TOKEN_EXPIRES_KEY);
    },
    removeTokens() {
        localStorage.removeItem(ACCESS_TOKEN_KEY);
        localStorage.removeItem(JWT_KEY);
        localStorage.removeItem(TOKEN_EXPIRES_KEY);
    },
    isAuthenticated() {
        const expiresAt = this.getTokenExpires();
        if (!expiresAt) return false;

        try {
            const expiresAtTime = new Date(expiresAt).getTime();
            return expiresAtTime > Date.now();
        } catch (error) {
            console.error("Error parsing token expiration time:", error);
            return false;
        }
    },
    getLoggedInUser() {
        const jwt = this.getJwt();
        if (!jwt) return null;

        try {
            return jwtDecode(jwt);
        } catch (error) {
            console.error(error.message);
            return null;
        }
    },
};

export default authService;