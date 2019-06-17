// Imports
import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import axios from 'axios'
import VueAxios from 'vue-axios'
import App from './components/App'
import uuid from 'vue-uuid'
import Vuex from 'vuex'
import Pubnub from 'pubnub-vue'
import VuexStore from './store'
import PubnubConfig from './pubnubconfig'
import VueChatScroll from 'vue-chat-scroll'

// Plugin Uses
Vue.use(VueRouter)
Vue.use(VueAxios,axios)
Vue.use(uuid)
Vue.use(Vuex)
Vue.use(Pubnub,PubnubConfig,VuexStore)
Vue.use(VueChatScroll)

// App Initialization
const vueApp = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    store: VuexStore,
    components: {App}
})