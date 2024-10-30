import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

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
      path: '/login',
      name: 'login',
      component: HomeView,
      meta: {
        title: 'Login'
      }
    },
    {
      path: '/registro',
      name: 'registro',
      component: HomeView,
      meta: {
        title: 'Registro'
      }
    },
    {
      path: '/contato',
      name: 'contato',
      component: HomeView,
      meta: {
        title: 'Contato'
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
