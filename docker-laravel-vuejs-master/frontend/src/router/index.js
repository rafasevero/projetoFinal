import { createRouter, createWebHistory } from 'vue-router';
import Login from '@/views/LoginView.vue';
import Register from '@/views/RegisterView.vue';
import RegisterUser from '@/components/RegisterUser.vue';
import HomeView from '../views/HomeView.vue';
import UserProfileView from '@/views/UserProfileView.vue';
import RecruiterRegisterView from '@/views/RecruiterRegisterView.vue';
import ApplicationView from '@/views/ApplicationView.vue';
import VacanciesRecruiterView from '@/views/VacanciesRecruiterView.vue';
import RecruiterProfileView from '@/views/RecruiterProfileView.vue';
import VacanciesUserView from '@/views/VacanciesUserView.vue';
import AvailableVacanciesView from '@/views/AvailableVacanciesView.vue';
import CreateVacancyView from '@/views/CreateVacancyView.vue';

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
        title: 'Vagas',
        requiresAuth: true
      }
    },
    {
      path: '/userProfile',
      name: 'userProfile',
      component: UserProfileView,
      meta: {
        title: 'Perfil do Usuário',
        requiresAuth: true
      }
    },
    {
      path: '/recruiterProfile',
      name: 'recruiterProfile',
      component: RecruiterProfileView,
      meta: {
        title: 'Perfil da Empresa',
        requiresAuth: true
      }
    },
    {
      path: '/application',
      name: 'application',
      component: ApplicationView,
      meta: {
        title: 'Minhas Candidaturas',
        requiresAuth: true
      }
    },
    {
      path: '/vacanciesRecruiter',
      name: 'vacanciesRecruiter',
      component: VacanciesRecruiterView,
      meta: {
        title: 'Minhas vagas',
        requiresAuth: true
      }
    },
    {
      path: '/availableVacancies',
      name: 'availableVacancies',
      component: AvailableVacanciesView,
      meta: {
        title: 'Minhas vagas',
        requiresAuth: true
      }
    },
    {
      path: '/createVacancy',
      name: 'createVacancy',
      component: CreateVacancyView,
      meta: {
        title: 'Criar vaga',
        requiresAuth: true
      }
    },
  ]
});


//proteção de rota
router.beforeEach((to, from, next) => {

  //muda o titulo
  document.title = to.meta.title;

  //autenticação
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // ve se tem o token de autenticação no localstorage
    const token = localStorage.getItem('authToken');
    
    
    if (!token) {
      next('/login');
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router;
