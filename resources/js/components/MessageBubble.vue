<template>
  <div class="message-bubble" :class="me">
    <span class="from" :class="isGlobal">{{ from }}</span>
    <br :class="me + ' ' + isGlobal">
    <span class="message-text">{{ text }}</span>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'message-bubble',
  props: ['time', 'text', 'from','authUsername'],
  computed: {
    isGlobal() {},
    me() {
      if(this.from === this.$store.state.user.username) {
        return "me"
      }
    },
  },
  data() {
    return {};
  },
};
</script>

<style scoped>
.message-bubble {
  display: block;
  max-width: 50%;
  margin-bottom: 4px;
  float: left;
  clear: both;
}

.message-text {
  padding: 8px;
  margin: 4px;
  text-align: left;
  background-color: #dfdfdf;
  border-radius: 4px;
}

.message-bubble.me {
  float: right;
}

.message-bubble.me .message-text {
  background-color: #c6c6c6;
}

.from {
  float: left;
  margin: 4px;
  font-size: 10px;
  color: #9DA7AF;
}

.message-bubble span {
  display: block;
}

span.display-none,
br.display-none,
.message-bubble.me .from,
br.me {
  display: none;
}
</style>
