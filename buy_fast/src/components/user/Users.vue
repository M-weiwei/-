<template>
  <div>
    <!-- 面包屑导航 -->
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/admin' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>用户管理</el-breadcrumb-item>
      <el-breadcrumb-item>用户列表</el-breadcrumb-item>
    </el-breadcrumb>
    <!-- 卡片视图 -->
    <el-card>
      <el-row :gutter="20">
        <el-col :span='7'>
          <el-input placeholder="请输入内容"
                    v-model="queryInfo.query"
                    clearable
                    @clear='getUserList'>
            <el-button slot="append"
                       icon="el-icon-search"
                       @click="getUserList"></el-button>
          </el-input>
        </el-col>
        <el-col :span='4'>
          <el-button type='primary'
                     @click="addDialogVisible=true">添加用户</el-button>
        </el-col>
      </el-row>
      <el-table :data='userlist'
                border
                stripe>
        <el-table-column type='index'
                         label='#'></el-table-column>
        <el-table-column label='姓名'
                         prop='username'></el-table-column>
        <el-table-column label='邮箱'
                         prop='email'></el-table-column>
        <el-table-column label='电话'
                         prop='mobile'></el-table-column>
        <el-table-column label='角色'
                         prop='role_name'></el-table-column>
        <el-table-column label='状态'>
          <!-- 作用域插槽 -->
          <template slot-scope="scope">
            <el-switch v-model="scope.row.mg_state"
                       @change="userStateChanged(scope.row)">
            </el-switch>
          </template>
        </el-table-column>
        <el-table-column label='操作'>
          <template slot-scope="scope">
            <el-button type="primary"
                       icon="el-icon-edit"
                       size='mini'
                       @click="showEditDialog(scope.row.id)"></el-button>
            <el-button type="danger"
                       icon="el-icon-delete"
                       size='mini'
                       @click="removeUserById(scope.row.id)"></el-button>
            <el-tooltip effect="dark"
                        content="分配角色"
                        placement="top"
                        :enterable='false'>
              <el-button type="warning"
                         icon="el-icon-setting"
                         size='mini'
                         @click="setRole(scope.row)"></el-button>
            </el-tooltip>
          </template>
        </el-table-column>
      </el-table>
      <el-pagination @size-change="handleSizeChange"
                     @current-change="handleCurrentChange"
                     :current-page="queryInfo.pagenum"
                     :page-sizes="[1, 2, 5, 10]"
                     :page-size="queryInfo.pagesize"
                     layout="total, sizes, prev, pager, next, jumper"
                     :total="total">
      </el-pagination>
    </el-card>
    <!-- 添加用户区域 -->
    <el-dialog title="添加用户"
               :visible.sync="addDialogVisible"
               width="50%"
               @close="addDialogClose">
      <!-- 主体区域 -->
      <el-form :model="addForm"
               :rules="addFormRules"
               ref="addFormRef"
               label-width="70px">
        <el-form-item label="用户名"
                      prop="username">
          <el-input v-model="addForm.username"></el-input>
        </el-form-item>
        <el-form-item label="密码"
                      prop="password">
          <el-input v-model="addForm.password"
                    type='password'></el-input>
        </el-form-item>
        <el-form-item label="邮箱"
                      prop="email">
          <el-input v-model="addForm.email"></el-input>
        </el-form-item>
        <el-form-item label="手机"
                      prop="mobile">
          <el-input v-model="addForm.mobile"></el-input>
        </el-form-item>
      </el-form>
      <!-- 尾部区域 -->
      <span slot="footer"
            class="dialog-footer">
        <el-button @click="addDialogVisible = false">取 消</el-button>
        <el-button type="primary"
                   @click="addUser">确 定</el-button>
      </span>
    </el-dialog>
    <!-- 修改用户区域 -->
    <el-dialog title="修改用户"
               :visible.sync="editDialogVisible"
               width="50%"
               @close="editDialogClose">
      <el-form :model="editForm"
               :rules="editFormRules"
               ref="editFormRef"
               label-width="70px"
               class="demo-ruleForm">
        <el-form-item label="用户名">
          <el-input v-model="editForm.username"
                    disabled></el-input>
        </el-form-item>
        <el-form-item label="邮箱"
                      prop='emali'>
          <el-input v-model="editForm.email"></el-input>
        </el-form-item>
        <el-form-item label="手机号"
                      prop='mobile'>
          <el-input v-model="editForm.mobile"></el-input>
        </el-form-item>
      </el-form>
      <span slot="footer"
            class="dialog-footer">
        <el-button @click="editDialogVisible = false">取 消</el-button>
        <el-button type="primary"
                   @click="editUserInfo">确 定</el-button>
      </span>
    </el-dialog>
    <!-- 分配角色区域 -->
    <el-dialog title="分配角色"
               :visible.sync="setRoleDialogVisible"
               width="50%"
               @close="setRoleDialogClosed">
      <div>
        <p>当前的用户：{{userInfo.username}}</p>
        <p>当前的角色：{{userInfo.role_name}}</p>
        <p>分配新角色：
          <el-select v-model="selectedRoleId"
                     placeholder="请选择">
            <el-option v-for="item in rolesList"
                       :key="item.id"
                       :label="item.roleName"
                       :value="item.id">
            </el-option>
          </el-select>
        </p>
      </div>
      <span slot="footer"
            class="dialog-footer">
        <el-button @click="setRoleDialogVisible = false">取 消</el-button>
        <el-button type="primary"
                   @click="saveRoleInfo">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>
