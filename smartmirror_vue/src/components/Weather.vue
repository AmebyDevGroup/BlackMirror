<template>
	<transition name="fade-right">
		<div v-if="show && temperature && !prerender" class="weather">
			<div>
				<div class="weather__box">
					<span class="weather__city">{{ data.city }}</span>
					<span class="weather__wind">
					<img src="../assets/wind.svg" alt="">
					<span class="weather__wind-text">{{ data.wind_speed }} m/s</span>
				</span>
				</div>
				<div class="weather__box weather__box--start">
					<img :src="prepareSvgUrl" alt="" class="weather__icon">
					<div class="weather__temperature-wrapper">
						<span class="weather__temperature" v-if="temperature">{{ temperature }}&#8451;</span>
						<span class="weather__description">{{ data.description }}</span>
					</div>
				</div>
			</div>
			<div class="weather__item-wrapper">
				<div class="weather__item">
					<span class="weather__item-label">
						<img src="../assets/sunup.svg" alt="" class="weather__sun">
						<span class="weather__item-value weather__item-value--bigger">{{ sunrise }}</span>
					</span>
						<span class="weather__item-label">
						<img src="../assets/sundown.svg" alt="" class="weather__sun">
						<span class="weather__item-value weather__item-value--bigger">{{ sunset }}</span>
					</span>
				</div>
				<div class="weather__item">
					<span class="weather__item-label">
						<span class="weather__item-title">Ciśnienie</span>
						<span class="weather__item-value">{{ data.pressure }} hPa</span>
					</span>
						<span class="weather__item-label">
						<span class="weather__item-title">Wilgotność</span>
						<span class="weather__item-value">{{ data.humidity }}%</span>
					</span>
				</div>
			</div>
		</div>
	</transition>
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
				prerender: true,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('current_weatherChange', this.handleData);
			this.$root.$on('loading', this.handlePrerender);
		},
		methods: {
			handlePrerender(bool) {
				this.prerender = bool;
			},
			handleConfig(event) {
				this.show = event.weather;
			},
			handleData(data) {
				if (data.hasOwnProperty('status') && data.status === 'failed') {
					this.show = false;
					return;
				}
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
		flex-direction: column;

		&__sun {
			max-width: 80px;
		}

		&__description {
			margin-top: 10px;
			font-size: 18px;
			margin-left: -20px;
			max-width: 200px;
			text-align: center;
		}

		&__city {
			font-size: 50px;
			margin-right: 25px;
		}

		&__wind {
			display: flex;
			justify-content: center;
			align-items: center;

			img {
				width: 32px;
			}

			&-text {
				font-size: 30px;
				margin-left: 10px;
			}
		}

		&__icon {
			max-width: 135px;
			margin-top: 15px;
			margin-right: 10px;
			margin-bottom: 10px;
		}

		&__item {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			margin-top: 5px;

			&:last-of-type {
				margin-top: 10px;
			}

			&-label {
				font-size: 16px;
				width: 50%;
				max-width: 170px;
				text-align: center;
			}

			&-value {
				font-size: 18px;
				display: block;

				&--bigger {
					font-size: 22px;
					line-height: 1;
				}
			}

			&-title {
				font-size: 20px;
				margin-bottom: 5px;
				display: block;
			}

			&-wrapper {
				display: flex;
				justify-content: flex-start;
				flex-direction: column;
				width: 100%;
			}
		}

		&__temperature {
			font-size: 70px;
			margin-left: 25px;
			margin-top: 10px;
			line-height: 1;
			font-weight: 700;

			&-wrapper {
				display: flex;
				flex-direction: column;
			}
		}

		&__box {
			display: flex;
			justify-content: space-between;
			align-items: center;

			&--start {
				align-items: flex-start;
			}
		}
	}
</style>
