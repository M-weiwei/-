<template>
  <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/home' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>书籍</el-breadcrumb-item>
      <el-breadcrumb-item>销毁书籍</el-breadcrumb-item>
    </el-breadcrumb>
    <el-card>
      <el-form ref="form"
               :model="form"
               label-width="80px">
        <el-form-item label="报损书号">
          <el-input v-model="form.bookId"></el-input>
        </el-form-item>
        <el-form-item label="报损原因">
          <el-input type="textarea"
                    v-model="form.damageReason"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary"
                     @click="removeBooks">销毁</el-button>

        </el-form-item>
      </el-form>
    </el-card>
  </div>
</template>

<script>
export default {
  data () {
    return {
      form: {
        bookId: '',
        userId: '4',
        damageReason: ''
      }
    }
  },
  created () { },
  mounted () { },
  methods: {
    async removeBooks () {
      const confirmResult = await this.$confirm('此操作将永久删除该用户, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).catch(err => err)
      console.log(confirmResult)
      if (confirmResult !== 'confirm') {
        return this.$message.info('已取消删除')
      }
      const { data: res } = await this.$http.get('demo/interfaces/damage.php', { params: this.form })
      console.log(res)
    }
  }
}
</script>

<style scoped lang="stylus"></style>
