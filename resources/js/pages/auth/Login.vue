<script setup>
import axios from "axios";
import { computed, reactive } from "vue";
import { useRouter } from "vue-router";
import { useToast } from "vue-toast-notification";
import authService from "../../services/authService";
import InputField from "../../components/InputField.vue";

const $toast = useToast();
const router = useRouter();

const formLogin = reactive({
    email: "",
    password: "",
    loading: false,
});

const isFormValid = computed(() => {
    return formLogin.email.trim() !== "" && formLogin.password.trim() !== "";
});

const onSubmitLogin = async () => {
    if (!isFormValid.value || formLogin.loading) return;
    formLogin.loading = true;

    try {
        const { data } = await axios.post(
            "/api/login",
            {
                email: formLogin.email,
                password: formLogin.password,
            },
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );

        if (data.status === "success") {
            // Extract token information and pass it to authService
            const tokenData = {
                access_token: data.access_token,
                jwt_key: data.jwt_key,
                expires_at: data.expires_at
            };
            
            authService.setTokens(tokenData);
            
            // Save user data if needed
            localStorage.setItem('user', JSON.stringify(data.user));
            
            $toast.success("Login successful!");
            router.push("/dashboard");
        } else {
            throw new Error(data.message || "Login failed");
        }
    } catch (error) {
        console.error("Login error:", error);
        $toast.error(error.response?.data?.message || "Username or password is incorrect");
    } finally {
        formLogin.loading = false;
    }
};
</script>

<template>
    <div class="w-1/3 h-screen px-16 py-20 flex flex-col gap-y-8">
        <div>
            <h1>Selamat Datang di Website Akreditasi</h1>
            <p>Silahkan login untuk melanjutkan</p>
        </div>

        <form class="flex flex-col gap-y-4" @submit.prevent="onSubmitLogin">
            <InputField
                id="email"
                label="Email"
                type="email"
                placeholder="Masukkan email"
                v-model="formLogin.email"
            />

            <InputField
                id="password"
                label="Password"
                type="password"
                placeholder="Masukkan password"
                v-model="formLogin.password"
            />

            <button 
                type="submit" 
                class="bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors"
                :disabled="!isFormValid || formLogin.loading"
            >
                <span v-if="formLogin.loading">Loading...</span>
                <span v-else>Login</span>
            </button>
        </form>
    </div>
</template>