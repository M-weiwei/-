<template>
  <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/admin' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>用户</el-breadcrumb-item>
      <el-breadcrumb-item>用户管理</el-breadcrumb-item>
    </el-breadcrumb>
    <el-card>
      <el-table :data="userlist"
                border
                stripe>
        <el-table-column type="index"
                         label="#"></el-table-column>
        <el-table-column label="姓名"
                         prop="userName"></el-table-column>
        <el-table-column label="邮箱"
                         prop="userEmail"></el-table-column>
        <el-table-column label="学号"
                         prop="userStuld"></el-table-column>
        <el-table-column label="状态">
          <!-- 作用域插槽 -->
          <template slot-scope="scope">
            <el-switch v-model="scope.row.userType"
                       active-color="#13ce66"
                       inactive-color="#ff4949"
                       active-value='0'
                       inactive-value='1'
                       @change="usertype($event,scope.row)"> </el-switch>
          </template>
        </el-table-column>
      </el-table>
      <div class="car">
        <el-pagination @current-change="handleCurrentChange"
                       :current-page="queryInfo.pagenum"
                       background
                       :page-size='queryInfo.pagesize'
                       layout="total,  prev, pager, next, jumper"
                       :total="total">
        </el-pagination>
      </div>
    </el-card>
  </div>
</template>

<script>
export default {
  data () {
    return {
      value: false,
      userlist: [],
      queryInfo: {
        pagenum: 1,
        pagesize: 10
      },
      total: 0
    }
  },
  async created () {
    this._getuserlist()
  },
  mounted () { },
  methods: {
    async _getuserlist () {
      const { data: res } = await this.$http.get('demo/interfaces/userList.php', { params: { page: this.queryInfo.pagenum } })
      console.log(res)
      this.userlist = res.list
      this.total = parseInt(res.con)
    },
    handleCurrentChange (newPage) {
      console.log(newPage)
      this.queryInfo.pagenum = newPage
      this._getuserlist()
    },
    async usertype ($event, user) {
      const { data: res } = await this.$http.get('demo/interfaces/userType.php', { params: { userId: user.userId, type: $event } })
      console.log(res);
      this.$message.success('修改成功')
      this._getuserlist()

    }
  }
}
</script>

<style scoped lang="stylus">
.car
  display flex
  justify-content center
  align-items center
</style>
