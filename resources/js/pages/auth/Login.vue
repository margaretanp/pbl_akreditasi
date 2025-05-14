<script setup>
import { reactive } from "vue"; // ✅ import reactive
import axios from "axios";
import { useRouter } from "vue-router"; // if you're using vue-router
import InputField from "../../components/InputField.vue"; // import your InputField component

const router = useRouter();

const form = reactive({
  email: "",
  password: "",
  loading: false
});

const onSubmit = async () => {
//   if (form.email.trim() !== "" || form.password.trim() !== "" || form.loading) return;

  form.loading = true;

  try {
    const response = await axios.post("/api/login", {
      email: form.email,
      password: form.password
    });

    const token = response.data.token;

    localStorage.setItem("auth_token", token);
    axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;

    router.push("/home");
  } catch (error) {
    console.error("Login failed:", error.response?.data || error.message);
  } finally {
    form.loading = false;
  }
};
</script>


<template>
    <div class="max-h-screen w-full flex">
        <div class="w-full p-20 flex flex-col items-center gap-y-8">
            <form class="flex flex-col gap-y-4" @submit.prevent="onSubmit">
                <InputField
                    label="Email"
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Masukkan Email"
                    v-model="form.email"
                />
                <InputField
                    label="Password"
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Masukkan Password"
                    v-model="form.password"
                />
                <button type="submit" class="bg-blue-500 p-4">Login</button>
            </form>
        </div>
        <!-- <img :src="bgLogin" alt="bg-login" class="" /> -->
    </div>
</template>
