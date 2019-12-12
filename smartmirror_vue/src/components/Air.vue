<template>
	<div v-if="show" class="air">
		<span class="air__title">{{title}}</span>
		<div class="air__item" v-for="item in data">
			<span class="air__item-title">{{ item.name }} ({{ item.code }}):</span>
			<span class="air__item-value">{{ item.value.value }}</span>
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
			handleData(data) {// console.log('data', data)
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

		&__item {
			padding: 5px 0;

			&-title {
				font-size: 20px;
				margin-right: 5px;
			}

			&-value {
				font-size: 20px;
			}
		}
	}
</style>
