import Vue from 'vue'
import Vuex from 'vuex'
import Pubnub from 'pubnub-vue'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: {},
        friends: [],
        currentChat: {name:"Global",chatKey: "global"},
    },
    getters: {

    },
    mutations: {
       setCurrentChat(state,{current}) {
        state.currentChat = current;
       }
  
    },
    actions: {

    }
 })