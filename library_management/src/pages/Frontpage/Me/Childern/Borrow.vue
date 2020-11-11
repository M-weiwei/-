<template>
  <div>
    <el-card>
      <div class="hot_books">
        <el-row v-if="borrowList.length!==0">
          <el-col :span='6'
                  class="hot_books_item"
                  v-for="(item,i) in borrowList"
                  :key="i">
            <img :src="item.bookImg"
                 alt="">
            <h5><a href="">{{item.bookName|bookname}}</a></h5>
            <p>借阅时间：{{item.lesaseorderRantalTime}}</p>
            <p>归还时间：{{item.lesaseorderReturnTime}}</p>
          </el-col>
        </el-row>
        <el-row v-else>
          <el-col :sapn='24'
                  class="noBorrow">
            您还没有借阅书籍
          </el-col>
        </el-row>
      </div>
    </el-card>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data () {
    return {
      borrowList: []
    }
  },
  methods: {},
  async created () {
    const { data: res } = await this.$http.get('demo/interfaces/getjieyue.php', {
      params: {
        userId: this.userInfo.userId
      }
    })
    this.borrowList = res
    console.log(res)
  },
  computed: {
    ...mapState(['userInfo'])
  }
}

</script>
<style lang='stylus' scoped>
.hot_books
  .hot_books_item
    padding 10px 15px
  img
    width 100%
    height auto
  h5
    margin 10px 0
  a
    font-size 1.3em
    color #01edc9
    letter-spacing 1px
    text-transform capitalize
    text-decoration none
    font-weight 600
  p
    font-size 1em
    color #999
    line-height 1.8em
    margin 10px 0
.noBorrow
  display flex
  justify-content center
  align-items center
  font-size 25px
  color #01edc9
</style>
