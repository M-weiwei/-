const webpack = require('webpack')
module.exports = {
  lintOnSave: false,
  configureWebpack: {
    module: {
      rules: [{
        test: /\.js$/,
        use: 'babel-loader',
        exclude: /node_modules/
      }]
    },
    plugins: [

      new webpack.ProvidePlugin({

        $: 'jquery',

        jQuery: 'jquery',

        'windows.jQuery': 'jquery',
        Popper: ['popper.js', 'default']
      })

    ]

  },
  // 修改打包默认路劲
  chainWebpack: config => {
    // 发布模式
    config.when(process.env.NODE_ENV === 'production', config => {
      config.entry('app').clear().add('./src/main-prod.js')
      config.set('externals', {
        vue: 'Vue',
        axios: 'axios',
        lodash: '_',
        echarts: 'echarts',
        nprogress: 'NProgress',
        'vue-quill-editor': 'VueQuillEditor'
      })
      config.plugin('html').tap(args => {
        args[0].isProd = true
        return args
      })
    })
    // 开发模式
    config.when(process.env.NODE_ENV === 'development', config => {
      config.entry('app').clear().add('./src/main-dev.js')
      config.plugin('html').tap(args => {
        args[0].isProd = false
        return args
      })
    })
  }
}
