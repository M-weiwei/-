module.exports = {
  lintOnSave: false,
  devServer: {
    // hot: true,
    // host: 'localhost',
    port: 3000,
    proxy: {
      '/demo': { // 名字必须跟application context相同 否则404
        target: 'http://zhuwei.com',
        ws: true,
        changeOrigin: true, //  跨域
        pathRewrite: {
          '^/demo': ''
        }
      }
    }
  }
}
