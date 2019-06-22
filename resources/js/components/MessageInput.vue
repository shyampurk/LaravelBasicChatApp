<template>
  <div class="message-input">
    <input type = "text" placeholder="Your message here" @keydown.enter="submitMessage" v-model = "message" class = "messageInput input-field">
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
        	channel: this.currentChat,
        	message: {
          		username: this.username,
          		text: this.message,
              time: Date.now(),
              channel : this.currentChat
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

<style>
.message-input {
  display: table-row;
  width: 90%;
  height: 26px;
  background-color : white !important;
}

.messageInput {
  background-color : white !important;
  width: 98% !important;
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
input:not([type]), input[type=text]:not(.browser-default), input[type=password]:not(.browser-default), input[type=email]:not(.browser-default), input[type=url]:not(.browser-default), input[type=time]:not(.browser-default), input[type=date]:not(.browser-default), input[type=datetime]:not(.browser-default), input[type=datetime-local]:not(.browser-default), input[type=tel]:not(.browser-default), input[type=number]:not(.browser-default), input[type=search]:not(.browser-default), textarea.materialize-textarea {
  background-color: white !important;
}
.input-field {
   background-color: white !important;
}
</style>
