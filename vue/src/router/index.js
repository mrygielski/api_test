import { createRouter, createWebHistory } from 'vue-router';
import ViewList from '../components/ViewList.vue';
import ViewAdd from '../components/ViewAdd.vue';
import ViewGet from '../components/ViewGet.vue';

const routes = [
  {
    path: '/viewList',
    name: 'ViewList',
    component: ViewList,
  },
  {
    path: '/viewAdd',
    name: 'ViewAdd',
    component: ViewAdd,
  },
  {
    path: '/viewGet',
    name: 'ViewGet',
    component: ViewGet,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
