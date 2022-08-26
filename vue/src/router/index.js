import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import Fanarts from "../views/Fanarts.vue";
import FanartView from "../views/FanartView.vue";
import Evaluations from "../views/Evaluations.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import DefaultLayout from  "../components/DefaultLayout.vue";
import AuthLayout from  "../components/AuthLayout.vue";
import NotFound from "../views/NotFound.vue";
import store from "../store";

import ShowMe from "../views/users/ShowMe.vue";

const routes = [
  {
    path: '/',
    redirect: '/dashboard',
    component: DefaultLayout,
    meta: { requiresAuth: true },
    children: [
      {path: '/dashboard' , name: 'Dashboard', component: Dashboard},
      {path: '/fanarts' , name: 'Fanarts', component: Fanarts},
      {path: '/fanarts/create' , name: 'FanartCreate', component: FanartView},
      {path: '/fanarts/:id' , name: 'FanartView', component: FanartView},
      {path: '/evaluations' , name: 'Evaluations', component: Evaluations},
      {path: '/user/show/:id' , name: 'ShowMe', component: ShowMe}
    ]
  },

  {
    path: '/auth',
    redirect: '/login',
    name: 'Auth',
    component: AuthLayout,
    meta: {isGuest: true},
    children: [
      {
        path: '/login',
        name: 'Login',
        component: Login
      },
      {
        path: '/register',
        name: 'Register',
        component: Register
      },
    ]
  },
  {
    path: '/404',
    name: 'NotFound',
    component: NotFound
  }

];

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: 'Login' });
  } else if (store.state.user.token &&  (to.meta.isGuest)) {
    next({ name: 'Dashboard' });
  } else {
    next();
  }
});


export default router;
