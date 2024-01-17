import { createApp } from "vue";
import router from './router/index';
import AppComponent from './app.vue';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ViewUIPlus from 'view-ui-plus'
import 'view-ui-plus/dist/styles/viewuiplus.css'


const app = createApp({
    components: {
        AppComponent
    }
});


app.use( CKEditor );
app.use (ViewUIPlus);
app.use(router);
app.mount('#app')
