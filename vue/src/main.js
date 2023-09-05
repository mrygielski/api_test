import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import 'devextreme/dist/css/dx.common.css'
import 'devextreme/dist/css/dx.light.css'
import { DxDataGrid } from 'devextreme-vue'

createApp(App).use(router).component('dx-data-grid', DxDataGrid).mount('#app');
