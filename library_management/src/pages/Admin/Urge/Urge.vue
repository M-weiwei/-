<template>
  <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/home' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>书籍</el-breadcrumb-item>
      <el-breadcrumb-item>催促还书</el-breadcrumb-item>
    </el-breadcrumb>
    <el-card>
      <el-form ref="form"
               :model="form"
               label-width="80px">
        <el-form-item label="书号">
          <el-input v-model="form.bookId"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary"
                     @click="confirmbooks">确认借书</el-button>
          <el-button type="primary"
                     @click="stillBooks">确认还书</el-button>
        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
export default {
  data () {
    return {
      form:
      {
        bookId: '',
      }
      ,

    }
  },
  created () {
  },
  mounted () { },
  methods: {
    async confirmbooks () {
      const { data: res } = await this.$http.get('demo/interfaces/jieshu.php', { params: { lesaseorderId: this.form.bookId, type: '1' } })
      this.$message.success('借书成功')

    },
    async stillBooks () {
      const { data: res } = await this.$http.get('demo/interfaces/jieshu.php', { params: { lesaseorderId: this.form.bookId, type: '2' } })
      this.$message.success('还书成功')

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
