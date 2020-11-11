<template>
  <div class="login_container">
    <div class="login_box">
      <!-- 头像部分 -->
      <div class="avatar_box">
        <img src="./../Login/images/login.png"
             alt="">
      </div>
      <!-- 提交部分 -->
      <el-form label-width="0px"
               :model='loginform'
               :rules="loginFormRules"
               class="login_form"
               ref="loginFormRef">
        <el-form-item prop="username">
          <el-input prefix-icon="el-icon-user-solid"
                    v-model="loginform.username"
                    placeholder="邮箱/账号/手机号"></el-input>
        </el-form-item>
        <el-form-item prop="password">
          <el-input prefix-icon="el-icon-lock"
                    v-model="loginform.password"
                    type="password"
                    placeholder="密码"></el-input>
        </el-form-item>
        <el-form-item prop="passwords">
          <el-input prefix-icon="el-icon-lock"
                    v-model="loginform.passwords"
                    type="password"
                    placeholder="确认密码"></el-input>
        </el-form-item>
        <el-form-item prop="email">
          <el-input prefix-icon="el-icon-message"
                    v-model="loginform.email"
                    placeholder="邮箱"></el-input>
        </el-form-item>
        <el-form-item class="register">
          <div class="verification">
            <el-input prefix-icon="el-icon-key"
                      placeholder="验证码"
                      v-model="loginform.emailnumber"></el-input>
            <el-button type="success"
                       v-if="!countDown"
                       @click.prevent="geVerifyCode()">获取验证码</el-button>
            <el-button type="info"
                       v-else
                       disabled>已发送({{countDown}}s)</el-button>
          </div>
        </el-form-item>
        <el-form-item class="btns">
          <el-button type="primary"
                     @click="register">注册</el-button>
          <el-button type="info"
                     @click="resetLoginForm">重置</el-button>
        </el-form-item>
      </el-form>

    </div>
  </div>
</template>

<script>
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
      loginform: {
        username: '',
        password: '',
        passwords: '',
        email: '',
        emailnumber: ''
      },
      loginFormRules: {
        username: [
          { required: true, message: '请输入登录名称', trigger: 'blur' },
          { min: 3, max: 10, message: '长度在 3 到 10 个字符', trigger: 'blur' }
        ],
        password: [
          { required: true, message: '请输入登录密码', trigger: 'blur' },
          { min: 6, max: 15, message: '长度在 6 到 15 个字符', trigger: 'blur' }

        ],
        passwords: [
          { required: true, message: '请输入确认密码', trigger: 'blur' },
          { min: 6, max: 15, message: '长度在 6 到 15 个字符', trigger: 'blur' }

        ],
        email: [{
          required: true, message: '请输入用户邮箱', trigger: 'blur'
        }, {
          validator: checkemail, trigger: 'blur'
        }],
        emailnumber: [
          { required: true, message: '请输入验证码', trigger: 'blur' },
          { min: 1, max: 4, message: '长度在 4 字符', trigger: 'blur' }
        ]
      },
      countDown: 0

    }
  },
  created () {

  },
  mounted () {

  },
  methods: {
    resetLoginForm () {
      this.$refs.loginFormRef.resetFields()
    },
    register () {
      this.$refs.loginFormRef.validate(async valid => {
        if (!valid) {
          return this.$message.error('请填写注册信息！')
        }
        if (this.loginform.password !== this.loginform.passwords) {
          return this.$message.error('两次密码不匹配')
        }
        const { data: res } = await this.$http.get('demo/interfaces/register.php', { params: { username: this.loginform.username, password: this.loginform.password, email: this.loginform.email } })
        this.$message.success('注册成功')
        this.$router.push('/login')
        console.log(res)
      })
    },
    async geVerifyCode () {
      if (this.loginform.emailnumber === '') {
        return this.$message.error('请输入邮箱！')
      }
      // 获取验证码
      this.countDown = 10
      this.intervalId = setInterval(() => {
        this.countDown--
        if (this.countDown === 0) {
          clearInterval(this.intervalId)
        }
      }, 1000)
      const { data: res } = await this.$http.get('demo/interfaces/email.php', { params: { userEmail: this.loginform.email } })
      this.loginform.emailnumber = res
      console.log(res)
    }
  }
}
</script>

<style scoped lang="stylus">
.login_container
  background url('./../Login/images/cou.jpg') no-repeat center center
  background-size cover
  height 100%
  position relative
.login_box
  width 450px
  height 480px
  background-color #fff
  border-radius 5px
  position absolute
  left 50%
  top 50%
  transform translate(-50%, -50%)
  .avatar_box
    height 130px
    width 130px
    border 1px solid #eee
    border-radius 50%
    padding 10px
    box-shadow 0 0 10px #ddd
    position absolute
    left 50%
    transform translate(-50%, -50%)
    background-color #fff
    img
      width 100%
      height 100%
      border-radius 50%
.login_form
  position absolute
  bottom 0
  width 100%
  padding 0 20px
  box-sizing border-box
.btns
  display flex
  justify-content flex-end
.register
  text-align right
  a
    color #ccc
    text-decoration none
.verification
  display flex
  .el-input
    margin-right 15px
</style>
