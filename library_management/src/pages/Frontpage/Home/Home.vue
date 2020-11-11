<template>
  <div>

    <!-- 轮播图 -->
    <el-carousel height="716px"
                 direction="vertical"
                 :autoplay="false">
      <el-carousel-item v-for="item in 3"
                        :key="item">
        <h6 class="medium">欢迎到来</h6>
        <h3>图书管理系统</h3>
      </el-carousel-item>
    </el-carousel>
    <!-- 简介部分 -->
    <div class="brief">
      <el-row>
        <el-col :span='12'>
          <div class="welcome-grids">
            <div class="welcome-grids-items">
              <div class="service-box">
                <i class="el-icon-document-copy"></i>
              </div>
              <p>最优秀的图书管理中心</p>
            </div>
          </div>
          <div class="welcome-grids">
            <div class="welcome-grids-items">
              <div class="service-box">
                <i class="el-icon-s-custom"></i>
              </div>
              <p>24小时客服在线</p>
            </div>
            <div class="welcome-grids-items">
              <div class="service-box">
                <i class="el-icon-monitor"></i>
              </div>
              <p>电脑任意观看</p>
            </div>
          </div>
        </el-col>
        <el-col :span='12'>
          <div class="brief_text">
            <h3>欢迎进入</h3>
            <h4>《图书馆》杂志1973年创刊，由湖北图书馆、湖北省图书馆学会主办。1983年正式向全国公开发行月刊</h4>
            <p>《图书馆 》在中国图书馆学会举办的评奖活动中次次被评为优秀期刊，在全国核心期刊评选中连续被评为核心期刊。《图书馆》是一本综合性的图书馆期刊，面向广大图书情报资料工作者，在国内外具有广泛影响。它内容包括图学书馆学、目录学、情报学研究等，设有图书馆事业建设、图书馆业务探讨和书评、书林清话等栏目，兼具学术性、知识性和普及性，务实求新是它的特色。
            </p>
          </div>
        </el-col>
      </el-row>
    </div>
    <!-- 认证部分 -->
    <div class="testimonials">
      <div class="container">
        <div class="wls-title">
          <h3>官方认证</h3>
        </div>
        <div class="slidw-agileits">
          <el-row>
            <el-col :span='8'>
              <h4>地理位置</h4>
              <p>武汉图书馆位于武汉市江汉区建设大道，是全国首批古籍重点保护单位、全国首批“数字图书馆推广工程”试点单位、全国社会科学普及基地，是湖北省“十佳图书馆”。2018年被评定为国家一级图书馆。</p>
            </el-col>
            <el-col :span='8'>
              <h4>前世今生</h4>
              <p>武汉图书馆的前身是1946年10月建立的汉口市立图书馆，1949年5月改名为武汉市立图书馆，1951年3月改名为武汉市人民图书馆，1953年更名为武汉图书馆，2000年12月搬迁新址正式对外开放。</p>
            </el-col>
            <el-col :span='8'>
              <h4>基本概况</h4>
              <p>截至2018年12月，武汉图书馆总建筑面积约3.3万平方米，有2146个阅览座席，17个读者功能服务区；图书馆设有13个机构部门，职工141人。馆藏各类文献323.7万册（件），数字资源容量达345TB。</p>
            </el-col>
          </el-row>
        </div>
      </div>
    </div>
    <!-- 功能介绍 -->
    <div class="features">
      <div class="container">
        <div class="wls-title">
          <h3>馆藏实力</h3>
        </div>
        <div class="features-agilerow">
          <el-row>
            <el-col :span='12'>
              <div class="features-wgrid">
                <i class="iconfont icon-difangzhengce"></i>
                <div class="features-w3grid-right">
                  <h4>地方文献 </h4>
                  <p>据2020年3月该图书馆官网显示，武汉图书馆收藏新、旧地方文献近3万种，4万余册。其中各种新、旧纸质图书27000余种，报刊2600余种，缩微、光盘、照片等文献300余种。 </p>
                </div>
              </div>
              <div class="features-wgrid">
                <i class="iconfont icon-guji"></i>
                <div class="features-w3grid-right">
                  <h4>古籍文献 </h4>
                  <p>截至2017年11月，武汉图书馆藏有线装古籍21万余册，其中善本近600种，5000多万册。其中《新笺决科古今源流至论》等6种古籍入选《国家珍贵古籍名录》。同时，馆藏5000余部碑帖拓片、200余种家谱均为特色资源。 </p>
                </div>
              </div>
              <div class="features-wgrid">
                <i class="iconfont icon-shuzi"></i>
                <div class="features-w3grid-right">
                  <h4>数字资源 </h4>
                  <p>截至2018年12月，武汉图书馆收藏数字资源容量达345TB，其中包含有万方数据库、万方数据库、超星电子书、超星电子书、全国报刊索引、全国报刊索引、维普考试资源以及图书馆古籍善本数据库、湖北地区历代人名数据库、武汉地区抗日战争史研究文献资料库、武汉图典等特色数据库。 </p>
                </div>
              </div>
            </el-col>
            <el-col :span='12'>
              <div class="features-wgrid">
                <i class="iconfont icon-kaifa"></i>
                <div class="features-w3grid-right">
                  <h4>古籍开发 </h4>
                  <p>2016年，武汉图书馆进行“文化武汉一《毛泽东与武汉》”专题的编制工作，并 完成了《炎黄文化》2016 年1-2期的编制出版，合作编辑制作《武汉中山大道》口袋书等特色文创产品。 </p>
                </div>
              </div>
              <div class="features-wgrid">
                <i class="iconfont icon-jigou"></i>
                <div class="features-w3grid-right">
                  <h4>机构部门 </h4>
                  <p>据2020年3月该图书馆官网信息显示，武汉图书馆设有武图共青团、文献采访部、文献编目部、借阅部、参考咨询部、历史文献部、报刊部、信息服务部、音像部、研究辅导部、自动化技术服务部、教育培训部、名家论坛办公室13个机构部门。 </p>
                </div>
              </div>
              <div class="features-wgrid">
                <i class="iconfont icon-wenxian"></i>
                <div class="features-w3grid-right">
                  <h4>文献开发</h4>
                  <p>截至2018年12月，武汉图书馆共采购中文图书48300种，85428 册；中文报刊3887种，6886份； 海外报刊82种， 82份；港台图书151种，151册；电子数据库15个。分编图书75401种、119067册，并成功向全国联合编目中心上传书目数据1000条。 </p>
                </div>
              </div>
            </el-col>
          </el-row>
        </div>
      </div>
    </div>
    <!-- 工作 -->
    <div class="work">
      <div class="container">
        <div class="work-agileinfo">
          <h3>你对我们的工作印象深刻吗？</h3>
          <p>Nor again is there anyone who loves or pursues or desires to obtain pain.</p>
          <div class="w3btns-agile">
            <a href="">联系我们</a>
          </div>
        </div>
      </div>
    </div>
    <!-- 热门推荐 -->
    <Hot></Hot>
  </div>
