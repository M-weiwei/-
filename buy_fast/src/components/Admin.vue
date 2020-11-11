<template>
  <el-container class="admin-container">
    <el-header>
      <div><a href="javascript:;"
           @click.prevent="myClick"><img src="../assets/image/logo/logo.png"></a> <span>极速购后台管理系统</span></div>
      <el-button type='info'
                 @click="logout">退出</el-button>
    </el-header>
    <el-container>
      <!-- 侧边栏菜单 -->
      <el-aside :width="isCollapse?'64px':'200px'">
        <div class="toggle-button"
             @click="toggleCollapse">|||</div>
        <!-- 侧边菜单区域 -->
        <el-menu background-color="#333744"
                 text-color="#fff"
                 active-text-color="#409eff"
                 unique-opened
                 :collapse='isCollapse'
                 :collapse-transition='false'
                 router
                 :default-active='activePath'>
          <!-- 一级菜单区域 -->
          <el-submenu :index="item.id+''"
                      v-for="item in menuList"
                      :key="item.id">
            <!-- 一级菜单模板区域 -->
            <template slot="title">
              <!-- 图标 -->
              <i :class="iconObj[item.id]"></i>
              <!-- 文本 -->
              <span>{{item.authName}}</span>
            </template>
            <!-- 二级菜单 -->
            <el-menu-item :index="'/'+subItem.path"
                          v-for="subItem in item.children"
                          :key="subItem.id"
                          @click="saveNavState('/'+subItem.path)">
              <template slot="title">
                <!-- 图标 -->
                <i class="el-icon-menu"></i>
                <!-- 文本 -->
                <span>{{subItem.authName}}</span>
              </template>
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
      menuList: [],
      iconObj: {
        125: 'iconfont icon-users',
        103: 'iconfont icon-tijikongjian',
        101: 'iconfont icon-shangpin',
        102: 'iconfont icon-danju',
        145: 'iconfont icon-baobiao'
      },
      isCollapse: false,
      activePath: ''
    }
  },
  created () { // 生命周期函数刚开始发送请求时触发
    this.getMenuList()
    // 页面一进入获取存在session的值让对应的菜单处于高亮状态git
    this.activePath = window.sessionStorage.getItem('activePath')
  },
  methods: {
    logout () {
      // 清空token
      window.sessionStorage.clear()
      this.$router.push('/login')
    },
    async getMenuList () {
      const { data: res } = await this.$http.get('menus')
      if (res.meta.status !== 200) return this.$message.error(res.meta.message)
      this.menuList = res.data
    },
    toggleCollapse () {
      this.isCollapse = !this.isCollapse
    },
    saveNavState (activePath) {
      // 点击菜单时将地址保存到seession中
      window.sessionStorage.setItem('activePath', activePath)
      this.activePath = activePath
    },
    myClick () {
      this.$router.push('/home')
    }
  }
}
</script>
<style lang="less" scoped>
.el-header {
  background-color: #373d41;
  display: flex;
  justify-content: space-between;
  padding-left: 0;
  align-items: center;
  color: #fff;
  font-size: 20px;
  > div {
    display: flex;
    align-items: center; //
    span {
      margin-left: 15px;
    }
  }
}
.el-aside {
  background-color: #333744;
  .el-menu {
    border-right: none;
  }
}
.el-main {
  background-color: #eaedf1;
}
.admin-container {
  height: 100%;
}
.iconfont {
  margin-right: 10px;
}
.toggle-button {
  background-color: #333744;
  font-size: 10px;
  line-height: 24px;
  color: #fff;
  text-align: center;
  letter-spacing: 0.2em;
  cursor: pointer;
}
</style>
