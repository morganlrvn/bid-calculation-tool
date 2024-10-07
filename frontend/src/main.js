import { createApp } from 'vue'
import router from './router'
import BidPrice from './components/BidPrice.vue'
import axios from 'axios';

// Set the default base URL for Axios requests
axios.defaults.baseURL = 'http://localhost:8000';


import { createVuetify } from 'vuetify';
import 'vuetify/styles'; // Importer les styles de Vuetify
import '@mdi/font/css/materialdesignicons.css'; // Importer les icônes Material Design

// Create an instance of Vuetify to enable its features and components
const vuetify = createVuetify();

// Create a new Vue application, use the router and Vuetify, and mount it to the HTML element with the id 'app'
createApp(BidPrice).use(router).use(vuetify).mount('#app'); 