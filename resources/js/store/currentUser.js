import { reactive } from "vue";
import { defineStore } from "pinia";

import { useToast } from "vue-toast-notification";

import { authService, fetchCurrentUser } from "../services/authService";

const $toast = useToast();

export const useCurrentUserStore = defineStore("user", {
  state: () => ({
    currentUser: reactive({}),
    isLoading: false,
    error: null,
  }),

  getters: {
    isAuthenticated: (state) => {
      return (
        authService.isAuthenticated() &&
        state.currentUser &&
        Object.keys(state.currentUser).length > 0
      );
    },

    userData: (state) => {
      return state.currentUser?.data || null;
    },

    userRole: (state) => {
      return state.currentUser?.data?.role || null;
    },
  },

  actions: {
    async getCurrentUser() {
      this.isLoading = true;
      this.error = null;

      try {
        const userData = await fetchCurrentUser();

        if (userData.status === "success") {
          this.currentUser = userData.data;
        } else {
          throw new Error(userData.message || "Failed to fetch user data");
        }
      } catch (error) {
        console.error("Failed to load user data:", error);
        this.error = error.message;

        // If it's an authentication error, clear the token
        if (error.response?.status === 401) {
          authService.removeTokens();
          this.clearUser();
          $toast.error("Session expired. Please login again.");
        } else {
          $toast.error("Failed to load user data");
        }

        throw error;
      } finally {
        this.isLoading = false;
      }
    },

    clearUser() {
      this.currentUser = reactive({});
      this.error = null;
      this.isLoading = false;
    },

    // Helper method to initialize user state
    async initializeUser() {
      if (authService.isAuthenticated()) {
        try {
          await this.getCurrentUser();
        } catch (error) {
          // Error already handled in getCurrentUser
          console.error("Failed to initialize user:", error);
        }
      } else {
        this.clearUser();
      }
    },
  },
});