<template>
  <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/admin' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>用户</el-breadcrumb-item>
      <el-breadcrumb-item>用户认证 </el-breadcrumb-item>
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
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-button type="primary"
                       icon="el-icon-check"
                       size="mini"
                       @click="agree(scope.row)">同意</el-button>
            <el-button type="danger"
                       icon="el-icon-close"
                       size="mini"
                       @click="reject(scope.row)">驳回</el-button>
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
      userlist: [],
      queryInfo: {
        pagenum: 1,
        pagesize: 10
      },
      total: 0
    }
  },
  created () {
    this._getuserlist()

  },
  mounted () { },
  methods: {
    async _getuserlist () {
      const { data: res } = await this.$http.get('demo/interfaces/stuList.php', { params: { page: this.queryInfo.pagenum } })
      console.log(res)
      this.userlist = res.list
      this.total = parseInt(res.con)
    },
    handleCurrentChange (newPage) {
      console.log(newPage)
      this.queryInfo.pagenum = newPage
      this._getuserlist()
    },
    async agree (userMarking) {
      const { data: res } = await this.$http.get('demo/interfaces/makin.php', { params: { userId: userMarking.userId, type: '2' } })
      this.$message.success('已同意')

      this._getuserlist()

      console.log(res);
    },
    async reject (userMarking) {
      const { data: res } = await this.$http.get('demo/interfaces/makin.php', { params: { userId: userMarking.userId, type: '0' } })

      this.$message.success('已驳回')

      this._getuserlist()

      console.log(res);
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
