import './bootstrap';
import { createApp } from 'vue';
import Toaster from '@meforma/vue-toaster';

const app = createApp({});
app.use(Toaster, {
    // One of the options
    position: 'top'
  });

import ChatComponent from './components/ChatComponent.vue';
app.component('chat-component', ChatComponent);
app.mount('#app');
