import type { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/login',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      {
        path: '',
        component: () => import('pages/LoginPage.vue')
      }
    ]
  },

  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    meta: { requiresAuth: true },
    children: [
      {
        path: '',
        component: () => import('pages/IndexPage.vue'),
      },
      {
        path: 'patients',
        component: () => import('pages/PatientsPage.vue'),
      },
      {
        path: 'patients/create',
        component: () => import('pages/PatientsCreatePage.vue'),
      },
      {
        path: 'patients/:id',
        component: () => import('pages/PatientsUpdatePage.vue'),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];

export default routes;
