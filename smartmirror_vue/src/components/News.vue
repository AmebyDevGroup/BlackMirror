<template>
	<transition name="fade-bottom">
		<div v-if="show && data && !prerender" class="news">
			<transition name="expand"
									@enter="enter"
									@after-enter="afterEnter"
									@leave="leave">
				<div class="news__wrapper" :key="currentTitle">
					<div class="news__item">
						<span class="news__item-date"
						v-if="currentHours">
						{{ currentHours }}:{{ currentMinutes }}
						</span>
						<div class="news__item-content">
								<div class="news__item-title" v-if="currentTitle">{{ currentTitle }}</div>
								<div class="news__item-description" v-if="currentDescription">{{ currentDescription }}</div>
						</div>
					</div>
				</div>
			</transition>
		</div>
	</transition>
</template>

<script>
	export default {
		name: 'News',
		data: function () {
			return {
				data: [],
				show: false,
				currentHours: false,
				currentMinutes: false,
				currentTitle: false,
				currentDescription: false,
				prerender: true,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('newsChange', this.handleData);
			this.$root.$on('loading', this.handlePrerender);
			this.updateCurrentNews();
		},
		methods: {
			handlePrerender(bool) {
				this.prerender = bool;
			},
			enter(element) {
				const width = getComputedStyle(element).width;
				element.style.width = width;
				element.style.position = 'absolute';
				element.style.visibility = 'hidden';
				element.style.height = 'auto';
				const height = getComputedStyle(element).height;
				element.style.width = null;
				element.style.position = null;
				element.style.visibility = null;
				element.style.height = 0;
				getComputedStyle(element).height;
				setTimeout(() => {
					element.style.height = height;
				});
			},
			afterEnter(element) {
				element.style.height = 'auto';
			},
			leave(element) {
				const height = getComputedStyle(element).height;
				element.style.height = height;
				getComputedStyle(element).height;
				setTimeout(() => {
					element.style.height = 0;
				});
			},
			handleConfig(event) {
				this.show = event.news;
			},
			handleData(data) {
				if (data.hasOwnProperty('status') && data.status === 'failed') {
					this.show = false;
					return;
				}
				return new Promise((resolve) => {
					this.data = data.items.map(elem => {
						const hours = new Date(elem.date).getHours();
						const hoursFormatted = hours < 10 ? `0${hours}` : hours;
						const minutes = new Date(elem.date).getMinutes();
						const minutesFormatted = minutes < 10 ? `0${minutes}` : minutes;

						return {
							hours: hoursFormatted,
							minutes: minutesFormatted,
							title: elem.title,
							description: elem.description,
						}
					});
					return resolve(this.data);
				}).then(() => {
					this.getInitialData();
				})
			},
			getInitialData() {
				this.currentHours = this.data[0].hours;
				this.currentMinutes = this.data[0].minutes;
				this.currentTitle = this.data[0].title;
				this.currentDescription = this.data[0].description;
			},
			updateCurrentNews() {
				let i = 0;

				setInterval(() => {
				  if (this.data.length === 0) return;
					if (i === this.data.length) i = 0;
					this.currentHours = this.data[i].hours;
					this.currentMinutes = this.data[i].minutes;
					this.currentTitle = this.data[i].title;
					this.currentDescription = this.data[i].description;
					i++;
				}, 15000);
			},
		},
	}
</script>

<style lang="less">
	.news {
		.expand-enter-active,
		.expand-leave-active {
			transition: all 0.75s ease;
			visibility: visible;
			opacity: 1;
		}

		.expand-enter,
		.expand-leave-to {
			height: 0;
			opacity: 0;
			visibility: hidden;
		}

		&__wrapper {
			max-width: 950px;
			width: 100%;
			padding: 15px;
			background: #383838;
			border-radius: 10px;
			margin: auto;
			position: relative;
		}

		&__item {
			display: flex;
			justify-content: flex-start;
			align-items: center;

			&-date {
				margin-right: 20px;
				font-size: 20px;
				position: absolute;
				top: -35px;
				left: 15px;
			}

			&-content {
				display: flex;
				flex-direction: column;
			}

			&-title {
				font-size: 20px;
				font-weight: 700;
				margin-bottom: 10px;
			}

			&-description {
				font-size: 18px;
			}
		}
	}
</style>
