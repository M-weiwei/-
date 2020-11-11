<template>
  <div>
    <!-- 认证部分 -->
    <el-card>
      <div class="authentication_box"
           v-if="userInfo.userMarking!=='2'">
        <h3>您还未认证</h3>
        <el-form label-width="80px"
                 ref="form"
                 :rules="authenticaFormRules"
                 :model="authenticaform">
          <el-form-item label="学号"
                        prop='userStuld'>
            <el-input v-model="authenticaform.userStuld"></el-input>
          </el-form-item>
          <el-form-item label="邮箱"
                        prop='email'>
            <el-input v-model="authenticaform.email"></el-input>
          </el-form-item>
          <el-form-item label="验证码">
            <div class="verification">
              <el-input v-model="authenticaform.emailnumber"> </el-input>
              <el-button type="success"
                         v-if="!countDown"
                         @click.prevent="geVerifyCode()">获取验证码</el-button>
              <el-button type="info"
                         v-else
                         disabled>已发送({{countDown}}s)</el-button>
            </div>
          </el-form-item>
          <el-form-item>
            <el-button type="primary"
                       @click.prevent="authen()">确定</el-button>
            <el-button>取消</el-button>
          </el-form-item>
        </el-form>
      </div>
      <div class="yesauthentication"
           v-else>
        <h3>您已完成认证</h3>
      </div>
    </el-card>
  </div>
</template>

<script>

import { mapState } from 'vuex'
export default {
  data () {
    var checkemail = (rue, value, cb) => {
      // 定义验证邮箱正则表达式
      const regemail = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+([a-zA-Z0-9_-])+/
      if (regemail.test(value)) {
        //   如果验证通过调用cb回调函数
        return cb()
      }
      //   失败自定义错误信息
      cb(new Error('请输入合法邮箱'))
    }
    return {
      countDown: 0,
      authenticaform: {
        userStuld: '', // 学号
        email: '',
        emailnumber: ''
      }, // 倒计时
      authenticaFormRules: {
        userStuld: [
          { required: true, message: '请输入学号', trigger: 'blur' },
          { min: 6, message: '至少输入6个字符', trigger: 'blur' }
        ],
        email: [{
          required: true, message: '请输入用户邮箱', trigger: 'blur'
        }, {
          validator: checkemail, trigger: 'blur'
        }]
      }
    }
  },
  created () {

  },
  mounted () {

  },
  methods: {
    async geVerifyCode () {
      if (this.authenticaform.emailnumber === '') {
        return this.$message.error('请输入邮箱！')
      }
      this.countDown = 10
      this.intervalId = setInterval(() => {
        this.countDown--
        if (this.countDown === 0) {
          clearInterval(this.intervalId)
        }
      }, 1000)
      console.log(this.authenticaform.email)

      const { data: res } = await this.$http.get('demo/interfaces/email.php', { params: { userEmail: this.authenticaform.email } })
      this.authenticaform.emailnumber = res
      console.log(res)
    },
    authen () {
      // 用户认证
      this.$refs.form.validate(async valid => {
        if (!valid) {
          return this.$message.error('请填写学号！')
        }
        // eslint-disable-next-line no-unused-vars
        const { data: res } = await this.$http.get('demo/interfaces/stu.php', {
          params: {
            userId: this.userInfo.userId, userStuld: this.authenticaform.userStuld
          }
        })
        this.authenticaform.emailnumber = ''
        this.$refs.form.resetFields();
        this.$message.success('提交成功')
      })
    }
  },
  computed: {
    ...mapState(['userInfo'])
  }
}
</script>

<style scoped lang="stylus">
.authentication_box
  width 100%
  text-align center
  h3
    color red
    font-size 25px
    margin-bottom 20px
  .verification
    display flex
    flex-direction row
    .el-input
      margin-right 15px
.yesauthentication
  width 100%
  text-align center
  h3
    color #01edc9
    font-size 25px
    margin-bottom 20px
</style>
