<template>
	<div v-if="show" class="weather">
      <span>{{ data.city }}</span>
      <span>{{ data.clouds }}</span>
      <span>{{ data.description }}</span>
      <span>{{ data.humidity }}</span>
      <span>{{ data.icon }}</span>
      <span>{{ data.pressure }}</span>
      <span>{{ data.sunrise }}</span>
      <span>{{ data.sunset }}</span>
      <span>{{ data.temperature }}</span>
      <span>{{ data.time }}</span>
      <span>{{ data.wind_gust }}</span>
      <span>{{ data.wind_speed }}</span>
	</div>
</template>

<script>
	export default {
		name: 'Weather',
		data: function () {
			return {
				data: [],
				show: false,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('current_weatherChange', this.handleData);
		},
		methods: {
			handleConfig(event) {
				this.show = event.weather;
			},
			handleData(data) {
				this.data = data;
			}
		}
	}
</script>

<style lang="less">
	.weather {
      display: flex;
      flex-direction: column;
    }
</style>
