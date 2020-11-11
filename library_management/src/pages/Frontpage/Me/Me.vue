<template>
  <div>
    <el-container class="me-container">
      <el-aside width="200px">
        <el-menu :default-active="activePath"
                 class="el-menu-vertical-demo"
                 router
                 @select="getindex"
                 unique-opened>
          <el-submenu index="1">
            <template slot="title">
              <i class="iconfont icon-ren"></i>
              <span>个人</span>
            </template>
            <el-menu-item index="/me/personalinfo"><i class="iconfont icon-gerenxinxi"></i>个人信息</el-menu-item>
            <el-menu-item index="/me/modifyonfo"><i class="el-icon-edit"></i>修改信息</el-menu-item>
            <el-menu-item index="/me/authentication"><i class="iconfont icon-zhengshu"></i>认证</el-menu-item>
            <el-menu-item index="/me/notice"><i class="iconfont icon-tongzhi"></i>用户通知</el-menu-item>
          </el-submenu>
          <el-submenu index="2">
            <template slot="title">
              <i class="iconfont icon-shenghuoyongpin-"></i>
              <span slot="title">书包</span>
            </template>
            <el-menu-item index="/me/borrow"><i class="iconfont icon-shu_1"></i>借阅书籍</el-menu-item>
            <el-menu-item index="/me/lineup"><i class="iconfont icon-paidui"></i>排队书籍</el-menu-item>
          </el-submenu>
        </el-menu>
      </el-aside>
      <el-main>
        <router-view></router-view>
      </el-main>
    </el-container>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data () {
    return {
      activePath: ''
    }
  },
  methods: {
    getindex (index) {
      window.sessionStorage.setItem('activesPath', index)
      this.activePath = index
    }
  },
  created () {
    const activePath = window.sessionStorage.getItem('activesPath')
    if (activePath === '') {
      this.activePath = '/me/personalinfo'
    } else {
      this.activePath = activePath
    }
    console.log(this.activePath)
    if (!this.userInfo.userId) {
      this.$router.push('/login')
    }
  },
  computed: {
    ...mapState(['userInfo'])
  }
}
</script>
<style lang="stylus" scoped>
.me-container
  height 700px
  width 1140px
  margin auto
  .el-menu
    height 100%
    i
      font-size 18px
      margin 0 5px
</style>
