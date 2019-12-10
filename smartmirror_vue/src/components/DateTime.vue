<template>
	<div class="time">
		<div class="time__date">{{ date }}</div>
		<div class="time__wrapper">
			<span class="time__item" v-if="hoursValue !== null">{{ hours }}:</span>
			<span class="time__item" v-if="minutesValue !== null">{{ minutes }}:</span>
			<span class="time__item" v-if="secondsValue !== null">{{ seconds }}</span>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'DateTime',
		data: function () {
			return {
				hoursValue: null,
				minutesValue: null,
				secondsValue: null,
			  	date: null,
			}
		},
		mounted() {
			this.handleTimer();
		},
	  	methods: {
			handleTimer() {
				setInterval(() => {
					let now = new Date();
					this.hoursValue = now.getHours();
					this.minutesValue = now.getMinutes();
					this.secondsValue = now.getSeconds();
					this.date = now.toLocaleString('PL-pl', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
				}, 1000);
			}
		},
	  	computed: {
			hours() {
				return this.hoursValue < 10 ? `0${this.hoursValue}`: this.hoursValue;
			},
			minutes() {
				return this.minutesValue < 10 ? `0${this.minutesValue}`: this.minutesValue;
			},
			seconds() {
				return this.secondsValue < 10 ? `0${this.secondsValue}`: this.secondsValue;
			},
		}
	}
</script>

<style lang="less">
	.time {
		&__item {
			font-size: 70px;
		}

		&__wrapper {
			display: flex;
		}

		&__date {
			text-transform: capitalize;
			font-size: 30px;
		}
	}
</style>


