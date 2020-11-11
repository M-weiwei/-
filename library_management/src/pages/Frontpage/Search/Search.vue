<template>
  <div>
    <div class="container">
      <div class="w3ls-title"
           v-if="searchList.length!==0">
        <h3>以为您找到以下图书</h3>
      </div>
      <div v-else>
        <div class="w3ls-titles">
          <h3>抱歉，没有找到您要的书籍</h3>
        </div>
        <Hot></Hot>
      </div>
      <div class="hot_books">
        <el-row>
          <el-col :span='6'
                  class="hot_books_item"
                  v-for="(item,i) in searchList"
                  :key="i">
            <img src="../Home/images/g3.jpg"
                 alt="">
            <h5><a href="">{{item.bookName |bookname}}</a></h5>
            <p>{{item.bookIntroduction|text}}</p>
          </el-col>
        </el-row>
      </div>
    </div>
  </div>
</template>

<script>
import Hot from '../../../components/Hot/Hot'

import { mapState } from 'vuex'
export default {
  data () {
    return {

    }
  },
  methods: {},
  created () {
  },
  mounted () {
  },

  computed: {
    ...mapState(['searchList'])
  },
  components: {
    Hot
  }
}

</script>
<style lang='stylus' scoped>
.w3ls-title
  margin 50px 0
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
.w3ls-titles
  text-align center
  margin 50px 0
.w3ls-titles h3
  color red
  font-size 3em
  font-weight 700
  margin-bottom 0.8em
  text-transform capitalize
  border-left 5px solid red
  padding-left 0.6em
  line-height 0.9em
  display inline-block
.hot
  padding 30px 0
</style>
