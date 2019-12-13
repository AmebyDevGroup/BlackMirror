<template>
	<div v-if="show" class="air">
		<span class="air__title">{{title}}</span>
		<div class="air__wrapper">
			<div class="air__item" v-for="item in data">
				<span class="air__item-title">
					{{ item.name }}
					<span class="air__item-code">({{ item.code }})</span>
				</span>
				<span class="air__item-value">
					{{ item.value.value ? item.value.value : '-' }} &#181;g/m<sup>3</sup>
				</span>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'Air',
		data: function () {
			return {
				title: 'Jakość powietrza:',
				data: [],
				show: false,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('airChange', this.handleData);
		},
		methods: {
			handleConfig(event) {
				this.show = event.air;
			},
			handleData(data) {
				this.data = data.map(elem => {
					const float = parseFloat(elem.value.value).toFixed(2);
					return {...elem, value: {value: float, date: elem.value.date}};
				});
			}
		}
	}
</script>

<style lang="less">
	.air {
		&__title {
			font-size: 30px;
			margin-bottom: 15px;
			display: block;
		}

		&__wrapper {
			display: flex;
			justify-content: flex-start;
			align-items: center;
			margin-top: 25px;
		}

		&__item {
			padding: 10px;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			height: 110px;
			border-radius: 10px;
			margin-right: 35px;

			&-title {
				font-size: 16px;
				margin-right: 5px;
				text-align: center;
			}

			&-code {
				display: block;
			}

			&-value {
				font-size: 20px;
				margin-top: 10px;
				font-weight: bold;
			}
		}
	}
</style>
