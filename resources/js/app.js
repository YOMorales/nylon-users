import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
import UserCreate from './components/UserCreate.vue';


// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { aliases, mdi } from 'vuetify/iconsets/mdi-svg'

const vuetify = createVuetify({
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
          mdi,
        },
      },
})


const app = createApp({});
app.component('user-create', UserCreate);
app.use(vuetify);
app.mount('#vue_container');
