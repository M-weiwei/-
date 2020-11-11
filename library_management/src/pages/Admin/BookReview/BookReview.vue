<template>
  <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/home' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>书评</el-breadcrumb-item>
      <el-breadcrumb-item>催促还书</el-breadcrumb-item>
    </el-breadcrumb>
    <el-card>
      <el-table :data="reviewlist"
                border
                stripe>
        <el-table-column type="index"
                         label="#"></el-table-column>
        <el-table-column label="用户id"
                         prop="userId"></el-table-column>
        <el-table-column label="评论内容"
                         prop="Evaluatione"></el-table-column>
        <el-table-column label="评论时间"
                         prop="evaluationTime"></el-table-column>
        <el-table-column label="有无敏感词汇"
                         prop="sensitive"></el-table-column>
        <el-table-column label="操作">
          <!-- 作用域插槽 -->
          <template slot-scope="scope">
            <el-switch v-model="scope.row.evaluationtype"
                       active-color="#13ce66"
                       inactive-color="#ff4949"
                       active-value='1'
                       inactive-value='0'
                       @change="changeEvaluationtype($event,scope.row)"> </el-switch>
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
      reviewlist: [],
      queryInfo: {
        pagenum: 1,
        pagesize: 10
      },
      total: 0
    }
  },
  created () {
    this._getreview()
  },
  mounted () { },
  methods: {
    handleCurrentChange (newPage) {
      console.log(newPage)
      this.queryInfo.pagenum = newPage
      this._getreview()
    },
    async _getreview () {
      const { data: res } = await this.$http.get('demo/interfaces/evaluaList.php', { params: { page: this.queryInfo.pagenum } })
      console.log(res)
      // console.log("aaabbbaaaaaaa".match(/ags/g));
      var indes = []
      indes = res.list.map((item, i) => {
        if (item.Evaluatione.indexOf('妈') === 0) {
          res.list[i].sensitive = '有'
          return item
        } else if (item.Evaluatione.indexOf('草') === 0) {
          res.list[i].sensitive = '有'
          return item
        } else {
          res.list[i].sensitive = '无'
          return item
        }
      })
      this.reviewlist = indes
      this.total = parseInt(res.con)
    },
    async changeEvaluationtype ($event, evaluatid) {
      const { data: res } = await this.$http.get('demo/interfaces/auditEvaluation.php', { params: { evaluationId: evaluatid.evaluationId, type: $event } })
      console.log(res);
      this.$message.success('修改成功')
      this._getreview()

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
