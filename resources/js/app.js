require('./bootstrap')

import { createApp } from 'vue'
import form from './components/Form'
import input from './components/Input'
import date from './components/Date'
import select from './components/Select'
import vue3DatepickerEsm from "vue3-datepicker";


const app = createApp({})

app.component('form-component', form)
    .component('input-component', input)
    .component('date-component', date)
    .component('select-component', select)
    .component('date-picker', vue3DatepickerEsm)
    .mount('#app')
