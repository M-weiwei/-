<template>
  <div id="app"
       class="app">
    <!-- 头部导航区域 -->
    <NaviGation v-show="$route.meta.showBottomTabBar"></NaviGation>
    <router-view></router-view>
    <Footer v-show="$route.meta.showBottomTabBar"></Footer>
    <!-- 回到顶部控件 -->
    <el-backtop target=".app">
      <div>
        <i class='el-icon-top'></i>
      </div>
    </el-backtop>

  </div>
</template>

<script>
import NaviGation from './components/NaviGation/NaviGation'
import Footer from './components/FOOTER/Footer'
export default {
  name: 'app',
  components: {
    NaviGation,
    Footer
  }
}
</script>

<style lang='stylus' scoped></style>
