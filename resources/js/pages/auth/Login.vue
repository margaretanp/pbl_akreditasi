<script setup>
import axios from "axios";
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import { useToast } from "vue-toast-notification";
import { authService } from "../../services/authService";
import InputField from "../../components/InputField.vue";
import { required, minLength, email } from "../../services/i18n-validators";
import { useVuelidate } from "@vuelidate/core";
import Button from "../../components/Button.vue";

const router = useRouter();

const $toast = useToast();

const togglePassword = ref(false);

const handleTogglePassword = () => {
    togglePassword.value = !togglePassword.value;
};

const loading = ref(false);

const loginForm = reactive({
    email: "",
    password: "",
});

const loginRules = {
    email: { required, email },
    password: { required, minLength: minLength(8) },
};

const v$ = useVuelidate(loginRules, loginForm, { $autoDirty: true });

const onLogin = async () => {
    try {
        loading.value = true;

        const { data } = await axios.post(
            "/login",
            {
                email: loginForm.email,
                password: loginForm.password,
            },
            {
                headers: {
                    Accept: "application/json",
                },
            }
        );

        if (data.status === "success") {
            authService.setTokens(data.data);
            router.push({ name: "Home" });

            $toast.success("login success!");
        } else {
            $toast.error("Login failed!");
        }
    } catch (error) {
        console.error(error.message);
        $toast.error("Invalid credentials!");
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <!-- Welcome section -->
    <div
        class="h-screen bg-gray-100 flex items-center justify-center font-sans"
    >
        <div
            class="flex w-full max-w-4xl h-[500px] rounded-lg shadow-lg overflow-hidden bg-white"
        >
            <!-- Sign in section -->
            <div
                class="w-1/2 bg-white flex flex-col justify-center items-center px-12"
            >
                <h1 class="text-3xl font-bold mb-4 text-[#021526]">Sign in</h1>

                <form
                    class="w-full max-w-sm flex flex-col gap-y-4"
                    @submit.prevent="onLogin"
                >
                    <!-- Email -->
                    <InputField
                        id="email"
                        label="Email"
                        type="email"
                        placeholder="Email"
                        v-model="loginForm.email"
                        @blur="v$.email.$touch()"
                        :isError="v$.email.$error"
                        :errors="v$.email.$errors"
                    />

                    <!-- Password -->
                    <InputField
                        id="password"
                        label="Password"
                        :type="togglePassword ? 'text' : 'password'"
                        placeholder="Password"
                        v-model="loginForm.password"
                        @onClickIcon="handleTogglePassword"
                        @blur="v$.password.$touch()"
                        :isError="v$.password.$error"
                        :errors="v$.password.$errors"
                    >
                        <template #icon>
                            <i
                                :class="
                                    togglePassword
                                        ? 'bi bi-eye-slash'
                                        : 'bi bi-eye'
                                "
                            ></i>
                        </template>
                    </InputField>

                    <!-- Submit Button -->
                    <Button
                        type="submit"
                        :disabled="loading"
                    >
                        <span v-if="loading">Loading...</span>
                        <span v-else>Sign In</span>
                    </Button>
                </form>
            </div>

            <!-- Welcome section -->
            <div
                class="w-1/2 bg-gradient-to-r from-[#03346E] to-[#021526] text-white flex flex-col justify-center items-center px-12"
            >
                <h2 class="text-3xl font-bold mb-2 text-center">
                    Halo, Teman!
                </h2>
                <p class="text-xl mb-6 text-center">
                    Selamat Datang di Website Akreditas
                </p>
            </div>
        </div>
    </div>
</template>
