<template>
  <div>
    <el-card class="box-card">
      <!-- 个人信息 -->
      <div class="info">
        <!-- 名字 -->
        <div class="name">
          <span>名称：</span>{{userInfo.userName}}
        </div>
        <div class="email">
          <span>邮箱：</span>{{userInfo.userEmail}}
        </div>
      </div>
    </el-card>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data () {
    return {

    }
  },
  methods: {},
  computed: {
    ...mapState(['userInfo'])
  }
}

</script>
<style lang='stylus' scoped>
.info
  div
    margin 30px 0
    display flex
    span
      display block
      width 80px
      text-align right
      margin 0 30px
</style>
