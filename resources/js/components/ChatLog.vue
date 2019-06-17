<template>
  <div
    class="chat-log"
    ref="chatLogContainer"
  >
  
   <message-bubble
      v-for="(message,index) in messages"
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
import {mapState} from 'vuex'

export default {
name: 'chat-log',
components: {MessageBubble},
props: ['username'],
data() {  
	return {
		incomingMessage: this.$pnGetMessage(this.$store.state.currentChat.chatKey,this.storeMessages),
    messages: [],
    }
},
methods: {
	storeMessages(response) {
    if(this.$store.state.currentChat.chatKey === response.message.channel) {
      if(this.messages.length <= 15) {
        this.messages.push(response.message)
      }  
      else {
        this.messages.shift()
        this.messages.push(response.message)
      }
    }      
  }
},
watch: {
  currentChat: function() {
   
    let currentChatKey = []
    currentChatKey.push(this.currentChat.chatKey)
     this.$pnSubscribe({
        channels: currentChatKey
  })
  this.messages = []
  Pubnub.getInstance().history({
        channel: this.currentChat.chatKey,
        count: 15, // how many items to fetch
        stringifiedTimeToken: true, // false is the default
	})
	.then(response => {
		response.messages.forEach(message => {
			this.messages.push(message.entry)
		})
  })
  this.incomingMessage =  this.$pnGetMessage(this.currentChat.chatKey,this.storeMessages)
  } 
},
computed: {
  user() {
    return this.$store.state.user
  },
  ...mapState([
    'currentChat',
  ])
},
created() {
	 this.$pnSubscribe({
        channels: [this.currentChat.chatKey]
  })
	Pubnub.getInstance().history({
        channel: 'global',
        count: 15, // how many items to fetch
        stringifiedTimeToken: true, // false is the default
	})
	.then(response => {
		response.messages.forEach(message => {
			this.messages.push(message.entry)
		})
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
