<template>
  <div class = "friend-list-item" :class = "selected" @click= "onFocus" :id = "name">
    <img :src ="profileImg" />
    <div class="text">
      <span class="name" :id = "name">{{ name }}</span>
      <span class="lastMessage" :id = "name">{{lastMessage}}</span>
    </div>
  
  </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex'
import Pubnub from 'pubnub-vue'
import defaultProfileImg from '../assets/profile.png'
import uri from '../domainconfig'
import {EventBus} from '../event-bus.js';

export default {
  name: 'friend-list-item',
  props: [
    'name',
    'index',
  ],
  data() {
    return {
     // lastMessage: '',
      profileImg: uri + '/images/profile.png',
      
    }
  },
  methods: {
    onFocus(event) {
      EventBus.$emit('focus-input', event);
      this.$store.commit('setCurrentChat', {chatKey: this.chatKey});
    },
   
  },
  computed: {
    chatKey() {
      return this.$store.state.friends[this.index].chatKey;
    },
    ...mapState([
        'user','friends','currentChat'
    ]),
    selected() {
      return this.$store.state.currentChat === this.chatKey ? 'selected' : '';
    },
    avatarSrc() {
      return defaultProfileImg
    },
    lastMessage() {
      return this.$store.state.friends[this.index].lastMessage
    }
  },
  created() {

  }
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
