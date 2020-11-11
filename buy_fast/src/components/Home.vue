<template>
  <div>
    <div id="top-header">
      <div class="container">
        <ul class="header-links pull-left">
          <li><a href="#"><i class="fa fa-phone"></i> +176-8372-8756</a></li>
          <li><a href="#"><i class="fa fa-envelope-o"></i> 邮箱： 1095725482@qq.com</a></li>
          <li><a href="#"
               id='map'><i class="fa fa-map-marker"></i> 武汉纺织大学外经贸</a></li>
        </ul>
        <ul class="header-links pull-right">

          <li><a href=""
               @click.prevent="myClick"><i class="fa fa-user-o"></i> {{username}}</a></li>
        </ul>
      </div>
    </div>
    <!-- /TOP HEADER -->
    <!-- MAIN HEADER -->
    <div id="header">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">
          <!-- LOGO -->
          <div class="col-md-3">
            <div class="header-logo">
              <a href="/home/"
                 class="logo">
                <img src="../assets/image/logo/logo.png"
                     alt="">
              </a>
            </div>
          </div>
          <!-- /LOGO -->

          <!-- SEARCH BAR -->
          <div class="col-md-6">
            <div class="header-search">
              <form>
                <select class="input-select">
                  <option value="0">所有类别</option>
                  <option value="1">类别 01</option>
                  <option value="1">类别 02</option>
                </select>
                <input class="input"
                       placeholder="在这里搜索"
                       v-model="value"
                       @keyup.enter="searchGood">
                <button class="search-btn"
                        @click="searchGood">搜索</button>
              </form>
            </div>
          </div>
          <!-- /SEARCH BAR -->

          <!-- ACCOUNT -->
          <div class="col-md-3 clearfix">
            <div class="header-ctn">
              <!-- Wishlist -->
              <div>
                <a href="javascript:;"
                   @click.prevent="myCheckout">
                  <i class="fa fa-heart-o"></i>
                  <span>您的订单</span>
                  <div class="qty">2</div>
                </a>
              </div>
              <!-- /Wishlist -->

              <!-- Cart -->
              <div class="dropdown">
                <a class="dropdown-toggle"
                   data-toggle="dropdown"
                   aria-expanded="true">
                  <i class="fa fa-shopping-cart"></i>
                  <span>您的购物车</span>
                  <div class="qty">3</div>
                </a>
                <div class="cart-dropdown">
                  <div class="cart-list">
                    <div class="product-widget">
                      <div class="product-img">
                        <img src="../assets/image/product01.png"
                             alt="">
                      </div>
                      <div class="product-body">
                        <h3 class="product-name"><a href="#">15.6英寸全面屏笔记本电脑</a></h3>
                        <h4 class="product-price"><span class="qty">1x</span>$566.00</h4>
                      </div>
                      <button class="delete"><i class="fa fa-close"></i></button>
                    </div>

                    <div class="product-widget">
                      <div class="product-img">
                        <img src="../assets/image/product02.png"
                             alt="">
                      </div>
                      <div class="product-body">
                        <h3 class="product-name"><a href="#">耳机有线带麦高音质</a></h3>
                        <h4 class="product-price"><span class="qty">3x</span>$388.00</h4>
                      </div>
                      <button class="delete"><i class="fa fa-close"></i></button>
                    </div>
                  </div>
                  <div class="cart-summary">

                    <h5>总价L: $1730.00</h5>
                  </div>
                  <div class="cart-btns">
                    <a href="#">清空购物车</a>
                    <a href="#">去下订单 <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
              <!-- /Cart -->

              <!-- Menu Toogle -->
              <div class="menu-toggle">
                <a href="#">
                  <i class="fa fa-bars"></i>
                  <span>Menu</span>
                </a>
              </div>
              <!-- /Menu Toogle -->
            </div>
          </div>
          <!-- /ACCOUNT -->
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <div class="navbox">
      <div class="container">
        <el-menu :default-active="activePath"
                 class="el-menu-demo"
                 mode="horizontal"
                 active-text-color='#d10024'
                 text-color='#2b2d42'
                 router>
          <el-menu-item :index="'/'+i"
                        v-for="(item,i) in navList"
                        :key="i"
                        @click="saveNavState('/'+i)">{{item}}</el-menu-item>
        </el-menu>
      </div>
    </div>
    <router-view></router-view>
    <div id="newsletter"
         class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">
          <div class="col-md-12">
            <div class="newsletter">
              <p>订阅 <strong>新闻通讯</strong></p>
              <form>
                <input class="input"
                       type="email"
                       placeholder="输入您的邮箱">
                <button class="newsletter-btn"><i class="fa fa-envelope"></i> 订阅</button>
              </form>
              <ul class="newsletter-follow">
                <li>
                  <a href="#"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-instagram"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-pinterest"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <footer id="footer">
      <!-- top footer -->
      <div class="section">
        <!-- container -->
        <div class="container">
          <!-- row -->
          <div class="row">
            <div class="col-md-3 col-xs-6">
              <div class="footer">
                <h3 class="footer-title">关于我们</h3>
                <p>本站提供最新产品，顺丰速发，拒绝盗版
                  网站归个人所有，请勿盗取模仿，违者必究。
                </p>
                <ul class="footer-links">
                  <li><a href="#"><i class="fa fa-map-marker"></i>武汉纺织大学外经贸</a></li>
                  <li><a href="#"><i class="fa fa-phone"></i>+176-8372-8756</a></li>
                  <li><a href="#"><i class="fa fa-envelope-o"></i>邮箱：1095725482@qq.com</a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-3 col-xs-6">
              <div class="footer">
                <h3 class="footer-title">分类目录</h3>
                <ul class="footer-links">
                  <li><a href="#">热卖</a></li>
                  <li><a href="#">手提电脑</a></li>
                  <li><a href="#">智能手机</a></li>
                  <li><a href="#">摄像机</a></li>
                  <li><a href="#">配饰</a></li>
                </ul>
              </div>
            </div>

            <div class="clearfix visible-xs"></div>

            <div class="col-md-3 col-xs-6">
              <div class="footer">
                <h3 class="footer-title">信息</h3>
                <ul class="footer-links">
                  <li><a href="#">关于我们</a></li>
                  <li><a href="#">联系我们</a></li>
                  <li><a href="#">隐私政策</a></li>
                  <li><a href="#">订单与退货</a></li>
                  <li><a href="#">条款声明</a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-3 col-xs-6">
              <div class="footer">
                <h3 class="footer-title">服务</h3>
                <ul class="footer-links">
                  <li><a href="#">我的账户</a></li>
                  <li><a href="#">查看购物车</a></li>
                  <li><a href="#">心愿单</a></li>
                  <li><a href="#">追踪订单</a></li>
                  <li><a href="#">帮助</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /row -->
        </div>
        <!-- /container -->
      </div>
    </footer>
  </div>
