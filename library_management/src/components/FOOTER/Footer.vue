<template>
  <div class="footer">
    <div class="container">
      <el-row>
        <el-col :span='8'>
          <div class="title">
            <h2>联系我们</h2>
          </div>
          <div class="social-icon">
            <a href=""
               class="social-button">
              <i class="iconfont icon-twitter"
                 style="color:#3CF"></i>
            </a>
            <a href=""
               class="social-button">
              <i class="iconfont icon-f"
                 style="color:#3B5998"></i>
            </a>
            <a href=""
               class="social-button">
              <i class="iconfont icon-googleplus"
                 style="color:#DC4A38"></i>
            </a>
            <a href=""
               class="social-button">
              <i class="iconfont icon-dribbble"
                 style="color:#F26798"></i>
            </a>
            <a href=""
               class="social-button">
              <i class="iconfont icon-skype"
                 style="color:#00AFF0"></i>
            </a>
          </div>
        </el-col>
        <el-col :span='12'>
          <el-form ref="form">
            <el-form-item>
              <el-input class="email"
                        placeholder="请输入邮箱..."></el-input>
              <el-button class="submit">提交</el-button>
            </el-form-item>
          </el-form>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>

export default {
  data () {
    return {

    }
  },
  methods: {}
}

</script>
<style lang='stylus' >
.footer
  padding 4em 0
  background #212121
  .container
    width 1140px
    margin auto
    .title
      text-align left
      margin-bottom 2em
      h2
        color #00b3fe
        font-size 2em
        font-weight 600
        margin-bottom 0.8em
        text-transform capitalize
        border-left 5px solid #01edc9
        padding-left 0.6em
        line-height 0.9em
    .social-icon
      a
        background-color #fff
        width 32px
        height 32px
        margin 0 3px
        text-decoration none
        display inline-block
        line-height 32px
        text-align center
        i
          font-size 20px
          vertical-align middle
    .el-input__inner
      background-color #212121 !important
    .submit
      outline none
      padding 0
      width 70px
      border none
      background #00b3fe
      text-align center
      color #fff
      height 70px
      -webkit-border-radius 50%
      -moz-border-radius 50%
      border-radius 50%
      position absolute
      right -11px
      top -14px
      transition all 0.5s
      &:hover
        background-color #01edc9
</style>
