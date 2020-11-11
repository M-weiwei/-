<template>
  <div>
    <div class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">
          <!-- shop -->
          <div class="col-md-4 col-xs-6">
            <div class="shop">
              <div class="shop-img">
                <img src="../assets/image//shop01.png"
                     alt="">
              </div>
              <div class="shop-body">
                <h3>笔记本<br>系列</h3>
                <a href="#"
                   class="cta-btn"
                   @click.prevent="searchGood('笔记本电脑')">现在去购物 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- /shop -->

          <!-- shop -->
          <div class="col-md-4 col-xs-6">
            <div class="shop">
              <div class="shop-img">
                <img src="../assets/image//shop03.png"
                     alt="">
              </div>
              <div class="shop-body">
                <h3>配件<br>系列</h3>
                <a href="#"
                   class="cta-btn"
                   @click.prevent="searchGood('耳机')">现在去购物<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- /shop -->

          <!-- shop -->
          <div class="col-md-4 col-xs-6">
            <div class="shop">
              <div class="shop-img">
                <img src="../assets/image//shop02.png"
                     alt="">
              </div>
              <div class="shop-body">
                <h3>相机<br>系列</h3>
                <a href="#"
                   class="cta-btn"
                   @click.prevent="searchGood('摄影机')">现在去购物 <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          </div>
          <!-- /shop -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">

          <!-- section title -->
          <div class="col-md-12">
            <div class="section-title">
              <h3 class="title">最新产品</h3>
              <div class="section-nav">
                <ul class="section-tab-nav tab-nav">
                  <li class="active"><a data-toggle="tab"
                       href="#tab1">笔记本</a></li>
                  <li><a data-toggle="tab"
                       href="#tab1">智能手机</a></li>
                  <li><a data-toggle="tab"
                       href="#tab1">摄像机</a></li>
                  <li><a data-toggle="tab"
                       href="#tab1">配饰</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /section title -->

          <!-- Products tab & slick -->
          <div class="col-md-12">
            <div class="row">
              <div class="products-tabs">
                <!-- tab -->
                <div id="tab1"
                     class="tab-pane active">
                  <div class="products-slick"
                       data-nav="#slick-nav-1">
                    <!-- product -->
                    <div v-for="(item,i) in goodslist"
                         :key="i">
                      <div class="product">
                        <div class="product-img">
                          <img :src="item.pics[0].pics_big_url"
                               alt="">
                        </div>
                        <div class="product-body">
                          <p class="product-category">类别</p>
                          <h3 class="product-name"><a href="#">{{item.goods_name}}</a></h3>
                          <h4 class="product-price">{{'$'+item.goods_price+'.00'}}
                          </h4>
                          <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div>
                          <div class="product-btns">
                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">添加到购物车</span></button>

                            <button class="quick-view"
                                    @click="mainChecks(item.goods_id)"><i class="fa fa-eye"></i><span class="tooltipp">查看详情</span></button>
                          </div>
                        </div>
                        <div class="add-to-cart">
                          <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
                            加入购物车</button>
                        </div>
                      </div>
                    </div>
                    <!-- /product -->

                    <!-- product -->

                    <!-- /product -->
                  </div>
                  <div id="slick-nav-1"
                       class="products-slick-nav"></div>
                </div>
                <!-- /tab -->
              </div>
            </div>
          </div>
          <!-- Products tab & slick -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /SECTION -->
    <!-- HOT DEAL SECTION -->
    <div id="hot-deal"
         class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">
          <div class="col-md-12">
            <div class="hot-deal">
              <ul class="hot-deal-countdown">
                <li>
                  <div>
                    <h3>02</h3>
                    <span>天</span>
                  </div>
                </li>
                <li>
                  <div>
                    <h3>10</h3>
                    <span>时</span>
                  </div>
                </li>
                <li>
                  <div>
                    <h3>34</h3>
                    <span>分</span>
                  </div>
                </li>
                <li>
                  <div>
                    <h3>60</h3>
                    <span>秒</span>
                  </div>
                </li>
              </ul>
              <h2 class="text-uppercase">
                <p>新系列最高折扣50%</p>
                <a class="primary-btn cta-btn"
                   href="#"
                   @click.prevent="goTOShop">去购物</a>
              </h2>
            </div>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">

          <!-- section title -->
          <div class="col-md-12">
            <div class="section-title">
              <h3 class="title">最畅销</h3>
              <div class="section-nav">
                <ul class="section-tab-nav tab-nav">
                  <li class="active"><a data-toggle="tab"
                       href="#tab2">笔记本电脑</a></li>
                  <li><a data-toggle="tab"
                       href="#tab2">智能手机</a></li>
                  <li><a data-toggle="tab"
                       href="#tab2">摄像机</a></li>
                  <li><a data-toggle="tab"
                       href="#tab2">配饰</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /section title -->

          <!-- Products tab & slick -->
          <div class="col-md-12">
            <div class="row">
              <div class="products-tabs">
                <!-- tab -->
                <div id="tab2"
                     class="tab-pane fade in active">
                  <div class="products-slick"
                       data-nav="#slick-nav-2">
                    <!-- product -->
                    <div v-for="(item,i) in goodslist"
                         :key="i">
                      <div class="product">
                        <div class="product-img">
                          <img :src="item.pics[0].pics_big_url"
                               alt="">
                        </div>
                        <div class="product-body">
                          <p class="product-category">类别</p>
                          <h3 class="product-name"><a href="#">{{item.goods_name}}</a></h3>
                          <h4 class="product-price">{{'$'+item.goods_price+'.00'}}
                          </h4>
                          <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div>
                          <div class="product-btns">
                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">添加到购物车</span></button>

                            <button class="quick-view"
                                    @click="mainChecks(item.goods_id)"><i class="fa fa-eye"></i><span class="tooltipp">查看详情</span></button>
                          </div>
                        </div>
                        <div class="add-to-cart">
                          <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
                            加入购物车</button>
                        </div>
                      </div>
                    </div>
                    <!-- /product -->

                    <!-- product -->
                    <!-- /product -->
                  </div>
                  <div id="slick-nav-2"
                       class="products-slick-nav"></div>
                </div>
                <!-- /tab -->
              </div>
            </div>
          </div>
          <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /SECTION -->
    <!-- SECTION -->
    <!-- /SECTION -->
  </div>
