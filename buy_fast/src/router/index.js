import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../components/login.vue'
import Admin from '../components/Admin.vue'
import Welcome from '../components/Welcome.vue'
import Users from '../components/user/Users.vue'
import Rights from '../components/power/Rights.vue'
import Roles from '../components/power/Roles.vue'
import Cate from '../components/goods/Cate.vue'
import Params from '../components/goods/Params.vue'
import GoodsList from '../components/goods/List.vue'
import Add from '../components/goods/Add.vue'
import Order from '../components/order/Order.vue'
import Report from '../components/report/Report.vue'
import Home from '../components/Home.vue'
import Store from '../components/store/Store.vue'
import Index from '../components/index.vue'
import Checkout from '../components/checkout/Checkout.vue'
import Product from '../components/product/Product.vue'

Vue.use(VueRouter)
const routes = [{
  path: '/',
  redirect: '/home'
}, {
  path: '/login',
  component: Login
}, {
  path: '/admin',
  component: Admin,
  redirect: '/welcome',
  children: [{
    path: '/welcome',
    component: Welcome
  }, {
    path: '/users',
    component: Users
  }, {
    path: '/rights',
    component: Rights
  }, {
    path: '/roles',
    component: Roles
  }, {
    path: '/categories',
    component: Cate
  }, {
    path: '/params',
    component: Params
  }, {
    path: '/goods',
    component: GoodsList
  }, {
    path: '/goods/add',
    component: Add
  }, {
    path: '/orders',
    component: Order
  }, {
    path: '/reports',
    component: Report
  }]
}, {
  path: '/home',
  component: Home,
  redirect: '/index',
  children: [{
    path: '/store',
    name: 'store',
    component: Store
  }, {
    path: '/index',
    component: Index
  }, {
    path: '/checkout',
    component: Checkout
  }, {
    path: '/product',
    component: Product
  }]
}]

const router = new VueRouter({
  routes
})
// 路由守卫
router.beforeEach((to, from, next) => {
  if (to.path === '/login') return next()
  const tokenStr = window.sessionStorage.getItem('token')
  if (!tokenStr) return next('/login')
  next()
})

export default router
