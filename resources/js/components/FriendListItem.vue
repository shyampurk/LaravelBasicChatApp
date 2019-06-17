<template>
  <div class = "friend-list-item" :class = "selected" @click= "onFocus" :id = "name">
    <div class="text">
      <span class="name" :id = "name">{{ name }}</span>
      <span class="lastMessage" :id = "name"></span>
    </div>
  </div>
</template>

<script>
import {mapState} from 'vuex'
import Pubnub from 'pubnub-vue'
export default {
  name: 'friend-list-item',
  props: [
    'name',
    'index'
  ],
  data() {
    return {
      currentChatKey: '',
    }
  },
  methods: {
    onFocus(event) {
      // console.log(event)
       this.$store.state.friends.forEach(friend => {
        if(friend.name == event.currentTarget.id) {
          this.currentChatKey  = friend.chatKey
         
          friend.selected =  "selected"
        }
        else {
          friend.selected = ""
        }
        this.$store.state.currentChat = {
        name: event.currentTarget.id, 
        chatKey: this.currentChatKey,
        }
        //console.log(this.$store.state.friends)
      })
    }
  },
  computed: {
    ...mapState([
        'user','friends','currentChat'
    ]),
    selected() {
      if(this.$store.state.currentChat.chatKey === this.thisChatKey) {
        return "selected"
      }
      else {
        return ""
      }
    },
    
  },

};
</script>

<style scoped>
.friend-list-item {
  width: 100%;
  height: 70px;
  padding: 5%;
  box-sizing: border-box;
  border-bottom: solid 1px #CDCDCD;
  background: linear-gradient(141deg, #505D74 0%, #15223A 75%);
  cursor: pointer;
}

.selected {
  background: #717C8F;
}

.friend-list-item img {
  border-radius: 50%;
  height: 100%;
  margin-right: 5%;
  float: left;
}

.friend-list-item span {
  display: block;
  color: #FFFFFF;
  text-align: left;
}

.text {
  position: relative;
  top: 50%;
  transform: translateY(-50%);
}

span.name {
  font-weight: bold;
  font-size: 16px;
}

span.lastMessage {
  color: #CFCFCF;
  font-size: 14px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>
