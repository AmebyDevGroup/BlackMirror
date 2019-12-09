<template>
	<div class="time">
		<span class="time__item" v-if="hoursValue">{{ hours }}:</span>
		<span class="time__item" v-if="minutesValue">{{ minutes }}:</span>
		<span class="time__item" v-if="secondsValue">{{ seconds }}</span>
	</div>
</template>

<script>
	export default {
		name: 'Time',
		data: function () {
			return {
				hoursValue: null,
				minutesValue: null,
				secondsValue: null,
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
					this.secondsValue = now.getSeconds()
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
		display: flex;

		&__item {
			font-size: 70px;
		}
	}
</style>


