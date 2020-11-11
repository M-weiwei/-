<template>
  <div>
    <!-- 面包屑导航 -->
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/admin' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>商品管理</el-breadcrumb-item>
      <el-breadcrumb-item>商品分类</el-breadcrumb-item>
    </el-breadcrumb>
    <el-card>
      <!-- 按钮 -->
      <el-row>
        <el-col>
          <el-button type='primary'
                     @click="showAddCateDialog">添加分类</el-button>
        </el-col>
      </el-row>
      <!-- 表格区域 -->
      <tree-table :data='cateList'
                  :columns='columns'
                  :selection-type='false'
                  :expand-type='false'
                  show-index
                  index-text='#'
                  border
                  :show-row-hover='false'
                  class="treeTable">
        <template slot="isOk"
                  slot-scope="scope">
          <!-- 是否有效 -->
          <i class="el-icon-success"
             v-if="scope.row.cat_deleted===false"
             style="color:lightgreen"></i>
          <i class="el-icon-error"
             v-else
             style="color:red"></i>
        </template>
        <template slot="order"
                  slot-scope="scope">
          <!-- 排序 -->
          <el-tag size='mini'
                  v-if="scope.row.cat_level===0">一级</el-tag>
          <el-tag size='mini'
                  type='success'
                  v-else-if="scope.row.cat_level===1">二级</el-tag>
          <el-tag size='mini'
                  type='warning'
                  v-else>三级</el-tag>
        </template>
        <template slot="opt"
                  slot-scope="scope">
          <el-button size='mini'
                     type="primary"
                     icon="el-icon-edit"
                     @click="showEditDialog(scope.row.cat_id)">编辑</el-button>
          <el-button size='mini'
                     type="danger"
                     icon="el-icon-delete"
                     @click='removeCateById(scope.row.cat_id)'>删除 </el-button>
        </template>
      </tree-table>
      <!-- 分页区域 -->
      <el-pagination @size-change="handleSizeChange"
                     @current-change="handleCurrentChange"
                     :current-page="queryInfo.pagenum"
                     :page-sizes="[3,5, 10, 15]"
                     :page-size="queryInfo.pagesize"
                     layout="total, sizes, prev, pager, next, jumper"
                     :total="total">
      </el-pagination>
    </el-card>
    <!-- 添加分类对话框 -->
    <el-dialog title="添加分类"
               :visible.sync="addCatedialogVisible"
               width="50%"
               @close='addCateDialogClosed'>
      <!-- 添加分类 -->
      <el-form :model="addCateForm"
               :rules="addCateFormRules"
               ref="addCateFormRef"
               label-width="100px">
        <el-form-item label="分类名称："
                      prop="cat_name">
          <el-input v-model="addCateForm.cat_name"></el-input>
        </el-form-item>
        <el-form-item label="父级分类：">
          <el-cascader v-model="selectedKeys"
                       :options="parentCateList"
                       :props="cacscaderProps"
                       expandTrigger='hover'
                       clearable
                       @change="parentCateChange"></el-cascader>
        </el-form-item>
      </el-form>
      <span slot="footer"
            class="dialog-footer">
        <el-button @click="addCatedialogVisible = false">取 消</el-button>
        <el-button type="primary"
                   @click="addCate">确 定</el-button>
      </span>
    </el-dialog>
    <!-- 编辑分类对话框 -->
    <el-dialog title="编辑分类"
               :visible.sync="showCatedialogVisible"
               width="50%"
               @close='addCateDialogClosed'>
      <!-- 添加分类 -->
      <el-form :model="showCateForm"
               :rules="addCateFormRules"
               ref="addCateFormRef"
               label-width="100px">
        <el-form-item label="分类名称："
                      prop="cat_name">
          <el-input v-model="showCateForm.cat_name"></el-input>
        </el-form-item>
      </el-form>
      <span slot="footer"
            class="dialog-footer">
        <el-button @click="showCatedialogVisible = false">取 消</el-button>
        <el-button type="primary"
                   @click="showCate">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>