<script>
export default {
  data () {
    //   验证邮箱
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
    var checkMobile = (rue, value, cb) => {
      const regeMobile = /^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/
      if (regeMobile.test(value)) {
        return cb()
      }
      cb(new Error('请输入合法手机号'))
    }

    return {
      queryInfo: {
        query: '',
        pagenum: 1,
        pagesize: 2
      },
      userlist: [],
      total: 0,
      addDialogVisible: false,
      addForm: {
        username: '',
        password: '',
        email: '',
        mobile: ''
      },
      addFormRules: {
        username: [{
          required: true, message: '请输入用户名称', trigger: 'blur'
        }, {
          min: 3, max: 10, message: '用户名在3~10个字符之间', trigger: 'blur'
        }],
        password: [{
          required: true, message: '请输入用户密码', trigger: 'blur'
        }, {
          min: 6, max: 15, message: '用户名在6~15个字符之间', trigger: 'blur'
        }],
        email: [{
          required: true, message: '请输入用户邮箱', trigger: 'blur'
        }, {
          validator: checkemail, trigger: 'blur'
        }],
        mobile: [{
          required: true, message: '请输入用户手机号', trigger: 'blur'
        },
        {
          // 验证触发
          validator: checkMobile, trigger: 'blur'
        }]
      },
      editDialogVisible: false,
      // id查询到的用户信息
      editForm: {},
      //   修改用户验证规则
      editFormRules: {
        email: [{
          required: true, message: '请输入用户邮箱', trigger: 'blur'
        }, {
          validator: checkemail, trigger: 'blur'
        }],
        mobile: [{
          required: true, message: '请输入用户手机号', trigger: 'blur'
        },
        {
          // 验证触发
          validator: checkMobile, trigger: 'blur'
        }]
      },
      setRoleDialogVisible: false,
      userInfo: {},
      rolesList: [],
      selectedRoleId: ''
    }
  },
  created () {
    this.getUserList()
  },
  methods: {
    async getUserList () {
      const { data: res } = await this.$http.get('users', { params: this.queryInfo })
      if (res.meta.status !== 200) return this.message.error('获取用户列表失败')
      this.userlist = res.data.users
      this.total = res.data.total
    },
    handleSizeChange (newSize) {
      this.queryInfo.pagesize = newSize
      this.getUserList()
    },
    handleCurrentChange (newPage) {
      this.queryInfo.pagenum = newPage
      this.getUserList()
    },
    async userStateChanged (userInfo) {
      const { data: res } = await this.$http.put(`users/${userInfo.id}/state/${userInfo.mg_state}`)
      if (res.meta.status !== 200) {
        userInfo.mg_state = !userInfo.mg_state
        return this.message.error('更新用户状态失败')
      }
      this.$message.success('修改成功')
    },
    addDialogClose () {
      this.$refs.addFormRef.resetFields()// 表单关闭时制定refs的属性重置表单
    },
    addUser () {
      // 表单预校验
      this.$refs.addFormRef.validate(async vaild => {
        // eslint-disable-next-line no-useless-return
        if (!vaild) return
        const { data: res } = await this.$http.post('users', this.addForm)
        if (res.meta.status !== 201) {
          this.$message.error('用户添加失败')
        }
        this.$message.success('用户添加成功')
        this.addDialogVisible = false
        this.getUserList()
      })
    },
    // 用户修改
    async showEditDialog (id) {
      const { data: res } = await this.$http.get('users/' + id)
      if (res.meta.status !== 200) {
        return this.$message.error('用户查询失败')
      }
      this.editForm = res.data
      this.editDialogVisible = true
    },
    editDialogClose () {
      this.$refs.editFormRef.resetFields()
    },
    // 用户修改操作
    editUserInfo () {
      this.$refs.editFormRef.validate(async vaild => {
        if (!vaild) return
        const { data: res } = await this.$http.put('users/' + this.editForm.id, {
          email: this.editForm.email,
          mobile: this.editForm.mobile
        })
        if (res.meta.status !== 200) {
          this.$message.error('用户修改失败')
        }
        this.$message.success('修改成功')
        this.editDialogVisible = false
        this.getUserList()
      })
    },
    async removeUserById (id) {
      const confirmResult = await this.$confirm('此操作将永久删除该用户, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).catch(err => err)
      if (confirmResult !== 'confirm') {
        return this.$message.info('已取消删除')
      }
      const { data: res } = await this.$http.delete('users/' + id)
      if (res.meta.status !== 200) {
        this.$message.error('删除用户失败')
      }
      this.$message.success('删除用户成功')
      this.getUserList()
    },
    async setRole (userInfo) {
      this.userInfo = userInfo
      const { data: res } = await this.$http.get('roles')
      if (res.meta.status !== 200) {
        return this.$message.error('获取角色列表失败')
      }
      this.rolesList = res.data
      this.setRoleDialogVisible = true
    },
    async saveRoleInfo () {
      if (!this.selectedRoleId) {
        return this.$message.error('请选择分配角色')
      }
      const { data: res } = await this.$http.put(`users/${this.userInfo.id}/role`, {
        rid: this.selectedRoleId
      })
      if (res.meta.status !== 200) {
        return this.$message.error('更新角色失败')
      }
      this.$message.success('更新角色成功')
      this.getUserList()
      this.setRoleDialogVisible = false
    },
    setRoleDialogClosed () {
      this.selectedRoleId = ''
      this.userInfo = {}
    }
  }
}
</script>
<style lang="less" scoped>
</style>
