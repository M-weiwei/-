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
              <el-breadcrumb-item>商品详情</el-breadcrumb-item>
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
          <!-- Product main img -->
          <div class="col-md-6 ">
            <div class="exzoom"
                 id="exzoom">
              <!--大图区域-->
              <div class="exzoom_img_box">
                <ul class='exzoom_img_ul'>
                  <li v-for="(item,i) in goodsIdList.pics"
                      :key='i'><img :src="goodsIdList.pics[i].pics_big_url" /></li>
                </ul>
              </div>
              <!--缩略图导航-->
              <div class="exzoom_nav"></div>
              <!--控制按钮-->
              <p class="exzoom_btn">
                <a href="javascript:void(0);"
                   class="exzoom_prev_btn"> &lt; </a>
                <a href="javascript:void(0);"
                   class="exzoom_next_btn"> &gt; </a>
              </p>
            </div>
          </div>
          <!-- /Product main img -->

          <!-- Product thumb imgs -->
          <div class="col-md-2  ">

          </div>
          <!-- /Product thumb imgs -->

          <!-- Product details -->
          <div class="col-md-5">
            <div class="product-details">
              <h2 class="product-name">{{goodsIdList.goods_name}}</h2>
              <div>
                <div class="product-rating">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star-o"></i>
                </div>
                <a class="review-link"
                   href="#">10 Review(s) | Add your review</a>
              </div>
              <div>
                <h3 class="product-price">{{'$'+goodsIdList.goods_price+'.00'}} <del class="product-old-price">$990.00</del></h3>
                <span class="product-available">{{goodsIdList.goods_number>0?'有现货':'无货'}}</span>
              </div>
              <p v-html="goodsIdList.goods_introduce"></p>

              <div class="product-options">
                <div class="attrBox"
                     v-for="(item,i) in goodsIdList.attrs"
                     :key="i">
                  <div v-if="item.attr_sel==='many'">
                    <label>
                      {{item.attr_name+":"}}
                      <select class="input-select">
                        <option value="0"
                                v-for="(items,j) in item.attr_value"
                                :key="j">{{items}}</option>
                      </select>
                    </label>
                  </div>
                </div>
              </div>

              <div class="add-to-cart">
                <div class="qty-label">
                  Qty
                  <div class="input-number">
                    <input type="number">
                    <span class="qty-up">+</span>
                    <span class="qty-down">-</span>
                  </div>
                </div>
                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> 加入购物车</button>
              </div>

              <ul class="product-links">
                <li>联系方式:</li>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
              </ul>

            </div>
          </div>
          <!-- /Product details -->

          <!-- Product tab -->
          <div class="col-md-12">
            <div id="product-tab">
              <!-- product tab nav -->
              <ul class="tab-nav">
                <li class="active"><a data-toggle="tab"
                     href="#tab1">商品详情</a></li>
                <li><a data-toggle="tab"
                     href="#tab3">评论</a></li>
              </ul>
              <!-- /product tab nav -->

              <!-- product tab content -->
              <div class="tab-content">
                <!-- tab1  -->
                <div id="tab1"
                     class="tab-pane fade in active">
                  <div class="row">
                    <div class="col-md-12">
                      <div v-for="(item,i) in goodsIdList.attrs"
                           :key="i">
                        <span v-if="item.attr_sel==='only'">{{item.attr_name+':'+ item.attr_value}}</span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /tab1  -->

                <!-- tab2  -->
                <!-- /tab2  -->

                <!-- tab3  -->
                <div id="tab3"
                     class="tab-pane fade in">
                  <div class="row">
                    <!-- Rating -->
                    <div class="col-md-3">
                      <div id="rating">
                        <div class="rating-avg">
                          <span>4.5</span>
                          <div class="rating-stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                          </div>
                        </div>
                        <ul class="rating">
                          <li>
                            <div class="rating-stars">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                            </div>
                            <div class="rating-progress">
                              <div style="width: 80%;"></div>
                            </div>
                            <span class="sum">3</span>
                          </li>
                          <li>
                            <div class="rating-stars">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star-o"></i>
                            </div>
                            <div class="rating-progress">
                              <div style="width: 60%;"></div>
                            </div>
                            <span class="sum">2</span>
                          </li>
                          <li>
                            <div class="rating-stars">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star-o"></i>
                              <i class="fa fa-star-o"></i>
                            </div>
                            <div class="rating-progress">
                              <div></div>
                            </div>
                            <span class="sum">0</span>
                          </li>
                          <li>
                            <div class="rating-stars">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star-o"></i>
                              <i class="fa fa-star-o"></i>
                              <i class="fa fa-star-o"></i>
                            </div>
                            <div class="rating-progress">
                              <div></div>
                            </div>
                            <span class="sum">0</span>
                          </li>
                          <li>
                            <div class="rating-stars">
                              <i class="fa fa-star"></i>
                              <i class="fa fa-star-o"></i>
                              <i class="fa fa-star-o"></i>
                              <i class="fa fa-star-o"></i>
                              <i class="fa fa-star-o"></i>
                            </div>
                            <div class="rating-progress">
                              <div></div>
                            </div>
                            <span class="sum">0</span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <!-- /Rating -->

                    <!-- Reviews -->
                    <div class="col-md-6">
                      <div id="reviews">
                        <ul class="reviews">
                          <li>
                            <div class="review-heading">
                              <h5 class="name">John</h5>
                              <p class="date">27 DEC 2018, 8:0 PM</p>
                              <div class="review-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                              </div>
                            </div>
                            <div class="review-body">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                            </div>
                          </li>
                          <li>
                            <div class="review-heading">
                              <h5 class="name">John</h5>
                              <p class="date">27 DEC 2018, 8:0 PM</p>
                              <div class="review-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                              </div>
                            </div>
                            <div class="review-body">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                            </div>
                          </li>
                          <li>
                            <div class="review-heading">
                              <h5 class="name">John</h5>
                              <p class="date">27 DEC 2018, 8:0 PM</p>
                              <div class="review-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o empty"></i>
                              </div>
                            </div>
                            <div class="review-body">
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                            </div>
                          </li>
                        </ul>
                        <ul class="reviews-pagination">
                          <li class="active">1</li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- /Reviews -->

                    <!-- Review Form -->
                    <div class="col-md-3">
                      <div id="review-form">
                        <form class="review-form">
                          <input class="input"
                                 type="text"
                                 placeholder="Your Name">
                          <input class="input"
                                 type="email"
                                 placeholder="Your Email">
                          <textarea class="input"
                                    placeholder="Your Review"></textarea>
                          <div class="input-rating">
                            <span>Your Rating: </span>
                            <div class="stars">
                              <input id="star5"
                                     name="rating"
                                     value="5"
                                     type="radio"><label for="star5"></label>
                              <input id="star4"
                                     name="rating"
                                     value="4"
                                     type="radio"><label for="star4"></label>
                              <input id="star3"
                                     name="rating"
                                     value="3"
                                     type="radio"><label for="star3"></label>
                              <input id="star2"
                                     name="rating"
                                     value="2"
                                     type="radio"><label for="star2"></label>
                              <input id="star1"
                                     name="rating"
                                     value="1"
                                     type="radio"><label for="star1"></label>
                            </div>
                          </div>
                          <button class="primary-btn">Submit</button>
                        </form>
                      </div>
                    </div>
                    <!-- /Review Form -->
                  </div>
                </div>
                <!-- /tab3  -->
              </div>
              <!-- /product tab content  -->
            </div>
          </div>
          <!-- /product tab -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>

  </div>
