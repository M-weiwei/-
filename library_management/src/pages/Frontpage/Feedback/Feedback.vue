<template>
  <div>
    <div class="banner">
    </div>
    <div class="feedback">
      <div class="container">
        <div class="w3ls-title">
          <h3>用户反馈</h3>
        </div>
        <div class="feedback_from">
          <el-form :model="formInline"
                   class="demo-form-inline">
            <el-row>
              <el-col :span='12'>
                <el-form-item>
                  <el-input v-model="formInline.userName"
                            placeholder="用户名"
                            :disabled="true"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span='12'>
                <el-form-item>
                  <el-input v-model="formInline.userEmail"
                            placeholder="邮箱"
                            :disabled="true"></el-input>
                </el-form-item>
              </el-col>

            </el-row>
            <el-form-item class="textarea">
              <el-input v-model="formInline.feedbackReason"
                        type="textarea"
                        placeholder="请输入内容..."
                        :rows='10'></el-input>
            </el-form-item>
            <el-form-item class="submit">
              <el-button type="primary"
                         @click="onSubmit">提交</el-button>
            </el-form-item>
          </el-form>
        </div>

      </div>
    </div>

  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data () {
    return {
      formInline: {
        userName: '',
        userEmail: '',
        feedbackReason: ''
      }

    }
  },
  methods: {
    async onSubmit () {
      if (!this.userInfo.userId) {
        this.$message.error('请先登录')
        return this.$router.push('/login')
      }
      const { data: res } = await this.$http.get('demo/interfaces/feedback.php', { params: { userId: this.userInfo.userId, feedbackReason: this.formInline.feedbackReason } })
      console.log(res)
      this.formInline.feedbackReason = ''
      this.$message.success('提交成功')
    }

  },
  computed: {
    ...mapState(['userInfo'])
  },
  mounted () {
    this.formInline.userName = this.userInfo.userName
    this.formInline.userEmail = this.userInfo.userEmail
  }
}

</script>
<style lang='stylus' scoped>
@import './../../../assets/css/stylus.css'
textarea
  resize none
.banner
  background url('../Home/images/banner.jpg') no-repeat center center
  background-size cover
  min-height 300px
.feedback
  margin 70px
  .feedback_from
    padding 50px 0
  .demo-form-inline
    .el-col
      padding 0 10px
    .textarea
      padding 0 10px
    .submit
      display flex
      justify-content center
      .el-button
        margin auto
        outline none
        color #fff
        padding 0.7em 5em
        font-size 1.1em
        margin 1em 0 0 0
        -webkit-appearance none
        background #00b3fe
        transition 0.5s all
        border 2px solid #00b3fe
        -webkit-transition 0.5s all
        transition 0.5s all
        &:hover
          background-color #01edc9
          border 2px solid #01edc9
</style>
