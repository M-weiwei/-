<template>

  <div class="login_container">
    <div class="login_box">
      <!-- 头像部分 -->
      <div class="avatar_box">
        <img src="./images/login.png"
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
        <el-form-item class="register">
          <a href=""
             @click.prevent="$router.push('./register')">还没有账号？点击注册》</a>
        </el-form-item>
        <el-form-item class="btns">
          <el-button type="primary"
                     @click="login">登录</el-button>
          <el-button type="info"
                     @click="resetLoginForm">重置</el-button>
        </el-form-item>
      </el-form>

    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data () {
    return {
      loginform: {
        username: '',
        password: ''
      },
      loginFormRules: {
        username: [
          { required: true, message: '请输入登录名称', trigger: 'blur' },
          { min: 3, max: 16, message: '长度在 3 到 10 个字符', trigger: 'blur' }
        ],
        password: [
          { required: true, message: '请输入登录密码', trigger: 'blur' },
          { min: 6, max: 15, message: '长度在 6 到 15 个字符', trigger: 'blur' }

        ]
      }
    }
  },
  methods: {
    resetLoginForm () {
      this.$refs.loginFormRef.resetFields()
    },
    login () {
      this.$refs.loginFormRef.validate(valid => {
        if (!valid) {
          return this.$message.error('请填写登录信息！')
        }
        this.$store.dispatch('GetUserInfo', this.loginform)
        console.log(this.userInfo)
      })
    }
  },
  computed: {
    ...mapState(['userInfo'])
  },
  watch: {
    // 监听userinfo变化
    userInfo () {
      if (this.userInfo.type !== 200) return this.$message.error('用户名或密码错误')
      this.$message.success('登录成功')
      window.sessionStorage.setItem('activePath', '/home')
      this.$router.push('/home')
    }
  }

}

</script>
<style lang='stylus' scoped>
.login_container
  background url('./images/cou.jpg') no-repeat center center
  background-size cover
  height 100%
  position relative
.login_box
  width 450px
  height 350px
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
</style>
