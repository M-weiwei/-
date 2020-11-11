<template>
  <div>
    <el-card class="box-card">
      <el-form ref="editFormRef"
               :model="editForm"
               :rules="editFormRules"
               label-width="80px">
        <el-form-item label="姓名"
                      prop='userName'>
          <el-input v-model="editForm.userName"></el-input>
        </el-form-item>

        <el-form-item label="邮箱"
                      prop='userEmail'>
          <el-input v-model="editForm.userEmail"></el-input>
        </el-form-item>

        <el-form-item>
          <el-button type="primary"
                     @click="update">修改</el-button>
        </el-form-item>
      </el-form>
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
    // 验证手机号

    return {
      // 验证规则
      editFormRules: {
        userName: [{
          required: true, message: '请输入用户名称', trigger: 'blur'
        }, {
          min: 3, max: 10, message: '用户名在3~10个字符之间', trigger: 'blur'
        }],
        userEmail: [{
          required: true, message: '请输入用户邮箱', trigger: 'blur'
        }, {
          validator: checkemail, trigger: 'blur'
        }],
      },
      editForm: {
        userName: '',
        userEmail: '',
        userPassword: '123456',
      }
    }
  },
  methods: {
    update () {
      this.$refs.editFormRef.validate(async valid => {
        if (!valid) {
          return this.$message.error('请填写修改信息！')
        }
        const { data: res } = await this.$http.get('demo/interfaces/upUser.php', {
          params: {
            userName: this.editForm.userName, userEmail: this.editForm.userEmail
            , userPassword: this.editForm.userPassword, userId: this.userInfo.userId
          }
        })
        this.$store.commit('ReqUserInfo', JSON.parse(JSON.stringify(res[0])))
        console.log(res);
      })
    }
  },
  computed: {
    ...mapState(['userInfo'])
  },
}

</script>
<style lang='stylus' scoped></style>
