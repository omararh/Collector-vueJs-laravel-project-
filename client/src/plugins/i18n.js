import { createI18n } from 'vue-i18n'
import en from './locales/en.json'
import fr from './locales/fr.json'

export default createI18n({
    locale: window.navigator.language,
    fallbackLocale: `fr`,
    messages: { en, fr, 'en-US': en, 'fr-FR': fr, 'fr-fr': fr }
})