<template>
  <div>
    <div class="banner"></div>
    <div class="portfolio">
      <div class="container">
        <div class="w3ls-title">
          <h3>图书分类</h3>
        </div>
        <el-breadcrumb separator="/">
          <el-breadcrumb-item>
            <el-button type="text"
                       @click="filt = 'all'">全部</el-button>
          </el-breadcrumb-item>
          <el-breadcrumb-item v-for="(item,i) in product"
                              :key="i">
            <el-button type="text"
                       @click="filt = item">{{item}}</el-button>
          </el-breadcrumb-item>

          <el-breadcrumb-item>
            <el-button type="text"
                       @click="shuffle">随机</el-button>
          </el-breadcrumb-item>
        </el-breadcrumb>
        <div class="colored"
             v-loading="loading"
             element-loading-text="拼命加载中"
             element-loading-spinner="el-icon-loading">
          <transition-group name="list-complete"
                            tag="p">
            <span v-for="item in filteredItems"
                  v-bind:key="item.bookId"
                  class="list-complete-item block "
                  :class="item.bookClassification">
              <div class="hover ehover14">
                <img :src="item.bookImg"
                     alt="">
                <div class="overlay">
                  <h4>{{item.bookName|bookname}}</h4>
                  <div class="info nullbutton button"
                       @click="$router.push('/details/'+item.bookId)">查看详情</div>
                </div>
              </div>
            </span>
          </transition-group>
        </div>
      </div>
      <div class="car">
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

export default {
  data () {
    return {
      filt: 'all',
      title: 'Colored filter',
      // 分类
      product: [],
      item: [],
      loading: true,
      queryInfo: {
        pagenum: 1,
        pagesize: 9
      },
      total: 0
    }
  },
  methods: {
    shuffle: function () {
      var currentIndex = this.item.length; var temporaryValue; var randomIndex

      // Тут ф-ция рэндома
      while (currentIndex !== 0) {
        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex)
        currentIndex -= 1

        // And swap it with the current element.
        temporaryValue = this.item[currentIndex]
        this.item[currentIndex] = this.item[randomIndex]
        this.item[randomIndex] = temporaryValue
      }

      this.item = this.item.reverse()
    },
    //获取书籍列表
    async _getBookList () {
      const { data: rea } = await this.$http.get('demo/interfaces/showBook.php', { params: { page: this.queryInfo.pagenum } })
      console.log(rea)
      this.item = rea.bookList
      this.total = parseInt(rea.con)
      this.loading = false
    },
    handleCurrentChange (newPage) {
      console.log(newPage)
      this.queryInfo.pagenum = newPage
      this._getBookList()
    },

  },
  computed: {
    filteredItems: function () {
      console.log(this.filt)

      var result

      if (this.filt !== 'all') {
        var filt = this.filt
        // result = this.item.filter(function (a) {
        //   a.bookClassification.forEach(element => {
        //     return element === filt
        //   })
        //   return filt
        // })
        var indes = []
        indes = this.item.map(element => {
          if (element.bookClassification instanceof Array) {
            var a = element.bookClassification.join(',')
            element.bookClassification = a
            return element
          } else {
            return element
          }
        })

        result = indes.filter(book => {
          var flag = book.bookClassification.indexOf(filt) !== -1
          return flag
        })
      } else {
        result = this.item
      }

      return result
    }
  },
  async created () {
    // 页面上来获取分类数据
    const { data: res } = await this.$http.get('demo/interfaces/index.php')
    console.log(res)
    this.product = res
    this._getBookList()
  }

}

</script>
<style lang='stylus' scoped >
@import './../../../assets/css/stylus.css'
.banner
  background url('../Home/images/banner.jpg') no-repeat center center
  background-size cover
  min-height 300px
.colored
  max-width 100%
.colored span
  display inline-block
  text-align center
  width 32%
  margin 3px
  background #ccc
/* Colored */
.red
  background #ef5350 !important
.blue
  background #03a9f4 !important
.green
  background #4caf50 !important
