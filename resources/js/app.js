import "./bootstrap";

import { createApp } from "vue";
// import { i18n }         from './i18n'
// import axios from 'axios'
import { createI18n } from "vue-i18n";
import messages from "./i18n/messages";
import App from "./App.vue";
import router from "./router";
import ToastPlugin from "vue-toast-notification";
import "./services/axios";

const i18n = createI18n({
  legacy: false,
  locale: 'id',
  fallbackLocale: 'en',
  messages,
})

const changeLanguage = (event) => {
  i18n.global.locale.value = event.target.value
}


const app = createApp(App);

app.use(i18n)
app.use(router);
app.mount("#app");
app.use(ToastPlugin);


