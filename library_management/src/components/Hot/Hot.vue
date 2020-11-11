<template>
  <div class="hot">
    <div class="container">
      <div class="w3ls-title">
        <h3>热门推荐</h3>
      </div>
      <div class="hot_books">
        <el-row>
          <el-col :span='6'
                  class="hot_books_item"
                  v-for="(item,i) in hotList"
                  :key="i">
            <img src="./../../pages/Frontpage/Home/images/g3.jpg"
                 alt="">
            <h5><a href=""
                 @click.prevent="$router.push('/details/'+item.bookId)">{{item.bookName|bookname}}</a></h5>
            <p>{{item.bookIntroduction|text}}</p>
          </el-col>
        </el-row>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  data () {
    return {

    }
  },
  methods: {

  },
  mounted () {
    this.$store.dispatch('GetHotList')
  },
  computed: {
    ...mapState(['hotList'])

  }
}

</script>
<style lang='stylus' scoped>
.hot
  padding 70px 0
  .hot_books
    margin-top 40px
  .hot_books_item
    padding 0 15px
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
</style>
