import './bootstrap';
import { createApp } from 'vue';
import Toaster from '@meforma/vue-toaster';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

const app = createApp({});
app.use(Toaster,{
    position: 'top'
});
app.use(VueSweetalert2);


import ChatComponent from './components/ChatComponent.vue';
import ModalComponent from './components/ModalComponent.vue';

app.component('chat-component', ChatComponent);
app.component('modal-component', ModalComponent);

app.mount('#app');
