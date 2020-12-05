<template>
	<div class="screen-saver" :class="{'active': show}"></div>
</template>

<script>
	export default {
		name: 'ScreenSaver',
		data: function () {
			return {
				show: false,
				counter: 20,
				timer: null,
			}
		},
		mounted() {
			this.$root.$on('screenSaver', this.handleScreenSaver);
			this.$root.$on('hideSaver', this.handleErrorConnection);
			this.countToHide();
		},
		methods: {
      handleErrorConnection(error) {
        this.show = !error;
      },
			handleScreenSaver(data) {
				if (!data) return;
				this.counter = 20;
			},
			countToHide() {
				this.timer = setInterval( () => {
					if (this.counter > 0) {
						this.counter--;
						this.show = false;
					} else {
						clearInterval(this.timer);
						this.countToHide();
						this.show = true;
					}
				}, 1000);
			}
		},
	}
</script>

<style lang="less">
	.screen-saver {
		position: fixed;
		top: 0;
		right: 0;
		left: 0;
		bottom: 0;
		z-index: 100;
		background: black;
		width: 100vw;
		height: 100vh;
		opacity: 0;
		visibility: hidden;
		transition: 1s ease all;

		&.active {
			opacity: 1;
			visibility: visible;
		}
	}
</style>
