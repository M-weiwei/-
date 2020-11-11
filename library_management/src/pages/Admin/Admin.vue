<template>
  <el-container class="admin-container">
    <el-header>
      <div>
        <a href="javascript:;"
           @click.prevent="myClick"><img src="" /></a>
        <span>图书后台管理系统</span>
      </div>
      <el-button type="info">退出</el-button>
    </el-header>
    <el-container>
      <el-aside :width="isCollapse ? '64px' : '200px'">
        <div class="toggle-button"
             @click="toggleCollapse">|||</div>
        <el-menu background-color="#333744"
                 text-color="#fff"
                 active-text-color="#409eff"
                 unique-opened
                 :collapse="isCollapse"
                 :collapse-transition="false"
                 router
                 @select="handleSelect"
                 :default-active='adminPath'>
          <el-submenu index="1">
            <template slot="title">
              <i class="iconfont icon-yonghu"></i>
              <span>用户</span>
            </template>
            <el-menu-item index="/admin/user">
              <i class="iconfont icon-yonghuguanli"></i>
              <span slot="title">用户管理</span>
            </el-menu-item>
            <el-menu-item index="/admin/userauthentication">
              <i class="iconfont icon-zhengshu"></i>
              <span slot="title">用户认证</span>
            </el-menu-item>
          </el-submenu>
          <el-submenu index="2">
            <template slot="title">
              <i class="iconfont icon-shu_1"></i>
              <span slot="title">书籍</span>
            </template>
            <el-menu-item index="/admin/addtobooks">
              <i class="iconfont icon-luru"></i>
              <span> 录入书籍</span>
            </el-menu-item>
            <el-menu-item index="/admin/urge">
              <i class="iconfont icon-cuicu"></i>
              <span> 催促还书</span>
            </el-menu-item>
            <el-menu-item index="/admin/destructionbooks">
              <i class="iconfont icon-tubiao-"></i>
              <span> 销毁书籍</span>
            </el-menu-item>
          </el-submenu>
          <el-submenu index="4">
            <template slot="title">
              <i class="iconfont icon-wodeshuping"></i>
              <span slot="title">书评</span>
            </template>
            <el-menu-item index="/admin/bookreview">
              <i class="iconfont icon-tianchongxing-"></i>
              <span> 书评管理</span>
            </el-menu-item>
          </el-submenu>
        </el-menu>
      </el-aside>
      <el-main>
        <router-view></router-view>
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
export default {
  data () {
    return {
      isCollapse: false,
      adminPath: ''
    }
  },
  methods: {
    toggleCollapse () {
      this.isCollapse = !this.isCollapse
    },
    handleSelect (index) {
      window.sessionStorage.setItem('adminPath', index)
      this.adminPath = index
    }
  },
  async created () {
    this.adminPath = window.sessionStorage.getItem('adminPath')
  }
}
</script>
<style lang="stylus" scoped>
.el-header
  background-color #373d41
  display flex
  justify-content space-between
  padding-left 0
  align-items center
  color #fff
  font-size 20px
  > div
    display flex
    align-items center
    span
      margin-left 15px
.el-aside
  background-color #333744
  .el-menu
    border-right none
.el-main
  background-color #eaedf1
.admin-container
  height 100%
.iconfont
  margin-right 10px
.toggle-button
  background-color #333744
  font-size 10px
  line-height 24px
  color #fff
  text-align center
  letter-spacing 0.2em
  cursor pointer
</style>
