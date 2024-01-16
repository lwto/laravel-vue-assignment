import { createApp } from "vue";
import router from './router/index';
import AppComponent from './app.vue';
import CKEditor from '@ckeditor/ckeditor5-vue';

const app = createApp({
    components: {
        AppComponent
    }
});


app.use( CKEditor );
app.use(router);
app.mount('#app')
