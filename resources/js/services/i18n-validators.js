import * as validators from "@vuelidate/validators";
import { i18n } from "../i18n/validations";
import axios from "axios";

const { createI18nMessage } = validators;
const withI18nMessage = createI18nMessage({ t: i18n.global.t.bind(i18n) });

export const required = withI18nMessage(validators.required);
export const alpha = withI18nMessage(validators.alpha);
export const alphaNum = withI18nMessage(validators.alphaNum);
export const numeric = withI18nMessage(validators.numeric);
export const between = withI18nMessage(validators.between, {
    withArguments: true,
});
export const email = withI18nMessage(validators.email);
export const ipAddress = withI18nMessage(validators.ipAddress);
export const macAddress = withI18nMessage(validators.macAddress, {
    withArguments: true,
});
export const maxLength = withI18nMessage(validators.maxLength, {
    withArguments: true,
});
export const minLength = withI18nMessage(validators.minLength, {
    withArguments: true,
});
export const maxValue = withI18nMessage(validators.maxValue, {
    withArguments: true,
});
export const minValue = withI18nMessage(validators.minValue, {
    withArguments: true,
});
export const not = withI18nMessage(validators.not, { withArguments: true });
export const or = withI18nMessage(validators.or, { withArguments: true });
export const and = withI18nMessage(validators.and, { withArguments: true });
export const requiredIf = withI18nMessage(validators.requiredIf, {
    withArguments: true,
});
export const requiredUnless = withI18nMessage(validators.requiredUnless, {
    withArguments: true,
});
export const sameAs = withI18nMessage(validators.sameAs, {
    withArguments: true,
});
export const url = withI18nMessage(validators.url);
export const integer = withI18nMessage(validators.integer);
export const decimal = withI18nMessage(validators.decimal);

// custom validators
export const password = withI18nMessage((value) => {
    return /^(?=.\d)(?=.[a-z])(?=.[A-Z])(?=.[a-zA-Z]).{8,}/.test(value);
});

// check username is exist
export const isUsernameAvailable = (getExceptId) =>
    withI18nMessage(
        validators.helpers.withAsync(async (value) => {
            if (!value) return false;

            const exceptId =
                typeof getExceptId === "function" ? getExceptId() : null;

            try {
                const { data } = await axios.get(
                    `/check-username?username=${value}&except_id=${
                        exceptId || null
                    }`
                );
                return !data.data.is_exist;
            } catch (error) {
                console.error(error);
                return false;
            }
        })
    );