import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import ChatComponent from './components/ChatComponent.vue';
app.component('chat-component', ChatComponent);
app.mount('#app');