</template>
<script>
import { show } from '../assets/js/main.js'
export default {
  data () {
    return {
      publicPath: process.env.BASE_URL,
      navList: {
        index: '首页',

        store: '分类目录'
      },
      activePath: '',
      username: '请登录',
      value: ''
    }
  },
  created () {
    const users = window.sessionStorage.getItem('token')
    // 判断用户是否登录
    if (users) {
      // 如果登录了将值赋值给username
      this.username = window.sessionStorage.getItem('user')
    }
    this.activePath = window.sessionStorage.getItem('activePath')
    this.$nextTick(function () {
      show()
    })
  },
  mounted () {

  },
  methods: {
    saveNavState (activePath) {
      window.sessionStorage.setItem('activePath', activePath)
    },
    // 登录连接
    myClick () {
      this.$router.push('/login')
    },
    // 订单连接
    myCheckout () {
      this.$router.push('/checkout')
    },
    // 搜索
    searchGood () {
      if (this.value.trim().length === 0) {
        this.value = ''
        return this.$message.warning('请输入内容')
      }
      window.sessionStorage.setItem('search', this.value)
      this.value = ''
      this.$router.push('/store')
    }
  }
}
</script>
<style lang="less" scoped>
.nav {
  border-top: 3px solid #d10024;
  border-bottom: 2px solid #e4e7ed;
}
.el-menu {
  border-bottom: none !important;
}
</style>
