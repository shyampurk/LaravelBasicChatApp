<template>
  <div class="message-input">
    <input type = "text" placeholder="Your message here" @keydown.enter="submitMessage" v-model = "message" class = "messageInput">
  </div>
</template>

<script>
import axios from 'axios'
import Pubnub from 'pubnub-vue'
import { mapState } from 'vuex';
export default {
  name: 'message-input',
  props: [
    'username','authUUID'
  ],
  data() {
    return {
	  message: '',
	  channel: 'chatApp'
    }
  },
  created() {
    const thisComponent = this;
  },
  methods: {
    isTyping(event) {
        
    },
    submitMessage() {
      // if(this.message != "") {
        this.$pnPublish({
        	channel: this.currentChat.chatKey,
        	message: {
          		username: this.username,
          		text: this.message,
              time: Date.now(),
              channel : this.currentChat.chatKey
        	}	   	  
        })  
    // }
    this.message = ''
    }
  },
  computed: {
   ...mapState([
     'currentChat'
   ])
  }
}
</script>

<style scoped>
.message-input {
  display: table-row;
  width: 90%;
  height: 26px;
}

.messageInput {
  width: 88%;
  height: 28px;
  padding: 0 5px;
  margin: 0;
  box-sizing: border-box;
  line-height: 20pt;
  resize: none;
  outline: none;
  font-size: 14px;
  border: solid 3px black;
  border-radius: 3px;
  font-family: Helvetica;
}
</style>
