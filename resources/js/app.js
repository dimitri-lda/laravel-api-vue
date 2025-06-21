import './bootstrap'
import '../css/style.css'
import '../css/app.css';
import { createApp } from 'vue'
import { createI18n } from 'vue-i18n'

import ShowApi from './ShowApi.vue'
import RacketList from './RacketList.vue'

import ru from './locales/ru.json'
import en from './locales/en.json'
import pl from './locales/pl.json'

const i18n = createI18n({
    locale: 'en',       // или динамически из пользователя
    fallbackLocale: 'en',
    messages: { ru, en, pl },
})

const showApiEl = document.getElementById('show-api')
if (showApiEl) {
    createApp(ShowApi).mount(showApiEl)
}

const racketListEl = document.getElementById('racket-list')
if (racketListEl) {
    createApp(RacketList).use(i18n).mount(racketListEl)
}
