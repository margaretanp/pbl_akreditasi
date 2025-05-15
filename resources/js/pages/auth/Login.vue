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
            "/login",
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
            const tokenData = {
                access_token: data.access_token,
                expires_at: data.expires_at,
            };

            authService.setTokens(tokenData);

            $toast.success("Login successful!");
            router.push("/dashboard");
        } else {
            throw new Error(data.message || "Login failed");
        }
    } catch (error) {
        console.error("Login error:", error);
        $toast.error(
            error.response?.data?.message || "Username or password is incorrect"
        );
    } finally {
        formLogin.loading = false;
    }
};
</script>

<template>
  <div class="h-screen bg-gray-100 flex items-center justify-center font-sans">
    <!-- Container with shadow and rounded corner -->
    <div class="flex w-full max-w-4xl h-[500px] rounded-lg shadow-lg overflow-hidden bg-white">
      
      <!-- Sign in section -->
      <div class="w-1/2 bg-white flex flex-col justify-center items-center px-12">
        <h1 class="text-3xl font-bold mb-4 text-blue-600 dark:text-sky-400">Sign in</h1>

        <form class="w-full max-w-sm flex flex-col gap-y-4" @submit.prevent="onSubmitLogin">

        <!-- Label Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <InputField
            id="email"
            label=""
            type="email"
            placeholder="Email"
            v-model="formLogin.email"
            />
        </div>

        <!-- Label Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <InputField
            id="password"
            label=""
            type="password"
            placeholder="Password"
            v-model="formLogin.password"
            />
        </div>

          <button
            type="submit"
            class="bg-blue-500 text-white py-2 rounded-full hover:bg-emerald-600 transition-colors font-semibold"
            :disabled="!isFormValid || formLogin.loading"
          >
            <span v-if="formLogin.loading">Loading...</span>
            <span v-else>Sign In</span>
          </button>
        </form>
      </div>

      <!-- Welcome section -->
      <div class="w-1/2 bg-gradient-to-r from-blue-400 to-blue-600 text-white flex flex-col justify-center items-center px-12">
        <h2 class="text-3xl font-bold mb-2 text-center">Halo, Teman!</h2>
        <p class="text-xl mb-6 text-center">Selamat Datang Website Akreditas</p>
      </div>
    </div>
  </div>
</template>