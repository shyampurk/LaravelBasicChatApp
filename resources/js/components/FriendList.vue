<template>
  <div class="friend-list">
    <div class="new-chat">
      <div class="add-one-one" @click="newChat">+</div>
      <div class="name-input">
        <input v-model="friendUsername" type="text" placeholder="Friend's Username">
      </div>
    </div>
    <friend-list-item
      v-for="(friend, index) of friends"
      :key="index"
      :index="index"
    
      :name="friend.name"
    ></friend-list-item>
    
  </div>
</template>

<script>
import axios from 'axios'
import FriendListItem from './FriendListItem';
import {mapState} from 'vuex'
import domain from '../domainconfig'
export default {
  name: 'friend-list',
  components: {
    FriendListItem,
  },
  props: [
	  'username'
  ],
  data() {
    return {
      friendUsername: '',
      incomingChat: this.$pnGetMessage('control',this.checkAndAdd),
    }
  },
  methods: {
    newChat() {
		let uri = domain + "/api/add"
		if(this.username != this.friendUsername) {
			axios.post(uri,{remoteUsername: this.friendUsername, username: this.username})
			.then(response => {
       if(response.data != "404") { 
        // console.log(this.$store.state.friends)
        // console.log(this.alreadyExists(this.friendUsername))
            if(!this.alreadyExists(this.friendUsername)) {
                this.$store.state.friends.push({name: this.friendUsername, chatKey: this.$store.state.user.uuid + "-" + response.data, selected : '' })
                this.$pnPublish({
                  channel: 'control',
                  message: {
                    fromName: this.username,
                    toName: this.friendUsername,
                    chatKey: this.$store.state.user.uuid + "-" + response.data
                  }
                })       
            }
          } 
          let sc = []
          this.$store.state.friends.forEach(friend => {
            sc.push(friend.chatKey)
          })
        this.$pnSubscribe({
          channels: sc
        });
			})
		}	
  },
  checkAndAdd(msg) {
    if(msg.message.toName == this.username) {
      let subscribedChannels = []
      this.$store.state.friends.push({name: msg.message.fromName, chatKey: msg.message.chatKey})
      this.$store.state.friends.forEach(friend => {
        subscribedChannels.push(friend.chatKey)
      })
       this.$pnSubscribe({
          channels: subscribedChannels
        });
      //console.log(this.$store.state.friends)
    }
  },
  alreadyExists(username) {
    let count = 0
    this.$store.state.friends.forEach(friend => {
      if(friend.name == username) {
        count++
      }
    })
    if(count != 0) {
      return true
    }
    else {
      return false
    }
  }
},
created() {
  this.$pnSubscribe({
    channels: ['control']
  })
},
computed: {
  ...mapState([    
    'friends'
  ]),
 
},

}

</script>

<style scoped>
.friend-list::-webkit-scrollbar {
  display: none;
}

.friend-list {
  -ms-user-select: none;
  user-select: none;
  position: relative;
  display: block;
  width: 250px;
  height: 100%;
  background: linear-gradient(141deg, #505D74 0%, #15223A 75%);
  float: left;
  overflow-y: scroll;
  border-radius: 0 0 0 3px;
}

.new-chat {
  display: block;
  width: 100%;
  height: 28px;
  background-color: #39465B;
}

.name-input {
  display: inline-block;
  height: 100%;
  float: left;
}

.name-input input {
  position: relative;
  top: 50%;
  transform: translateY(-50%);
  height: 16px;
  width: 180px;
  outline: none;
  font-size: 12px;
  border: solid 1px #AAAAAA;
  border-radius: 3px;
  font-family: Helvetica;
}

.add-one-one {
  display: inline-block;
  position: relative;
  top: 50%;
  transform: translateY(-50%);
  float: left;
  -ms-user-select: none;
  user-select: none;
  width: 20px;
  height: 20px;
  margin: 0 6px;
  line-height: 20px;
  font-size: 20px;
  font-family: Arial;
  color: #FFFFFF;
  background-color: #15223A;
  cursor: pointer;
}
</style>
