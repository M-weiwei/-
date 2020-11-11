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
              <el-breadcrumb-item>我的订单</el-breadcrumb-item>
            </el-breadcrumb>
          </div>
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
      <!-- container -->
      <div class="container">
        <!-- row -->
        <div class="row">

          <div class="col-md-7">
            <!-- Billing Details -->
            <div class="billing-details">
              <div class="section-title">
                <h3 class="title">订单详情</h3>
              </div>
              <el-form ref="form"
                       :model="checkoutForm">
                <el-form-item label="姓名">
                  <el-input v-model="checkoutForm.name"></el-input>
                </el-form-item>
                <el-form-item label="电话">
                  <el-input v-model="checkoutForm.name"></el-input>
                </el-form-item>
                <el-form-item label="邮箱">
                  <el-input v-model="checkoutForm.name"></el-input>
                </el-form-item>
                <el-form-item label="地址">
                  <el-input v-model="checkoutForm.name"></el-input>
                </el-form-item>

              </el-form>
              <div class="form-group">
                <div class="input-checkbox">
                  <input type="checkbox"
                         id="create-account">
                  <label for="create-account">
                    <span></span>
                    没有账号？
                  </label>
                  <div class="caption">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                    <input class="input"
                           type="password"
                           name="password"
                           placeholder="Enter Your Password">
                  </div>
                </div>
              </div>
            </div>
            <!-- /Billing Details -->

            <!-- Shiping Details -->

            <!-- /Shiping Details -->

            <!-- Order notes -->
            <div class="order-notes">
              <textarea class="input"
                        placeholder="订购须知"></textarea>
            </div>
            <!-- /Order notes -->
          </div>

          <!-- Order Details -->
          <div class="col-md-5 order-details">
            <div class="section-title text-center">
              <h3 class="title">您的订单</h3>
            </div>
            <div class="order-summary">
              <div class="order-col">
                <div><strong>产品</strong></div>
                <div><strong>价格</strong></div>
              </div>
              <div class="order-products">
                <div class="order-col">
                  <div>1x 三星笔记本电脑</div>
                  <div>$980.00</div>
                </div>
                <div class="order-col">
                  <div>2x 智能手机</div>
                  <div>$980.00</div>
                </div>
              </div>

              <div class="order-col">
                <div><strong>总价</strong></div>
                <div><strong class="order-total">$2940.00</strong></div>
              </div>
            </div>
            <div class="payment-method">
              <div class="input-radio">
                <input type="radio"
                       name="payment"
                       id="payment-1">
                <label for="payment-1">
                  <span></span>
                  银行卡
                </label>
                <div class="caption">
                  <p></p>
                </div>
              </div>
              <div class="input-radio">
                <input type="radio"
                       name="payment"
                       id="payment-2">
                <label for="payment-2">
                  <span></span>
                  微信支付
                </label>
                <div class="caption">
                  <p></p>
                </div>
              </div>
              <div class="input-radio">
                <input type="radio"
                       name="payment"
                       id="payment-3">
                <label for="payment-3">
                  <span></span>
                  支付宝
                </label>
                <div class="caption">
                  <p></p>
                </div>
              </div>
            </div>
            <div class="input-checkbox">
              <input type="checkbox"
                     id="terms">
              <label for="terms">
                <span></span>
                我已阅读并同意条款
              </label>
            </div>
            <a href="#"
               class="primary-btn order-submit">支付</a>
          </div>
          <!-- /Order Details -->
        </div>
        <!-- /row -->
      </div>
      <!-- /container -->
    </div>
  </div>
</template>
<script>
export default {
  data () {
    return {
      checkoutForm: {
        name: ''
      }
    }
  }
}
</script>
<style lang="less" scoped>
.el-form-item__label {
  text-align: left;
}
.el-breadcrumb {
  margin-bottom: 0px !important;
}
</style>
