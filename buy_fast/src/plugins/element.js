import Vue from 'vue'
import {
  Button,
  Form,
  FormItem,
  Input,
  Message,
  Container,
  Header,
  Aside,
  Main,
  Breadcrumb,
  BreadcrumbItem,
  MessageBox,
  Steps,
  Step
} from 'element-ui'

Vue.use(Steps)
Vue.use(Step)
Vue.use(BreadcrumbItem)
Vue.use(Breadcrumb)
Vue.use(Button)
Vue.use(Form)
Vue.use(Container)
Vue.use(Header)
Vue.use(Aside)
Vue.use(Main)
Vue.use(FormItem)
Vue.use(Input)
Vue.prototype.$message = Message
Vue.prototype.$confirm = MessageBox.confirm
