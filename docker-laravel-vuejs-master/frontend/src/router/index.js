import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import App from '@/App.vue';
import VagasView from '@/views/VagasView.vue';
import PerfilView from '@/views/PerfilView.vue';
import ApplicationView from '@/views/ApplicationView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
      meta: {
        title: 'Home'
      }
    },
    {
      path: '/vagas',
      name: 'vagas',
      component: VagasView,
      meta: {
        title: 'Vagas'
      }
    },
    {
      path: '/perfil',
      name: 'perfil',
      component: PerfilView,
      meta: {
        title: 'Perfil'
      }
    },
    {
      path: '/application',
      name: 'application',
      component: ApplicationView,
      meta: {
        title: 'Application'
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