</template>

<script>
import Hot from '../../../components/Hot/Hot'
export default {
  data () {
    return {

    }
  },
  methods: {},
  computed: {
  },
  mounted () {
  },
  components: {
    Hot
  }
}

</script>
<style lang='stylus' scoped>
.container
  width 1140px
  margin auto
.wls-title
  text-align center
  h3
    color #000
    font-size 3em
    font-weight 700
    margin-bottom 0.8em
    text-transform capitalize
    border-left 5px solid #01edc9
    padding-left 0.6em
    line-height 0.9em
    display inline-block
.el-carousel
  background url('./images/banner.jpg') no-repeat center center
  background-size cover
  .el-carousel__item
    opacity 0.75
    display flex
    justify-content center
    align-items center
    flex-direction column
    h6
      font-size 2.3em
      color #fff
      margin-bottom 1em
      padding 0 0em 0.5em 0
      font-weight 600
      letter-spacing 2px
      border-bottom 1px solid #01edc9
      display inline-block
    h3
      font-size 5em
      color #fff
      margin-bottom 0.5em
      font-weight 600
      letter-spacing 2px
      text-transform uppercase
.brief
  width 1140px
  margin auto
  padding 70px 0
  .el-row
    display flex
    align-items center
  .welcome-grids
    display flex
    justify-content space-around
    align-items center
    .welcome-grids-items
      display flex
      justify-content center
      flex-direction column
      align-items center
      margin-bottom 30px
      .service-box
        width 70px
        height 70px
        background-color #00b3fe
        display flex
        justify-content center
        align-items center
        font-size 200%
        margin-bottom 15px
        position relative
        &:before
          content ''
          width 100%
          height 100%
          background #01edc9
          position absolute
          top 0
          left 0
          z-index 10
          transform scale(0)
          transition all 0.3s
        &:hover:before
          transform scale(1)
        &:hover
          font-size 150%
        i
          z-index 15
          color #ffffff
          transition all 0.3s
      p
        color #777777
  .brief_text
    h3
      color #000
      font-size 3em
      font-weight 700
      margin-bottom 0.8em
      text-transform capitalize
      border-left 5px solid #01edc9
      padding-left 0.6em
      line-height 0.9em
    h4
      color #333
      font-size 1.4em
      margin 0 0 1em
      line-height 1.8em
      font-weight 400
      letter-spacing 2px
    p
      font-size 1em
      color #999
      line-height 1.8em
.testimonials
  background url('./images/mid-banner.jpg') no-repeat 0px 0px
  background-size cover
  background-attachment fixed
  padding 5em 0
  .container
    width 1140px
    margin auto
    .wls-title
      text-align center
      h3
        color #fff
        font-size 3em
        font-weight 700
        margin-bottom 0.8em
        text-transform capitalize
        border-left 5px solid #01edc9
        padding-left 0.6em
        line-height 0.9em
        display inline-block
    .slidw-agileits
      background rgba(0, 0, 0, 0.76)
      padding 3em 2em
      margin-top 4em
      .el-col
        padding 0 10px
      h4
        font-size 2em
        color #fff
        font-weight 400
        margin-bottom 0.5em
        border-left 3px solid #01edc9
        padding-left 0.5em
      p
        font-size 1em
        color #999
        line-height 1.8em
.features
  padding 5em 0
  .features-agilerow
    margin-top 4em
    .features-wgrid
      display flex
      font-size 1.6em
      align-items center
      margin-bottom 30px
      &:hover i
        color #01edc9
        transform rotateY(180deg)
      i
        color #00b3fe
        padding 0.5em
        font-size 25.6px
        border 1px solid
        border-radius 50%
        transition 0.5s all
        margin 0 15px
      .features-w3grid-right
        padding 0 15px
        h4
          font-size 18px
          margin-bottom 0.5em
          color #01edc9
          font-weight 600
        p
          font-size 14px
          color #999
          line-height 1.8em
.work
  background url('./images/mid-banner.jpg') no-repeat 0px 0px
  background-size cover
  background-attachment fixed
  padding 5em 0
  .work-agileinfo
    text-align center
    background rgba(0, 0, 0, 0.53)
    padding 3em
    h3
      font-size 2em
      color #fff
    p
      color #fff
      margin 2em auto
      letter-spacing 2px
    .w3btns-agile
      a
        font-size 1em
        color #fff
        display inline-block
        padding 0.8em 2.5em
        border 1px solid #fff
        text-decoration none
        transition 0.5s all
        &:hover
          background-color #00b3fe
</style>
