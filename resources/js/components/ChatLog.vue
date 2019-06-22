<template>
  <div
    class="chat-log"
    ref="chatLogContainer"
  >
  
   <message-bubble
      v-for="(message,index) in getCurrentChatMessages"
      :key="index"
      :time="message.time"
      :text="message.text"
      :from="message.username"
    ></message-bubble>
    
    <!-- <div
      class="typing-indicator"
      :class="showTypingIndicator ? 'typing-on' : 'typing-off'"
    >       <div class="lds-ripple">
        <div></div>
        <div></div>
      </div>
    </div> -->
  </div>
</template>

<script>
import MessageBubble from './MessageBubble';
import Pubnub from 'pubnub-vue'
import {mapState, mapGetters} from 'vuex'

export default {
name: 'chat-log',
components: {MessageBubble},
props: ['username'],
data() {  
	return {
    incomingMessage: this.$pnGetMessage(this.$store.state.currentChat,this.storeMessages),
    }
},
methods: {
	storeMessages(response) {
    this.$store.commit('addMessage',response.message)
  }

},
watch: {
  currentChat: function() {
    let currentChatKey = []
    currentChatKey.push(this.currentChat)
    this.$pnSubscribe({
      channels: currentChatKey
    })
    let mL = []
    Pubnub.getInstance().history({
      channel: currentChatKey,
      count: 15, // how many items to fetch
      stringifiedTimeToken: true, // false is the default
	  })
	  .then(response => {
		  response.messages.forEach(message => {
        mL.push(message.entry)
        this.$store.state.friends.forEach(friend => {
          if(friend.chatKey == this.currentChat) {
            friend.lastMessage = message.entry.text
          }
        })
		  })
    })
    this.$store.commit('updateChat',{chatKey: this.currentChat,messages: mL})
    this.incomingMessage =  this.$pnGetMessage(this.currentChat,this.storeMessages)
  } 
},
computed: {
  user() {
    return this.$store.state.user
  },
  ...mapGetters([
    'getCurrentChatMessages'
  ]),
  ...mapState([
    'currentChat',
  ]), 
},
created() {
	 this.$pnSubscribe({
        channels: [this.currentChat]
  })
},

}
</script>

<style scoped>
.chat-log {
  display: block;
  height: inherit;
  width: 100%;
  padding: 2% 4%;
  box-sizing: border-box;
  overflow-y: scroll;
}

.chat-log::-webkit-scrollbar {
  display: none;
}

.typing-indicator {
  display: block;
  width: 36px;
  height: 36px;
  margin-bottom: 4px;
  float: left;
  clear: both;
}

.typing-on {
  display: block;
}

.typing-off {
  display: none;
}
</style>