</template>
<script>
import { show } from '../assets/js/main.js'
export default {
  data () {
    return {
      queryInfo: {
        query: '',
        pagenum: 1,
        pagesize: 5
      },
      goodslist: []
    }
  },
  created () {
    this.getGoodsList()
  },
  updated () {
    this.$nextTick(function () {
      show()
    })
  },
  mounted () {

  },
  methods: {
    searchGood (value) {
      window.sessionStorage.setItem('search', value)
      this.$router.push('/store')
    },
    goTOShop () {
      this.$router.push('/store')
    },
    async getGoodsList () {
      // 在缓存中找到输入的内容条件查找

      const { data: res } = await this.$http.get('goods', {
        params: this.queryInfo
      })

      if (res.meta.status !== 200) {
        return this.$message.error('获取商品列表失败！')
      }

      var product = []
      for (var i = 0; i < res.data.goods.length; i++) {
        const { data: rea } = await this.$http.get('goods/' + res.data.goods[i].goods_id)
        product.push(rea.data)
      }
      this.goodslist = product
      console.log(this.goodslist)
    },
    mainChecks (row) {
      window.sessionStorage.setItem('checksId', row)
      this.$router.push('/product')
    }
  }
}
</script>
<style lang="less" scoped>
.product-name {
  height: 45.6px;
}
.product-img {
  width: 293px;
  height: 293px;
}
</style>
