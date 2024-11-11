import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/LoginView.vue';
import Register from '@/views/RegisterView.vue';
import RegisterUser from '@/components/RegisterUser.vue';
import HomeView from '../views/HomeView.vue'
import App from '@/App.vue';
import UserProfileView from '@/views/UserProfileView.vue';
import RecruiterRegisterView from '@/views/RecruiterRegisterView.vue';
import ApplicationView from '@/views/ApplicationView.vue';
import VacanciesRecruiterView from '@/views/VacanciesRecruiterView.vue';
import RecruiterProfileView from '@/views/RecruiterProfileView.vue';
import VacanciesUserView from '@/views/VacanciesUserView.vue';
import AvailableVacanciesView from '@/views/AvailableVacanciesView.vue';

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
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        title: 'Registrar'
      }
    },
    {
      path: '/recruiterRegister',
      name: 'recruiterRegister',
      component: RecruiterRegisterView,
      meta: {
        title: 'Registrar Empresa'
      }
    },
    {
      path: '/vacanciesUser',
      name: 'VacanciesUser',
      component: VacanciesUserView,
      meta: {
        title: 'Vagas'
      }
    },
    {
      path: '/userProfile',
      name: 'userProfile',
      component: UserProfileView,
      meta: {
        title: 'Perfil do Usuário'
      }
    },
    {
      path: '/recruiterProfile',
      name: 'recruiterProfile',
      component: RecruiterProfileView,
      meta: {
        title: 'Perfil da Empresa'
      }
    },
    {
      path: '/application',
      name: 'application',
      component: ApplicationView,
      meta: {
        title: 'Minhas Candidaturas'
      }
    },
    {
      path: '/vacanciesRecruiter',
      name: 'vacanciesRecruiter',
      component: VacanciesRecruiterView,
      meta: {
        title: 'Minhas vagas'
      }
    },
    {
      path: '/availableVacancies',
      name: 'availableVacancies',
      component: AvailableVacanciesView,
      meta: {
        title: 'Minhas vagas'
      }
    },
  ]
})

router.beforeEach((to, from, next) => {
  document.title = to.meta.title;
  next();
});

export default router
