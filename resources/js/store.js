import Vue from 'vue'
import Vuex from 'vuex'
import Pubnub from 'pubnub-vue'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: {},
        friends: [],
				currentChat: 'global',
        chats: [
					{chatKey: "global", messages: []},
				]
    },
    getters: {
        getCurrentChatMessages(state) {
           return state.chats.find(chat => 
						 	chat.chatKey == state.currentChat
					 ).messages
				},
    },
    mutations: {
        setCurrentChat(state, {chatKey}) {
          state.currentChat = chatKey;
				},
				addChat(state,chat)	{
					state.chats.push(chat)
				},
				updateChat(state,payload) {
					state.chats.forEach(chat => {
						if(chat.chatKey == payload.chatKey) {
							chat.messages = payload.messages
						}
					})
				},
				addMessage(state,message) {
					state.chats.forEach(chat => {
						if(chat.chatKey == message.channel) {
							if(chat.messages.length < 15) {
								chat.messages.push(message)
							}
							else {
								chat.messages.shift()
								chat.messages.push(message)
							}
						}
					})
					state.friends.forEach(friend => {
						if(friend.chatKey == message.channel) {
							friend.lastMessage = message.text
						}
					})
				}
  
    },
    actions: {

    }
 })