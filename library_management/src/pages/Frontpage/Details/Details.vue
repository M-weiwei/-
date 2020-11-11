<template>
  <div>
    <!-- 图书展示区域 -->
    <div class="details_main">
      <div class="w3ls-title">
        <h3>图书详情</h3>
      </div>
      <!-- 图片区域 -->
      <el-row>
        <el-col :span="8">
          <div class="pic_info">
            <div class="pic">
              <a href="">
                <img :src="bookInfo.bookImg"
                     alt="" />
              </a>
            </div>
          </div>
        </el-col>
        <!-- 详情区域 -->
        <el-col :span="14"
                :offset="1">
          <div class="show_info">
            <!-- 图书标题区 -->
            <div class="name_info">
              <h2 v-if="bookInfo.bookName">{{bookInfo.bookName|bookname}}</h2>
              <p v-html="bookInfo.bookIntroduction"></p>
            </div>
            <!-- 图书信息区 -->
            <div class="messbox_info">
              <span>作者：{{bookInfo.bookAuthor}}</span>
              <span>出版社：湖南文艺出版社</span>
              <span>出版时间：{{bookInfo.bookPublishingTime}} </span>
              <div class="pinglun">
                <span>热门榜第一</span>
                <span>当前库存：{{bookInfo.bookInventory}}</span>
              </div>
            </div>
            <!-- 点击预约 -->
            <div class="buy_box_btn">
              <el-button type="danger"
                         @click="books">点击借书</el-button>
            </div>
          </div>
        </el-col>
      </el-row>
      <!-- 评论区域 -->
      <div class="comment">
        <el-tabs v-model="activeName"
                 type="card">
          <el-tab-pane label="评论"
                       name="first">
            <div class="user_commen">
              <el-form ref="form"
                       :model="commentform"
                       :rules="commentFormRules"
                       v-if="userInfo.userId">
                <el-form-item prop="evalua">
                  <el-input type="textarea"
                            v-model="commentform.evalua"
                            placeholder="填写评论"
                            :rows='5'></el-input>
                </el-form-item>
                <el-form-item>
                  <el-button type="primary"
                             @click="onSubmit">点击评论</el-button>
                </el-form-item>
              </el-form>
              <div class="commentLogin"
                   v-else>
                您还未登录，请<a href=""
                   @click.prevent="$router.push('/login')">登录</a>
              </div>
            </div>
            <div class="comment_info">
              <div v-if="evaluation.length!==0">
                <div class="cooment_box"
                     v-for="(evalu,i) in evaluation"
                     :key="i">
                  <div class="name">{{evalu.userName}}</div>
                  <p>{{evalu.Evaluatione}}</p>
                  <span>{{evalu.evaluationTime}}</span>
                </div>
              </div>
              <div class="noComment"
                   v-else>
                这本书还没有评论哦
              </div>
            </div>
          </el-tab-pane>
        </el-tabs>
        <el-pagination @current-change="handleCurrentChange"
                       :current-page="queryInfo.pagenum"
                       background
                       :page-size='queryInfo.pagesize'
                       layout="total,  prev, pager, next, jumper"
                       :total="total">
        </el-pagination>
      </div>
    </div>

  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  props: ['id'],

  data () {
    return {
      activeName: 'first',
      bookInfo: {},
      evaluation: [],
      commentform: {
        evalua: ''
      },
      commentFormRules: {
        evalua: [
          { required: true, message: '请输入评论内容', trigger: 'blur' },
          { min: 3, message: '至少输入6个字符', trigger: 'blur' }
        ]
      },
      queryInfo: {
        pagenum: 1,
        pagesize: 10
      },
      total: 0
    }
  },
  methods: {
    async books () {
      // 点击借书
      const { data: res } = await this.$http.get('demo/interfaces/cyuyuejieshu.php', { params: { bookId: this.id, userId: this.userInfo.userId } })
      console.log(res)
      if (res === 300) {
        return this.$message.error('您在排队中')
      } else if (!this.userInfo.userId) {
        this.$message.error('请先登录')
        this.$router.push('/login')
        return
      } else if (res !== 301) {
        return this.$message.error('借书失败')
      }
      this.$message.success('借书成功')
    },
    onSubmit () {
      // 点击提交评论
      this.$refs.form.validate(async valid => {
        if (!valid) {
          return this.$message.error('请填写评论！')
        }
        const { data: res } = await this.$http.get('demo/interfaces/evalua.php', {
          params: {
            bookId: this.id, userId: this.userInfo.userId, evalua: this.commentform.evalua, type: '1'
          }
        })
        this.$message.success('评论成功')
        this.$refs.form.resetFields()
        this._getbooks()
        console.log(res)
      })
    },
    async _getbooks () {
      // 根据书id查找书信息
      const { data: res } = await this.$http.get('demo/interfaces/detail.php', { params: { bookId: this.id, page: this.queryInfo.pagenum } })
      console.log(res)
      this.bookInfo = res.bookinfo
      this.total = parseInt(res.con)
      if (res.evaluation !== 0) {
        this.evaluation = res.evaluation.reverse()
      }
    },
    // handleSizeChange (newSize) {
    //   this.queryInfo.pagesize = newSize
    //   this.getUserList()
    // },
    handleCurrentChange (newPage) {
      console.log(newPage)
      this.queryInfo.pagenum = newPage
      this._getbooks()
    }
  },
  created () {
    this._getbooks()
  },
  computed: {
    ...mapState(['userInfo'])
  }

}
</script>
<style lang="stylus" scoped>
@import './../../../assets/css/stylus.css'
.w3ls-title
  margin-bottom 50px
.details_main
  width 1140px
  margin auto
  padding 50px 0
  .pic_info
    .pic
      img
        width 100%
        height auto
  .show_info
    .name_info
      h2
        margin-bottom 10px
      p
        color #636569
        font-size 18px
        margin-bottom 10px
    .messbox_info
      span
        font-size 14px
        margin-right 20px
        color #999
    .buy_box_btn
      margin-top 50px
  .comment
    margin-top 50px
    .cooment_box
      padding 20px 0
      border-bottom 1px solid #ccc
      .name
        font-size 20px
        margin-bottom 15px
      p
        color #646464
        font-size 14px
        margin-bottom 15px
      span
        color #646464
        font-size 14px
    .noComment
      display flex
      justify-content center
      align-items center
      padding 20px 0
      border-bottom 1px solid #ccc
      font-size 25px
      color #01edc9
.el-form
  border-bottom 1px solid #ccc
.commentLogin
  font-size 25px
  letter-spacing 5px
  display flex
  justify-content center
  border-bottom 1px solid #ccc
  padding-bottom 20px
  a
    text-decoration none
    color #409eff
.el-pagination
  display flex
  justify-content center
  margin-top 50px
</style>
