<template>
	<transition name="fade-right">
		<div v-if="show && (dataGlobal || dataPoland) && !prerender" class="corona-virus">
			<span class="corona-virus__title">{{title}}</span>
			<div class="corona-virus__wrapper" v-if="dataPoland">
				<img :src="coronaIconPl" alt="" class="corona-virus__icon">
				<div class="corona-virus__data">
					<span class="corona-virus__label">POTWIERDZONYCH: <b>{{ dataPoland.confirmed }}</b></span>
					<span class="corona-virus__label">ZGONÓW: <b>{{ dataPoland.deaths }}</b></span>
					<span class="corona-virus__label">WYLECZONYCH: <b>{{ dataPoland.recovered }}</b></span>
				</div>
			</div>
			<div class="corona-virus__wrapper" v-if="dataGlobal">
				<img :src="coronaIconWorld" alt="" class="corona-virus__icon">
				<div class="corona-virus__data">
					<span class="corona-virus__label">POTWIERDZONYCH: <b>{{ dataGlobal.confirmed }}</b></span>
					<span class="corona-virus__label">ZGONÓW: <b>{{ dataGlobal.deaths }}</b></span>
					<span class="corona-virus__label">WYLECZONYCH: <b>{{ dataGlobal.recovered }}</b></span>
				</div>
			</div>
		</div>
	</transition>
</template>

<script>
	export default {
		name: 'CoronaVirus',
		data: function () {
			return {
				title: 'COVID-19',
				dataGlobal: null,
				dataPoland: null,
				show: false,
				prerender: true,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('covidChange', this.handleData);
			this.$root.$on('loading', this.handlePrerender);
		},
		methods: {
			handlePrerender(bool) {
				this.prerender = bool;
			},
			handleConfig(event) {
				this.show = event.covid;
			},
			handleData(data) {
				if (data.hasOwnProperty('status') && data.status === 'failed') {
					this.show = false;
					return;
				}
				if (data.hasOwnProperty('global')) {
					this.dataGlobal = data.global;
				}
				if (data.hasOwnProperty('poland')) {
					this.dataPoland = data.poland;
				}
			}
		},
		computed: {
			coronaIconPl() {
				return require(`../assets/corona_pl.svg`)
			},
			coronaIconWorld() {
				return require(`../assets/corona_world.svg`)
			}
		}
	}
</script>

<style lang="less">
	.corona-virus {
		&__icon {
			max-width: 100px;
			margin-right: 15px;
		}

		&__title {
			font-size: 30px;
			margin-bottom: 15px;
			display: block;
			text-align: center;
		}

		&__wrapper {
			display: flex;
			justify-content: flex-start;
			align-items: center;
			margin-top: 20px;
			margin-right: 20px;

			&:first-of-type {
				margin-bottom: 30px;
			}
		}

		&__label {
			font-size: 16px;
			margin: 8px 0;
			display: block;
		}
	}
</style>
