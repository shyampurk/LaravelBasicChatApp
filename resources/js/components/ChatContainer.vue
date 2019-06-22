<template>
  <div class="chat-container">
    <div class="heading">
      <h1>{{ title + username}}</h1>
    </div>
    <div class="body">
      <friend-list :username = "username"></friend-list>
      <div class="right-body">
        <div class="table">
          <chat-log :username = "username" v-chat-scroll></chat-log>
          <message-input :username = "username" :authUUID= "authUUID"></message-input>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FriendList from './FriendList';
import ChatLog from './ChatLog';
import MessageInput from './MessageInput';
import axios from 'axios'
import domain from '../domainconfig'
import {mapState} from 'vuex'
import Pubnub from 'pubnub-vue'

export default {
  name: 'chat-container',
  components: {
    FriendList,
    ChatLog,
    MessageInput,
  },
  data() {
    return {
      title: 'PubNub, Vue & Laravel Chat - User: ',
      username: null,
      authUUID: null,
    };
  },
  methods: {},

  created() {
    //Get username from route
    this.username = this.$route.params.username
    let uri = domain + "/api/getUUID"
    //Get the logged in user's UUID
    axios.post(uri,{username: this.username})
    .then(response => {
        //Store logged in user's username, uuid, and channels subscribed in Vuex Store
        this.authUUID = response.data
        this.$store.state.user.uuid = this.authUUID
        this.$store.state.user.username = this.username
        this.$store.state.friends.push({name: "Global", chatKey: "global", lastMessage: ''}) 
        this.$store.state.control = "control"
        let mL = []
        Pubnub.getInstance().history({
          channel: this.currentChat,
          count: 15, // how many items to fetch
          stringifiedTimeToken: true, // false is the default
        })
        .then(response => {
          response.messages.forEach(message => {
          mL.push(message.entry)
          this.$store.state.friends.forEach(friend => {
            if(friend.chatKey == "global") {
              friend.lastMessage = message.entry.text
            }
          })
          })
        })
        this.$store.commit('updateChat',{chatKey: "global",messages: mL})
    }).catch(err => {
      console.log(err)
    })
  },
  // watch: {
  //   currentChat: function() {
  //     this.toUsername = this.currentChat.name
  //   }
  // },
  computed : {
    ...mapState([
      'currentChat','friends'
    ])
  }
};

</script>

<style scoped>
h1 {
  display: table-cell;
  vertical-align: middle;
  margin: 0;
  font-size: 16px;
  font-weight: normal;
}

.chat-container {
  display: table;
  max-width: 750px;
  min-width: 300px;
  width: 100%;
  height: 550px;
  margin: 50px auto;
  background-color: #FFFFFF;
  border: solid 1px #BFBFBF;
  border-radius: 3px;
}

.heading {
  display: table;
  width: 100%;
  height: 28px;
  text-align: center;
  background-color: #CDCDCD;
  border-radius: 3px 3px 0 0;
  -ms-user-select: none;
  user-select: none;
  background: linear-gradient(#EDEDED 0%, #CDCDCD 75%);
}

.body {
  display: block;
  height: inherit;
}

.right-body {
  display: block;
  width: auto;
  height: inherit;
  overflow: hidden;
}

.table {
  display: table;
  width: 100%;
  height: 100%;
}
</style>
