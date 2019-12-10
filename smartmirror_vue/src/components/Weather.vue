<template>
  <div v-if="show">
    {{title}}
  </div>
</template>

<script>
export default {
  name: 'Weather',
  data: function () {
    return {
      title: 'Weather',
      show: false,
    }
  },
  mounted() {
    this.$root.$on('configChange', this.handleConfig);
  },
  methods: {
    handleConfig(e) {
      this.show = e.weather === "1";
    },
  }
}
</script>

<style>

</style>