.list-complete-item
  transition all 0.7s
  display inline-block
  margin-right 10px
  overflow hidden
  position relative
  cursor default
  &:hover
    opacity 0.8
  &:hover .overlay
    transform scale(1)
  &:hover h4
    -moz-opacity 1
    opacity 1
    -webkit-transform translate3d(0, 0, 0)
    -moz-transform translate3d(0, 0, 0)
    -o-transform translate3d(0, 0, 0)
    -ms-transform translate3d(0, 0, 0)
    transform translate3d(0, 0, 0)
  img
    width 100%
    height auto
    transition all 0.35s
    position relative
  .overlay
    width 80%
    height 35%
    left 10%
    top 12%
    border 6px solid #00b3fe
    -webkit-transition opacity 0.35s, transform 0.35s
    -moz-transition opacity 0.35s, transform 0.35s
    transition opacity 0.35s, transform 0.35s
    padding 2.5em 0
    -webkit-transform scale(0)
    -moz-transform scale(0)
    transform scale(0)
    position absolute
    h4
      text-transform uppercase
      text-align center
      font-size 1.5em
      padding 10px
      letter-spacing 1px
      background-color transparent
      color #FFF
      -moz-opacity 0
      opacity 0
      -webkit-transition opacity 0.5s, -webkit-transform 0.5s
      -moz-transition opacity 0.5s, transform 0.5s
      transition opacity 0.5s, transform 0.5s
      -webkit-transform translate3d(-150%, -400%, 0)
      -moz-transform translate3d(-150%, -400%, 0)
      -o-transform translate3d(-150%, -400%, 0)
      transform translate3d(-150%, -400%, 0)
.list-complete-enter, .list-complete-leave-active
  opacity 0
  transform translateY(30px)
.list-complete-leave-active
  position absolute
.portfolio
  margin 70px 0
.el-breadcrumb
  display flex
  justify-content center
  margin-bottom 30px
  button
    font-size 18px
    color #999
  .el-button--text
    padding 0 10px
.hover
  width 100%
  height 100%
  float left
  overflow hidden
  position relative
  cursor default
.hover .overlay
  width 100%
  height 100%
  position absolute
  overflow hidden
  top 0
  left 0
.hover img
  display block
  position relative
.hover h4
  text-transform uppercase
  color #fff
  text-align center
  position relative
  font-size 1.5em
  padding 10px
  letter-spacing 1px
.hover .button.info
  display inline-block
  text-decoration none
  padding 7px 14px
  color #fff
  border none
  background-color transparent
  font-size 1.1em
  outline none
  font-weight 300
.hover .button.info:hover
  -webkit-box-shadow 0 0 5px #fff
  -moz-box-shadow 0 0 5px #fff
  box-shadow 0 0 5px #fff
.ehover14 img
  -webkit-transition all 0.35s
  -moz-transition all 0.35s
  transition all 0.35s
.ehover14:hover img
  -ms-filter brightness(1.4)
  filter brightness(1.4)
  -webkit-filter brightness(1.4)
.ehover14 .overlay
  -moz-opacity 0
  opacity 0
  width 80%
  height 35%
  left 10%
  top 12%
  border 6px solid #00b3fe
  -webkit-transition opacity 0.35s, transform 0.35s
  -moz-transition opacity 0.35s, transform 0.35s
  transition opacity 0.35s, transform 0.35s
  padding 2.5em 0
  -webkit-transform scale(0)
  -moz-transform scale(0)
  transform scale(0)
  -o-transform scale(0)
  -ms-transform scale(0)
.ehover14:hover .overlay
  background-color rgba(0, 0, 0, 0.71)
.ehover14 .button
  color #FFF
  padding 1em 0
  opacity 0
  -webkit-transition opacity 0.35s, -webkit-transform 0.35s
  -moz-transition opacity 0.35s, transform 0.35s
  transition opacity 0.35s, transform 0.35s
  -webkit-transform translate3d(-150%, -400%, 0)
  -moz-transform translate3d(-150%, -400%, 0)
  -o-transform translate3d(-150%, -400%, 0)
  -ms-transform translate3d(-150%, -400%, 0)
  transform translate3d(-150%, -400%, 0)
.ehover14 h4
  background-color transparent
  color #FFF
  padding 1em 0
  -moz-opacity 0
  opacity 0
  -webkit-transition opacity 0.5s, -webkit-transform 0.5s
  -moz-transition opacity 0.5s, transform 0.5s
  transition opacity 0.5s, transform 0.5s
  -webkit-transform translate3d(-150%, -400%, 0)
  -moz-transform translate3d(-150%, -400%, 0)
  -o-transform translate3d(-150%, -400%, 0)
  transform translate3d(-150%, -400%, 0)
  -ms-transform translate3d(-150%, -400%, 0)
.ehover14:hover .button, .ehover14:hover h4
  -moz-opacity 1
  opacity 1
  -webkit-transform translate3d(0, 0, 0)
  -moz-transform translate3d(0, 0, 0)
  -o-transform translate3d(0, 0, 0)
  -ms-transform translate3d(0, 0, 0)
  transform translate3d(0, 0, 0)
.ehover14:hover .overlay
  -moz-opacity 1
  opacity 1
  -webkit-transform scale(1)
  -moz-transform scale(1)
  transform scale(1)
  -o-transform scale(1)
  -ms-transform scale(1)
.el-breadcrumb
  display flex
  margin 30px
  justify-content center !important
.car
  margin-top 30px
  display flex
  justify-content center
  align-items center
</style>
