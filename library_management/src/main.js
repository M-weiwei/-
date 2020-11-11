import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './plugins/element.js'
import './assets/font/iconfont.css'
import './assets/css/admin/global.css'
import VueQuillEditor from 'vue-quill-editor'
import 'quill/dist/quill.core.css' // import styles
import 'quill/dist/quill.snow.css' // for snow theme
import 'quill/dist/quill.bubble.css' // for bubble theme
import axios from 'axios'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'

axios.defaults.withCredentials = true
axios.defaults.baseURL = '/demo'

Vue.prototype.$http = axios // 将ajax请求挂在到vue原形上
axios.interceptors.request.use(config => {
  NProgress.start()
  config.headers.Authorization = window.sessionStorage.getItem('token')
  return config
})
Vue.filter('bookname', function (originVal) {
  return originVal.substring(1, originVal.length - 1)
})
Vue.filter('text', function (originVal) {
  if (originVal.length > 20) {
    return originVal.substring(0, 28) + '...'
  } else if (originVal.length < 30) {
    return originVal
  }
})
axios.interceptors.response.use(config => {
  NProgress.done()
  return config
})
Vue.config.productionTip = false
Vue.use(VueQuillEditor)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