<script>
export default {
  data () {
    return {
      // 设置当前显示的页码数
      queryInfo: {
        type: 3,
        pagenum: 1,
        pagesize: 5
      },
      cateList: [],
      total: 0,
      columns: [{
        label: '分类名称',
        prop: 'cat_name'
      }, {
        label: '是否有效',
        type: 'template',
        template: 'isOk'
      }, {
        label: '排序',
        type: 'template',
        template: 'order'
      }, {
        label: '操作',
        type: 'template',
        template: 'opt'
      }],
      addCatedialogVisible: false,
      addCateForm: {
        cat_name: '',
        cat_pid: 0,
        cat_level: 0
      },
      addCateFormRules: {
        cat_name: [{
          required: true, message: '请输入分类名称', trigger: 'blur'
        }]
      },
      parentCateList: [],
      // 指定级联选择器的配置对象
      cacscaderProps: {
        value: 'cat_id',
        label: 'cat_name',
        children: 'children',
        checkStrictly: true

      },
      // 指定级联选择器的分类id数组
      selectedKeys: [],
      // 编辑对话框控制
      showCatedialogVisible: false,
      // 编辑分类表单数据
      showCateForm: {
        cat_name: ''
      }
    }
  },
  created () {
    this.getcCateList()
  },
  methods: {
    async getcCateList () {
      const { data: res } = await this.$http.get('categories', { params: this.queryInfo })
      if (res.meta.status !== 200) {
        return this.$message.error('获取商品分类列表失败')
      }
      this.cateList = res.data.result
      this.total = res.data.total
    },
    handleSizeChange (newSize) {
      // 监听一页显示多少数据
      this.queryInfo.pagesize = newSize
      this.getcCateList()
    },
    handleCurrentChange (newPage) {
      this.queryInfo.pagenum = newPage
      this.getcCateList()
    },
    showAddCateDialog () {
      this.getParentCateList()
      this.addCatedialogVisible = true
    },
    // 获取父级分类列表
    async  getParentCateList () {
      const { data: res } = await this.$http.get('categories', { params: { type: 2 } })
      if (res.meta.status !== 200) {
        return this.$message.error('获取父级分类列表失败')
      }
      this.parentCateList = res.data
    },
    parentCateChange () {
      if (this.selectedKeys.length > 0) {
        if (this.selectedKeys.length > 0) {
          this.addCateForm.cat_pid = this.selectedKeys[this.selectedKeys.length - 1]
          this.addCateForm.cat_level = this.selectedKeys.length
        }
      } else {
        this.addCateForm.cat_pid = 0
        this.addCateForm.cat_level = 0
      }
    },
    // 对话框关闭时重置表单
    addCateDialogClosed () {
      this.$refs.addCateFormRef.resetFields()
      this.selectedKeys = []
      this.addCateForm.cat_pid = 0
      this.addCateForm.cat_level = 0
    },
    // 点击对话框提交
    addCate () {
      this.$refs.addCateFormRef.validate(async vaild => {
        if (!vaild) return
        const { data: res } = await this.$http.post('categories', this.addCateForm)
        if (res.meta.status !== 201) {
          return this.$message.error('添加分类失败')
        }
        this.$message.success('添加分类成功')
        this.getcCateList()
        this.addCatedialogVisible = false
      })
    },
    // 编辑点击事件
    async showEditDialog (id) {
      const { data: res } = await this.$http.get('categories/' + id)
      if (res.meta.status !== 200) {
        return this.$message.error('获取分类数据失败')
      }
      this.showCateForm = res.data
      this.showCatedialogVisible = true
    },
    async showCate () {
      const { data: res } = await this.$http.put('categories/' + this.showCateForm.cat_id, { cat_name: this.showCateForm.cat_name })
      if (res.meta.status !== 200) {
        return this.$message.error('更改分类失败')
      }
      this.$message.success('更改成功')
      this.getcCateList()
      this.showCatedialogVisible = false
    },
    // 删除点击操作
    async removeCateById (id) {
      const confirmResult = await this.$confirm('此操作将永久删除分类, 是否继续?', '提示', {
        confirmButtonText: '确定',
        cancelButtonText: '取消',
        type: 'warning'
      }).catch(err => err)
      if (confirmResult !== 'confirm') {
        return this.$message.info('已取消删除')
      }
      const { data: res } = await this.$http.delete('categories/' + id)
      if (res.meta.status !== 200) {
        this.$message.error('删除分类失败')
      }
      this.$message.success('删除分类成功')
      this.getcCateList()
    }

  }
}
</script>
<style lang="less" scoped>
.treeTable {
  margin: 15px 0 15px 0;
}
.el-cascader {
  width: 100%;
}
</style>
