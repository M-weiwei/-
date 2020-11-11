<template>
  <div>
    <el-card>
      <div v-if="noticeList.length!==0">
        <div class="notice_item"
             v-for="(item,i) in noticeList"
             :key="i">
          <el-badge class="item">
            <el-tag type="success">{{item.informTittle}}</el-tag>
          </el-badge>
          <div class="text">{{item.informCon}}</div>
        </div>
      </div>
      <el-row v-else>
        <el-col :sapn='24'
                class="noBorrow">
          您当前还没有通知
        </el-col>
      </el-row>
    </el-card>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data () {
    return {
      noticeList: []
    }
  },
  async created () {
    const { data: res } = await this.$http.get('demo/interfaces/tongzhi.php', { params: { userId: this.userInfo.userId } })
    console.log(res)
    this.noticeList = res
  },
  mounted () {

  },
  methods: {

  },
  computed: {
    ...mapState(['userInfo'])
  }
}
</script>

<style scoped lang="stylus">
.notice_item
  padding 20px 0
  border-bottom 1px solid #ccc
  .el-badge
    margin-bottom 20px
.noBorrow
  display flex
  justify-content center
  align-items center
  font-size 25px
  color #01edc9
</style>
