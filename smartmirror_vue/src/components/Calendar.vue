<template>
	<transition name="fade-left">
		<div v-if="show && data && !prerender" class="calendar">
			<div v-for="item in data" class="calendar__item">
				<img src="../assets/calendar.svg" alt="" class="calendar__icon">
				<p class="calendar__text" v-if="item.start !== 0 && item.start !== 1">{{item.title}} za {{item.start}} {{ dayTypo(item.start) }}</p>
				<p class="calendar__text" v-if="item.start === 0">{{item.title}} - Dzisiaj</p>
				<p class="calendar__text" v-if="item.start === 1">{{item.title}} - Jutro</p>
			</div>
		</div>
	</transition>
</template>

<script>
	export default {
		name: 'Calendar',
		data: function () {
			return {
				data: [],
				show: false,
				prerender: true,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('calendarChange', this.handleData);
			this.$root.$on('loading', this.handlePrerender);
		},
		methods: {
			handlePrerender(bool) {
				this.prerender = bool;
			},
			handleConfig(event) {
				this.show = event.calendar;
			},
			handleData(data) {
				if (data.hasOwnProperty('status') && data.status === 'failed') {
					this.show = false;
					return;
				}
				this.data = data;
			},
			dayTypo(start) {
				return start === 1 ? 'dzień' : 'dni';
			},
		},
	}
</script>

<style lang="less">
	.calendar {
		&__item {
			display: flex;
			justify-content: flex-start;
			align-items: center;
			margin-bottom: 15px;
		}

		&__icon {
			width: 30px;
			margin-right: 20px;
		}

		&__text {
			font-size: 24px;
			margin: 0;
		}
	}
</style>
