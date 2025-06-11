import axios from "./axios";

const AUTH_TOKEN = "auth_token";
const EXPIRES_AT = "expires_at";

export const authService = {
    setTokens(response) {
        const { auth_token, expires_at } = response;

        if (!auth_token || !expires_at) {
            console.error("Invalid token response:", response);
            return false;
        }

        try {
            localStorage.setItem(AUTH_TOKEN, auth_token);
            localStorage.setItem(EXPIRES_AT, expires_at);

            return true;
        } catch (error) {
            console.error("Error storing auth data:", error);
            return false;
        }
    },

    removeTokens() {
        try {
            localStorage.removeItem(AUTH_TOKEN);
            localStorage.removeItem(EXPIRES_AT);
        } catch (error) {
            console.error("Error removing auth data:", error);
        }
    },

    getToken() {
        try {
            return localStorage.getItem(AUTH_TOKEN);
        } catch (error) {
            console.error("Error getting token:", error);
            return null;
        }
    },

    getExpiresAt() {
        try {
            return localStorage.getItem(EXPIRES_AT);
        } catch (error) {
            console.error("Error getting expires_at:", error);
            return null;
        }
    },

    // getStoredUser() {
    //   try {
    //     const userData = localStorage.getItem(USER_DATA);
    //     return userData ? JSON.parse(userData) : null;
    //   } catch (error) {
    //     console.error("Error getting stored user data:", error);
    //     return null;
    //   }
    // },

    isAuthenticated() {
        const token = this.getToken();
        const expiresAt = this.getExpiresAt();

        if (!token || !expiresAt) {
            return false;
        }

        try {
            const expiresAtTime = new Date(expiresAt).getTime();
            const isValid = expiresAtTime > Date.now();

            if (!isValid) {
                // Token expired, clean up
                this.removeTokens();
            }

            return isValid;
        } catch (error) {
            console.error("Error parsing expires_at:", error);
            this.removeTokens();
            return false;
        }
    },

    // Get remaining time until token expires (in milliseconds)
    getTimeUntilExpiry() {
        const expiresAt = this.getExpiresAt();
        if (!expiresAt) return 0;

        try {
            const expiresAtTime = new Date(expiresAt).getTime();
            return Math.max(0, expiresAtTime - Date.now());
        } catch (error) {
            console.error("Error calculating time until expiry:", error);
            return 0;
        }
    },

    // Check if token will expire soon (within next 5 minutes)
    isTokenExpiringSoon() {
        const timeUntilExpiry = this.getTimeUntilExpiry();
        return timeUntilExpiry > 0 && timeUntilExpiry < 5 * 60 * 1000; // 5 minutes in ms
    },
};

export const fetchCurrentUser = async () => {
    const response = await axios.get("/profile");
    return response.data;
};
