<template>
  <div>
    <div id="breadcrumb"
         class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">
          <div class="col-md-12">
            <el-breadcrumb separator-class="el-icon-arrow-right">
              <el-breadcrumb-item :to="{ path: '/index' }">首页</el-breadcrumb-item>
              <el-breadcrumb-item>分类目录</el-breadcrumb-item>
            </el-breadcrumb>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <div class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">
          <!-- ASIDE -->
          <div id="aside"
               class="col-md-3">
            <!-- aside Widget -->
            <div class="aside">
              <h3 class="aside-title">分类目录</h3>
              <div class="checkbox-filter">

                <div class="input-checkbox">
                  <input type="checkbox"
                         id="category-1">
                  <label for="category-1">
                    <span></span>
                    笔记本电脑
                  </label>
                </div>

                <div class="input-checkbox">
                  <input type="checkbox"
                         id="category-2">
                  <label for="category-2">
                    <span></span>
                    耳机

                  </label>
                </div>

                <div class="input-checkbox">
                  <input type="checkbox"
                         id="category-3">
                  <label for="category-3">
                    <span></span>
                    手机

                  </label>
                </div>

                <div class="input-checkbox">
                  <input type="checkbox"
                         id="category-4">
                  <label for="category-4">
                    <span></span>
                    摄影机

                  </label>
                </div>
              </div>
            </div>
            <!-- /aside Widget -->

            <!-- aside Widget -->

            <!-- /aside Widget -->

            <!-- aside Widget -->
            <div class="aside">
              <h3 class="aside-title">品牌</h3>
              <div class="checkbox-filter">
                <div class="input-checkbox">
                  <input type="checkbox"
                         id="brand-1">
                  <label for="brand-1">
                    <span></span>
                    apple/苹果

                  </label>
                </div>
                <div class="input-checkbox">
                  <input type="checkbox"
                         id="brand-2">
                  <label for="brand-2">
                    <span></span>
                    xiaomi/小米

                  </label>
                </div>
                <div class="input-checkbox">
                  <input type="checkbox"
                         id="brand-3">
                  <label for="brand-3">
                    <span></span>
                    Huawei/华为

                  </label>
                </div>

                <div class="input-checkbox">
                  <input type="checkbox"
                         id="brand-5">
                  <label for="brand-5">
                    <span></span>
                    TAFIQ/塔菲克

                  </label>
                </div>
                <div class="input-checkbox">
                  <input type="checkbox"
                         id="brand-6">
                  <label for="brand-6">
                    <span></span>
                    EDIFIER/漫步者

                  </label>
                </div>
              </div>
            </div>

          </div>
          <!-- /ASIDE -->

          <!-- STORE -->
          <div id="store"
               class="col-md-9">
            <!-- store top filter -->

            <!-- /store top filter -->

            <!-- store products -->
            <div class="row"
                 id="storeBox">
              <!-- product -->
              <div class="col-md-4 col-xs-6"
                   v-for="item in goodslist"
                   :key="item.goods_id">
                <div class="product">
                  <div class="product-img">
                    <img :src="item.pics[0].pics_big_url"
                         alt="">

                  </div>
                  <div class="product-body">
                    <!-- <p class="product-category">Category</p> -->
                    <h3 class="product-name"><a href="#">{{item.goods_name}}</a></h3>
                    <h4 class="product-price">{{'$'+item.goods_price+'.00'}} <del class="product-old-price">$990.00</del></h4>
                    <div class="product-rating">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div>
                    <div class="product-btns">
                      <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">添加到喜欢</span></button>

                      <button class="quick-view"
                              @click="mainChecks(item.goods_id)"><i class="fa fa-eye"></i><span class="tooltipp">查看详情</span></button>
                    </div>
                  </div>
                  <div class="add-to-cart">
                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> 加入购物车</button>
                  </div>
                </div>
              </div>
              <!-- /product -->

              <!-- /product -->
            </div>
            <!-- /store products -->

            <!-- store bottom filter -->
            <el-row type="flex"
                    justify="space-between">
              <el-col :span='6'>
                <span class="store-qty">{{'一共有'+total+'个商品'}}</span></el-col>
              <el-col :span='18'
                      class="page">
                <el-pagination @size-change="handleSizeChange"
                               @current-change="handleCurrentChange"
                               :current-page="queryInfo.pagenum"
                               :page-size="queryInfo.pagesize"
                               layout="prev, pager, next, jumper"
                               :total="total"
                               background>
                </el-pagination>
              </el-col>
            </el-row>
            <!-- /store bottom filter -->
          </div>
          <!-- /STORE -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /container -->
  </div>
</template>
<script>
export default {
  data () {
    return {
      queryInfo: {
        query: '',
        pagenum: 1,
        pagesize: 9
      },
      goodslist: [],
      total: 0,
      cateList: {}
    }
  },
  created () {
    var search = window.sessionStorage.getItem('search')
    if (search) {
      this.queryInfo.query = search
    }
    this.getGoodsList()
  },
  methods: {
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

      this.total = res.data.total
    },
    mainChecks (row) {
      window.sessionStorage.setItem('checksId', row)
      this.$router.push('/product')
    },
    handleSizeChange (newSize) {
      this.queryInfo.pagesize = newSize
      this.getGoodsList()
    },
    handleCurrentChange (newPage) {
      this.queryInfo.pagenum = newPage
      window.location.hash = '#weizhi'
      this.getGoodsList()
    }

  }
}
</script>
<style lang="less" scoped>
.page {
  text-align: right;
}
.el-pagination.is-background .el-pager li:not(.disabled).active {
  background-color: #d10024 !important;
  color: #fff;
}

.el-pagination button:hover {
  color: #d10024;
}
.product-name {
  height: 45.6px;
}
#storeBox img {
  width: 262.5px;
  height: 262.5px;
}
.el-breadcrumb {
  margin-bottom: 0px !important;
}
</style>
