<template>
  <el-container>
    <!-- 头部 -->
    <div class="header">
      <el-row>
        <!-- logo图部分 -->
        <el-col :span="6"
                class="logo">
          <div>logo</div>
        </el-col>
        <el-col :span="18">
          <div class="header_right">
            <!-- 搜索框 -->
            <div class="search">
              <el-input placeholder="请输入内容"
                        v-model="searchText">
                <el-select v-model="select"
                           slot="prepend"
                           @change="searchType"
                           placeholder="搜索方式">
                  <el-option label="书名搜索"
                             value="1"></el-option>
                  <el-option label="书号搜索"
                             value="2"></el-option>
                </el-select>
                <el-button slot="append"
                           icon="el-icon-search"
                           @click.prevent='search'></el-button>
              </el-input>
            </div>
            <div class="head_menu">
              <!-- 导航 -->
              <el-menu :default-active="activeIndex"
                       class="el-menu-demo"
                       mode="horizontal"
                       @select="handleSelect"
                       router
                       active-text-color='#00b3fe'>
                <el-menu-item index="/home">首页</el-menu-item>
                <el-menu-item index="/product">书籍分类</el-menu-item>
                <el-menu-item index="/feedback">用户反馈</el-menu-item>
                <el-menu-item index="/me">我的</el-menu-item>
              </el-menu>
              <!-- 登录注册 -->
              <a href=""
                 @click.prevent="login()"
                 v-if="!userinfo.userId"><span>登录/注册</span></a>
              <a href=""
                 v-else
                 @click.prevent="gotome()"><span>欢迎您，{{userinfo.userName}}</span></a>
            </div>
          </div>
        </el-col>
      </el-row>
    </div>

  </el-container>

</template>

<script>

export default {
  data () {
    return {
      activeIndex: '',
      select: '1',
      type: '1', // 选择搜索类型
      searchText: ''
    }
  },
  created () {
    const activeIndex = window.sessionStorage.getItem('activePath')
    console.log(activeIndex)
    if (activeIndex === null) {
      this.activeIndex = '/home'
    } else {
      this.activeIndex = activeIndex
    }
  },
  methods: {
    handleSelect (index) {
      window.sessionStorage.setItem('activePath', index)
      window.sessionStorage.setItem('activesPath', '')
      this.activeIndex = index
    },
    login () {
      this.activeIndex = ''
      this.$router.push('/login')
    },
    gotome () {
      this.activeIndex = '/me'
      this.$router.push('/me')
    },
    searchType (value) {
      this.type = value
      console.log(this.type)
    },
    // 点击按钮搜索
    async search () {
      // 按书名搜索
      this.$store.dispatch('GetSearchList', { type: this.type, searchText: this.searchText })
      this.$router.push('/search')
      this.activeIndex = ''
    }
  },
  mounted () {
    const activeIndex = window.sessionStorage.getItem('activePath')
    this.activeIndex = activeIndex
  },

  computed: {
    userinfo: function () {
      return this.$store.state.userInfo
    }
  },
  //   watch: {
  //     userinfo () {
  //       this.$set(this.userinfo, this.userinfo, this.$store.state.userInfo)
  //     }
  //   },

}

</script>
<style lang='stylus' scoped>
.header
  width 1140px
  margin auto
  height 134.5px
  .el-row
    height 100%
    display flex
    align-items center
    .logo
      display flex
      justify-content center
      align-items center
    .el-menu.el-menu--horizontal
      border none
    .head_menu
      display flex
      align-items center
      justify-content space-between
      a
        text-decoration none
        color #636569
.el-select
  width 120px
</style>
