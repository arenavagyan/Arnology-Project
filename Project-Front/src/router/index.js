import {createRouter,createWebHistory} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Registration from '@/views/RegistrationPage.vue'
import MainPage from '@/views/MainPage.vue'
import {useAuthStore} from '@/stores/authStore'
import EditProfile from '@/views/EditProfile.vue'

const router = createRouter({
  history: createWebHistory(
    import.meta.env.BASE_URL),
  routes: [{
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/register',
      name: 'registration',
      component: Registration
    },

    {
      path: '/member/mainPage',
      name: 'mainPage',
      component: MainPage,
      meta: {
        requiresAuth: true
      }
    },

    {
      path: '/editProfile',
      name: 'editProfile',
      component: EditProfile,
    }

    // {
    //   path: '/about',
    //   name: 'about',
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import('../../views/AboutView.vue')
    // }
  ]
})

/*
router.beforeEach((to, from, next) => {
  
  
  if (!authStore.isLoggedIn) {
    next('/mainPage') // Redirect to login page if not authenticated
    } else {
      next() // Allow access to the protected page
  }
  
  })
  */
 router.beforeEach((to, from, next) => {
  const authStore = useAuthStore()
  if (to.meta.requiresAuth && !authStore.isLoggedIn()) {
    throw new Error('Please Login')
  } else {
    next()
  }
})

export default router