</template>
<script>
import { show } from '../../assets/js/main.js'
import '../../assets/js/jquery.exzoom.js'
export default {
  data () {
    return {
      goodsIdList: {}

    }
  },
  created () {
    this.getGoodsIdList()
  },
  mounted () {
    this.$nextTick(function () {
      show()
    })
  },
  updated () {
    this.$nextTick(function () {
      //   this.showEditDialog(this.goodsIdList.cat_id)
      this.$('#exzoom').exzoom({
        autoPlay: false
      })
    })
  },
  methods: {
    async getGoodsIdList () {
      // 通过商品id获取详情
      var goodsId = window.sessionStorage.getItem('checksId')
      goodsId = goodsId - 0
      const { data: res } = await this.$http.get('goods/' + goodsId)

      if (res.meta.status !== 200) {
        return this.$message.error('商品信息获取失败')
      }
      res.data.attrs.map(element => {
        element.attr_value = element.attr_value.split(' ')
      })
      this.goodsIdList = res.data
    }
  }
}
</script>
<style lang="less" scoped>
.attrBox {
  margin-bottom: 20px;
}
.input-select {
  width: 150px;
}
.product-details .product-options .input-select {
  width: 200px;
}
#exzoom {
  width: 400px;
  /*height: 400px;*/
  margin: auto;
}
</style>
