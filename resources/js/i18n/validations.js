import { createI18n } from "vue-i18n";

const messages = {
  en: {
    validations: {
      required: "This field is required.",
      alpha: "This field may only contain alphabetic characters.",
      alphaNum: "This field may only contain alphanumeric characters.",
      numeric: "This field must be a numeric value.",
      between: "This field must be between {min} and {max}.",
      email: "This field must be a valid email.",
      ipAddress: "This field must be a valid IP address.",
      macAddress: "This field must be a valid MAC address.",
      maxLength: "This field must be no longer than {max} characters.",
      minLength: "This field must be at least {min} characters.",
      maxValue: "This field must be {max} or less.",
      minValue: "This field must be {min} or more.",
      not: "This field has an invalid value.",
      or: "This field must satisfy at least one of the provided conditions.",
      and: "This field must satisfy all the provided conditions.",
      requiredIf: "This field is required because {prop} is set.",
      requiredUnless: "This field is required unless {prop} is set.",
      sameAs: "This field must match {eq}.",
      url: "This field must be a valid URL.",
      integer: "This field must be an integer.",
      decimal: "This field must be a decimal number.",
    },
  },
  id: {
    validations: {
      required: "Kolom ini wajib diisi.",
      alpha: "Kolom ini hanya boleh berisi huruf alfabet.",
      alphaNum: "Kolom ini hanya boleh berisi huruf dan angka.",
      numeric: "Kolom ini harus berupa angka.",
      between: "Kolom ini harus antara {min} dan {max}.",
      email: "Kolom ini harus berupa email yang valid.",
      ipAddress: "Kolom ini harus berupa alamat IP yang valid.",
      macAddress: "Kolom ini harus berupa alamat MAC yang valid.",
      maxLength: "Kolom ini tidak boleh lebih dari {max} karakter.",
      minLength: "Kolom ini harus minimal {min} karakter.",
      maxValue: "Kolom ini harus {max} atau kurang.",
      minValue: "Kolom ini harus {min} atau lebih.",
      not: "Kolom ini memiliki nilai yang tidak valid.",
      or: "Kolom ini harus memenuhi setidaknya salah satu kondisi yang diberikan.",
      and: "Kolom ini harus memenuhi semua kondisi yang diberikan.",
      requiredIf: "Kolom ini wajib diisi karena {prop} telah diatur.",
      requiredUnless: "Kolom ini wajib diisi kecuali {prop} telah diatur.",
      sameAs: "Kolom ini harus sama dengan {eq}.",
      url: "Kolom ini harus berupa URL yang valid.",
      integer: "Kolom ini harus berupa bilangan bulat.",
      decimal: "Kolom ini harus berupa angka desimal.",
      password:
        "Kolom ini harus berupa kombinasi huruf besar, kecil dan angka dengan minimal 8 karakter.",
      isUsernameAvailable: "Username sudah digunakan",
    },
  },
};

export const i18n = createI18n({
  legacy: false,
  locale: "id",
  fallbackLocale: "en",
  messages,
});