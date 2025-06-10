// Bootstrap file: untuk konfigurasi awal Axios dan CSRF token
import "./bootstrap";

// Vue Core
import { createApp } from "vue";
import App from "./App.vue";

// Vue Router
import router from "./router";

// Vue I18n (multi bahasa)
import { createI18n } from "vue-i18n";
import messages from "./i18n/messages";

// Toast Notification
import ToastPlugin from "vue-toast-notification";

// Axios service (interceptor dll.)
import "./services/axios";
import { createPinia } from "pinia";

// Konfigurasi i18n
const i18n = createI18n({
  legacy: false, // Mengaktifkan Composition API
  locale: 'id', // Bahasa default
  fallbackLocale: 'en', // Bahasa fallback jika terjemahan tidak ditemukan
  messages,
  globalInjection: true // Agar `$t` bisa digunakan langsung
});

// Buat instance Vue app
const app = createApp(App);
const pinia = createPinia();

// Pasang plugin-plugin Vue ke app instance
app.use(pinia);
app.use(i18n);
app.use(router);
app.use(ToastPlugin);

// Mount Vue ke #app (di file app.blade.php)
app.mount('#app');
