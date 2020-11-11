import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './../pages/Frontpage/Home/Home.vue'
import Product from './../pages/Frontpage/Product/Product.vue'
import Feedback from './../pages/Frontpage/Feedback/Feedback.vue'
import Login from './../pages/Frontpage/Login/Login.vue'
import Details from './../pages/Frontpage/Details/Details.vue'
import Me from './../pages/Frontpage/Me/Me.vue'
import PersonalInfo from './../pages/Frontpage/Me/Childern/PersonalInfo.vue'
import ModifyInfo from './../pages/Frontpage/Me/Childern/ModifyInfo.vue'
import Borrow from './../pages/Frontpage/Me/Childern/Borrow.vue'
import LineUp from './../pages/Frontpage/Me/Childern/LineUp.vue'
import Authentication from './../pages/Frontpage/Me/Childern/Authentication.vue'
import Notice from './../pages/Frontpage/Me/Childern/Notice.vue'
import Register from './../pages/Frontpage/Register/Register.vue'
import Admin from './../pages/Admin/Admin.vue'
import User from './../pages/Admin/User/User.vue'
import UserAuthentication from './../pages/Admin/UserAuthentication/UserAuthentication.vue'
import AddToBooks from './../pages/Admin/AddToBooks/AddToBooks.vue'
import Urge from './../pages/Admin/Urge/Urge.vue'
import DestructionBooks from './../pages/Admin/DestructionBooks/DestructionBooks.vue'
import BookReview from './../pages/Admin/BookReview/BookReview.vue'
import Search from './../pages/Frontpage/Search/Search.vue'
Vue.use(VueRouter)

const routes = [{
  path: '/home',
  name: 'About',
  component: Home,
  meta: {
    showBottomTabBar: true
  }
}, {
  path: '/',
  redirect: '/home',
  meta: {
    showBottomTabBar: true
  }
}, {
  path: '/register',
  component: Register,
  meta: {
    showBottomTabBar: true
  }
}, {
  path: '/product',
  component: Product,
  meta: {
    showBottomTabBar: true
  }
}, {
  path: '/feedback',
  component: Feedback,
  meta: {
    showBottomTabBar: true
  }
}, {
  path: '/login',
  component: Login,
  meta: {
    showBottomTabBar: true
  }
}, {
  path: '/search',
  component: Search,
  meta: {
    showBottomTabBar: true
  }
}, {
  path: '/details/:id',
  component: Details,
  props: true, // 传递参数

  meta: {
    showBottomTabBar: true
  }
}, {
  path: '/me',
  component: Me,
  children: [{
    path: 'personalinfo',
    component: PersonalInfo,
    meta: {
      showBottomTabBar: true
    }
  }, {
    path: 'modifyonfo',
    component: ModifyInfo,
    meta: {
      showBottomTabBar: true
    }
  }, {
    path: '/me',
    redirect: '/me/personalinfo'
  }, {
    path: 'borrow',
    component: Borrow,
    meta: {
      showBottomTabBar: true
    }
  }, {
    path: 'lineup',
    component: LineUp,
    meta: {
      showBottomTabBar: true
    }
  }, {
    path: 'authentication',
    component: Authentication,
    meta: {
      showBottomTabBar: true
    }
  }, {
    path: 'notice',
    component: Notice,
    meta: {
      showBottomTabBar: true
    }
  }]
}, {
  path: '/admin',
  component: Admin,
  children: [{
    path: 'user',
    component: User
  }, {
    path: 'userauthentication',
    component: UserAuthentication
  }, {
    path: 'addtobooks',
    component: AddToBooks
  }, {
    path: 'urge',
    component: Urge
  }, {
    path: 'destructionbooks',
    component: DestructionBooks
  }, {
    path: 'bookreview',
    component: BookReview
  }]
}]
// 解决重复点击报错
const originalPush = VueRouter.prototype.push
VueRouter.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err)
}
const router = new VueRouter({
  routes
})

export default router
