import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
axios.defaults.baseURL = '/demo'
Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    userInfo: {}, // 用户信息
    hotList: [], // 热门推荐序列表
    searchList: [] // 搜索列表
  },
  mutations: {
    ReqUserInfo(state, userInfo) {
      state.userInfo = userInfo
    },
    ReqHotList(state, hotList) {
      state.hotList = hotList
    },
    ReqSearchList(state, searchList) {
      state.searchList = searchList
    }
  },
  actions: {
    async GetUserInfo(
      context,
      loginform
    ) {
      console.log(loginform)
      const {
        data: res
      } = await axios.get('demo/interfaces/login.php', {
        params: {
          username: loginform.username,
          password: loginform.password
        }
      })
      console.log(res)
      context.commit('ReqUserInfo', res)
    },
    // 请求热门
    async GetHotList(context) {
      const {
        data: res
      } = await axios.get('demo/interfaces/hot.php')
      console.log(res)

      context.commit('ReqHotList', res)
    },
    // 请求搜索
    async GetSearchList(context, search) {
      if (search.type === '1') {
        const {
          data: res
        } = await axios.get('demo/interfaces/search.php', {
          params: {
            type: search.type,
            book: search.searchText
          }
        })
        console.log(res)
        context.commit('ReqSearchList', res)
      } else if (search.type === '2') {
        const {
          data: res
        } = await axios.get('demo/interfaces/search.php', {
          params: {
            type: search.type,
            book: search.searchText
          },
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
          }
        })
        console.log(res)

        context.commit('ReqSearchList', res)
      }
    }
  },
  modules: {}
})
