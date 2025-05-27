import "./bootstrap";

import { createApp } from "vue";
import { createI18n } from "vue-i18n";
import App from "./App.vue";
import router from "./router";
import ToastPlugin from "vue-toast-notification";
import "./services/axios";

import messages from "./i18n/messages"; // Make sure this imports both languages

const i18n = createI18n({
  legacy: false,
  locale: 'id',
  fallbackLocale: 'en',
  messages,
  globalInjection: true,
})

const app = createApp(App);

app.use(i18n);
app.use(router);
app.use(ToastPlugin);
app.mount('#app');