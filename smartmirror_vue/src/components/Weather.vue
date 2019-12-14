<template>
	<div v-if="show && temperature" class="weather">
		<div>
			<span class="weather__city">{{ data.city }}</span>
			<div class="weather__box">
				<img :src="prepareSvgUrl" alt="" class="weather__icon">
				<span class="weather__temperature" v-if="temperature">{{ temperature }}&#8451;</span>
			</div>
			<span>{{ data.description }}</span>
		</div>
		<div class="weather__item-wrapper">
			<div class="weather__item">
				<span class="weather__item-label">
					Wilgotność:
					<span class="weather__item-value">{{ data.humidity }}%</span>
				</span>
				<span class="weather__item-label">
					Ciśnienie:
					<span class="weather__item-value">{{ data.pressure }} hPa</span>
				</span>
				<span class="weather__item-label">
					Zachmurzenie:
					<span class="weather__item-value">{{ data.clouds }}%</span>
				</span>
				<span class="weather__item-label">
					Wiatr:
					<span class="weather__item-value">{{ data.wind_speed }} m/s</span>
				</span>
			</div>
			<div class="weather__item">
				<span class="weather__item-label">
					Wschód słońca:
					<span class="weather__item-value">{{ sunrise }}</span>
				</span>
				<span class="weather__item-label">
					Zachód słońca:
					<span class="weather__item-value">{{ sunset }}</span>
				</span>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'Weather',
		data: function () {
			return {
				data: [],
				show: false,
				sunrise: false,
				sunset: false,
				temperature: false,
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
				this.temperature = Math.round(data.temperature);
				this.sunrise = this.prepareSunData(data.sunrise);
				this.sunset = this.prepareSunData(data.sunset);
			},
			prepareSunData(value) {
				const hours = new Date(value * 1000).getHours();
				const hoursFormatted = hours < 10 ? `0${hours}` : hours;
				const minutes = new Date(value * 1000).getMinutes();
				const minutesFormatted = minutes < 10 ? `0${minutes}` : minutes;

				return `${hoursFormatted}:${minutesFormatted}`
			}
		},
		computed: {
			prepareSvgUrl() {
				return require(`../assets/${this.data.icon}.svg`);
			}
		}
	}
</script>

<style lang="less">
	.weather {
		display: flex;

		&__icon {
			max-width: 75px;
			margin-top: 10px;
			margin-right: 10px;
			margin-bottom: 10px;
		}

		&__item {
			display: flex;
			justify-content: flex-start;
			align-items: flex-start;
			margin-bottom: 25px;

			&:last-of-type {
				margin-bottom: 0;
			}

			&-label {
				margin-right: 10px;
				font-size: 16px;
				width: 25%;
				max-width: 170px;
			}

			&-value {
				font-size: 18px;
				display: block;
			}

			&-wrapper {
				display: flex;
				justify-content: flex-end;
				flex-direction: column;
				padding-left: 40px;
				width: 100%;
			}
		}

		&__city {
			font-size: 30px;
		}

		&__temperature {
			font-size: 40px;
		}

		&__box {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
	}
</style>
