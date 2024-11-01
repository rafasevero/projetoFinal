import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/LoginView.vue';
import Register from '@/views/RegisterView.vue';
import HomeView from '@/views/HomeView.vue';
import RegisterUser from '@/components/RegisterUser.vue';

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
      component: Login,
      meta: {
        title: 'Login'
      }
    },
    {
      path: '/registerUser',
      name: 'registerUser',
      component: RegisterUser,
      meta: {
        title: 'Cadastro Candidato'
      }
    },
    {
      path:'/register',
      name:'register',
      component:Register,
      meta:{
        title:'Registro'
      }
    },
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
