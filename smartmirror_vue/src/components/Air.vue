<template>
	<transition name="fade-right">
		<div v-if="show && data && !prerender" class="air">
			<span class="air__title">{{title}}</span>
			<div class="air__wrapper">
				<img :src="prepareIconUrl" alt="" v-if="quality_id !== false">
				<span class="air__label" v-if="quality_id !== false && quality_id >= 0">{{ data.quality_message }}</span>
				<span class="air__label" v-if="quality_id === -1">Brak danych</span>
			</div>
		</div>
	</transition>
</template>

<script>
	export default {
		name: 'Air',
		data: function () {
			return {
				title: 'Jakość powietrza',
				data: [],
				quality_id: false,
				show: false,
				prerender: true,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('airChange', this.handleData);
			this.$root.$on('loading', this.handlePrerender);
		},
		methods: {
			handlePrerender(bool) {
				this.prerender = bool;
			},
			handleConfig(event) {
				this.show = event.air;
			},
			handleData(data) {
				if (data.hasOwnProperty('status') && data.status === 'failed') {
					this.show = false;
					return;
				}
				this.data = data.main;
				this.quality_id = this.data.quality_id;
			}
		},
		computed: {
			prepareIconUrl() {
				return require(`../assets/${this.quality_id}.svg`)
			}
		}
	}
</script>

<style lang="less">
	.air {
		margin-right: 42px;

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
			flex-direction: column;
			margin-top: 20px;
		}

		&__label {
			font-size: 24px;
			margin-top: 15px;
			display: block;
		}
	}
</style>
