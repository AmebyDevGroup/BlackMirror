<template>
	<transition name="fade-right">
		<div v-if="show && !prerender" class="home-sensors">
			<span class="home-sensors__title">{{title}}</span>
			<div class="home-sensors__item">
					<span class="home-sensors__item-label">
						<img :src="hpaSvgUrl" alt="" class="home-sensors__icon">
						<span class="home-sensors__item-title">Ciśnienie</span>
						<span class="home-sensors__item-value">932 hPa</span>
					</span>
					<span class="home-sensors__item-label">
						<img :src="tempSvgUrl" alt="" class="home-sensors__icon">
						<span class="home-sensors__item-title">Temperatura</span>
						<span class="home-sensors__item-value">24&#8451;</span>
					</span>
					<span class="home-sensors__item-label">
						<img :src="humSvgUrl" alt="" class="home-sensors__icon">
						<span class="home-sensors__item-title">Wilgotność</span>
						<span class="home-sensors__item-value">32%</span>
					</span>
			</div>
		</div>
	</transition>
</template>

<script>
	export default {
		name: 'HomeSensors',
		data: function () {
			return {
				title: 'Dom',
				data: null,
				show: true,
				prerender: true,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('sensorsChange', this.handleData);
			this.$root.$on('loading', this.handlePrerender);
		},
		methods: {
			handlePrerender(bool) {
				this.prerender = bool;
			},
			handleConfig(event) {
				// this.show = event.sensors;
			},
			handleData(data) {
				// console.log(data);
			}
		},
		computed: {
			hpaSvgUrl() {
				return require(`../assets/hpa.svg`);
			},
			tempSvgUrl() {
				return require(`../assets/temp.svg`);
			},
			humSvgUrl() {
				return require(`../assets/hum.svg`);
			}
		}
	}
</script>

<style lang="less">
	.home-sensors {
		&__title {
			font-size: 30px;
			margin-bottom: 15px;
			display: block;
			text-align: center;
		}

		&__icon {
			max-width: 80px;
		}

		&__item {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			margin-top: 5px;
			flex-wrap: wrap;
			max-width: 330px;

			&-label {
				font-size: 16px;
				width: 50%;
				max-width: 170px;
				text-align: center;

				&:last-of-type {
					margin-top: 5px;
					margin-left: 85px;
				}
			}

			&-value {
				font-size: 18px;
				display: block;
			}

			&-title {
				font-size: 20px;
				margin-bottom: 5px;
				display: block;
			}
		}
	}
</style>
