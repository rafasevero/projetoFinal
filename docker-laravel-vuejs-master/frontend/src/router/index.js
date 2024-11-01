import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/LoginView.vue';
import Register from '@/views/RegisterView.vue';
import HomeView from '@/views/HomeView.vue';
import RegisterUser from '@/components/RegisterUser.vue';
import HomeView from '../views/HomeView.vue'
import App from '@/App.vue';
import VagasView from '@/views/VagasView.vue';
import PerfilView from '@/views/PerfilView.vue';
import ApplicationView from '@/views/ApplicationView.vue';
import HomeView from '@/views/HomeView.vue';
import RegisterEmpresaVIew from '@/views/RegisterEmpresaVIew.vue';

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
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        title: 'Cadastro'
      }
    },
    {
      path: '/registerEmpresa',
      name: 'registerEmpresa',
      component: RegisterEmpresaVIew,
      meta: {
        title: 'Registrar Empresa'
      }
    },
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
