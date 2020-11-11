<template>
  <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/home' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>书籍</el-breadcrumb-item>
      <el-breadcrumb-item>录入书籍</el-breadcrumb-item>
    </el-breadcrumb>
    <el-card>
      <!-- 信息 -->
      <el-alert title="添加书籍信息"
                type="info"
                center
                show-icon
                :closable="false">
      </el-alert>
      <!-- 步骤条 -->
      <el-steps :active="activeIndex - 0"
                finish-status="success"
                align-center>
        <el-step title="基本信息"></el-step>
        <el-step title="书籍图片"></el-step>
        <el-step title="完成"></el-step>
      </el-steps>
      <el-form :model="addForm"
               :rules="addFormRules"
               ref="addFormRef"
               label-width="100px"
               label-position="top">
        <el-tabs v-model="activeIndex"
                 :tab-position="'left'">
          <el-tab-pane label="基本信息"
                       name="0">
            <el-form-item label="书名"
                          prop="goods_name">
              <el-input v-model="addForm.goods_name"></el-input>
            </el-form-item>
            <el-form-item label="作者"
                          prop="goods_author">
              <el-input v-model="addForm.goods_author"></el-input>
            </el-form-item>
            <el-form-item label="发布日期">
              <el-date-picker type="date"
                              placeholder="选择日期"
                              v-model="addForm.date"
                              style="width: 100%;"
                              format="yyyy 年 MM 月 dd 日"
                              value-format="yyyy-MM-dd"></el-date-picker>
            </el-form-item>
            <el-form-item label="库存"
                          prop="goods_number">
              <el-input v-model="addForm.goods_number"
                        type="number"></el-input>
            </el-form-item>
            <el-form-item label="书籍分类"
                          prop="goods_cat">
              <el-select v-model="value"
                         @change="select(value)"
                         placeholder="请选择"
                         multiple>
                <el-option v-for="item in options"
                           :key="item.bookClassId"
                           :label="item.bookClassName"
                           :value="item.bookClassId">
                </el-option>
              </el-select>
            </el-form-item>
          </el-tab-pane>

          <el-tab-pane label="书籍图片"
                       name="2">
            <!-- action 表示图片要上传到的后台API地址 -->
            <el-upload :action="uploadURL"
                       :on-preview="handlePreview"
                       :on-remove="handleRemove"
                       list-type="picture"
                       :on-success="handleSuccess"
                       with-credentials>
              <el-button size="small"
                         type="primary">点击上传</el-button>
            </el-upload>
          </el-tab-pane>
          <el-tab-pane label="书籍详情"
                       name="3">
            <!-- 富文本编辑器组件 -->
            <quill-editor v-model="addForm.goods_introduce"></quill-editor>
            <!-- 添加商品的按钮 -->
            <el-button type="primary"
                       class="btnAdd"
                       @click="add">添加商品</el-button>
          </el-tab-pane>
        </el-tabs>
      </el-form>
    </el-card>
    <el-dialog title="图片预览"
               :visible.sync="previewVisible"
               width="50%">
      <img :src="previewPath"
           alt=""
           class="previewImg">
    </el-dialog>
  </div>
</template>

<script>
export default {
  data () {
    return {
      activeIndex: '0',
      addForm: {
        //商品名
        goods_name: '',
        // 商品作者
        goods_author: '',
        // 商品数量
        goods_number: '',
        // 商品时间
        date: '',
        // 商品所属的分类数组
        goods_cat: [],
        // 图片的数组
        pics: '',
        // 商品的详情描述
        goods_introduce: '',
      },
      addFormRules: {
        goods_name: [
          { required: true, message: '请输入图书名称', trigger: 'blur' }
        ],
        goods_author: [
          { required: true, message: '请输入图书作者', trigger: 'blur' }

        ],
        goods_number: [
          { required: true, message: '请输入图书数量', trigger: 'blur' }
        ],
        goods_cat: [
          { required: true, message: '请选择图书分类', trigger: 'blur' }
        ]
      },
      previewVisible: false,
      previewPath: '',
      catelist: [],
      uploadURL: 'http://localhost:3000/demo/demo/interfaces/getImg.php',
      options: [],
      value: ''

    }
  },
  async created () {
    const { data: res } = await this.$http.get('demo/interfaces/index.php', { params: { type: '1' } })
    this.options = res
    console.log(res)
  },
  mounted () { },
  methods: {
    handlePreview (file) {
      console.log(file)
      this.previewPath = file.response.data.url
      this.previewVisible = true
    },
    handleSuccess (response) {
      console.log(response)
      // 1. 拼接得到一个图片信息对象
      // 2. 将图片信息对象，push 到pics数组中
      this.addForm.pics = response
      console.log(this.addForm)
    },
    handleRemove (file) {
      console.log(file)
      // 1. 获取将要删除的图片的临时路径
      this.addForm.pics = ''
      //   const filePath = file.response
      //   // 2. 从 pics 数组中，找到这个图片对应的索引值
      //   const i = this.addForm.pics.findIndex(x => x.pic === filePath)
      //   // 3. 调用数组的 splice 方法，把图片信息对象，从 pics 数组中移除
      //   this.addForm.pics.splice(i, 1)
      console.log(this.addForm)
    },
    add () {
      this.$refs.addFormRef.validate(async valid => {
        if (!valid) {
          return this.$message.error('请填写图书信息！')
        }
        console.log(this.addForm);
        const { data: res } = await this.$http.get('demo/interfaces/setBook.php', { params: this.addForm })
        console.log(res);

      })
      //   const { data: res } = await this.$http.get('demo/interfaces/setBook.php', { params:})
    },
    select (value) {
      this.addForm.goods_cat = value
    }
  }
}
</script>

<style scoped lang="stylus">
.el-checkbox
  margin 0 10px 0 0 !important
.previewImg
  width 100%
.btnAdd
  margin-top 15px
.input[type='file']
  display none
  z-index 999999
</style>
