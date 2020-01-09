<template>
	<transition name="fade-left">
		<div class="time" v-if="!prerender">
			<div class="time__wrapper">
				<span class="time__item" v-if="hoursValue !== null">{{ hours }}:</span>
				<span class="time__item" v-if="minutesValue !== null">{{ minutes }}</span>
			</div>
			<div class="time__date">{{ date }}</div>
		</div>
	</transition>
</template>

<script>
	export default {
		name: 'DateTime',
		data: function () {
			return {
				hoursValue: null,
				minutesValue: null,
				date: null,
				weekday: null,
				prerender: true,
			}
		},
		mounted() {
			this.handleTimer();
			this.$root.$on('loading', this.handlePrerender);
		},
		methods: {
			handlePrerender(bool) {
				this.prerender = bool;
			},
			handleTimer() {
				setInterval(() => {
					let now = new Date();
					this.hoursValue = now.getHours();
					this.minutesValue = now.getMinutes();
					this.date = now.toLocaleString('PL-pl', {weekday: 'long', month: 'long', day: 'numeric'});
				}, 1000);
			}
		},
		computed: {
			hours() {
				return this.hoursValue < 10 ? `0${this.hoursValue}` : this.hoursValue;
			},
			minutes() {
				return this.minutesValue < 10 ? `0${this.minutesValue}` : this.minutesValue;
			},
		}
	}
</script>

<style lang="less">
	.time {
		&__item {
			font-weight: 700;
			font-size: 130px;
			line-height: 1;
			letter-spacing: 2px;
		}

		&__wrapper {
			display: flex;
		}

		&__date {
			text-transform: capitalize;
			font-size: 34px;
		}
	}
</style>


