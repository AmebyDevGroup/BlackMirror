<template>
  <div class="connection-error" :class="{'active': show}">
    <img src="../assets/connectionError.svg" alt="">
    <span class="connection-error__message">ERROR CONNECTION</span>
  </div>
</template>

<script>
export default {
  name: 'ConnectionError',
  data: function () {
    return {
      show: false,
    }
  },
  mounted() {
    this.$root.$on('connectionError', this.handleConnectionError);
  },
  methods: {
    handleConnectionError(error) {
      this.show = !error;
    },
  },
}
</script>

<style lang="less">
.connection-error {
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  bottom: 0;
  z-index: 200;
  background: black;
  width: 100vw;
  height: 100vh;
  opacity: 0;
  visibility: hidden;
  transition: 1s ease all;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;

  &.active {
    opacity: 1;
    visibility: visible;
  }

  &__message {
    font-size: 26px;
    display: block;
    margin-top: 35px;
  }
}
</style>
