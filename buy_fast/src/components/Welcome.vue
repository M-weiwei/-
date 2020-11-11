<template>
  <div>
    <div class="container">
      欢迎来到极速购后台页面
    </div>
    <el-calendar>
      <!-- 这里使用的是 2.5 slot 语法，对于新项目请使用 2.6 slot 语法-->
      <template slot="dateCell"
                slot-scope="{date, data}">
        <p :class="data.isSelected ? 'is-selected' : ''">
          {{ data.day.split('-').slice(1).join('-') }} {{ data.isSelected ? '✔️' : ''}}
        </p>
      </template>
    </el-calendar>
  </div>
</template>
<script>
export default {

}
</script>
<style lang="less" scoped>
.container {
  text-align: center;
  color: black;
  font-size: 35px;
  margin-bottom: 15px;
}
.el-calendar {
}
</style>
