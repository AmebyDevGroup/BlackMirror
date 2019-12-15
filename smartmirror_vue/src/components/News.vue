<template>
	<div v-if="show && data" class="news">
		<div class="news__wrapper">
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
	</div>
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
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('newsChange', this.handleData);

			this.updateCurrentNews();
		},
		methods: {
			handleConfig(event) {
				this.show = event.news;
			},
			handleData(data) {
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
			},
			updateCurrentNews() {
				let i = 0;

				setInterval(() => {
					if (i === this.data.length) i = 0;
					this.currentHours = this.data[i].hours;
					this.currentMinutes = this.data[i].minutes;
					this.currentTitle = this.data[i].title;
					this.currentDescription = this.data[i].description;
					i++;
				}, 7000);
			},
		},
	}
</script>

<style lang="less">
	.news {
		&__wrapper {
			max-width: 900px;
			width: 100%;
			padding: 15px;
			background: #252525;
			border-radius: 10px;
			margin: auto;
		}

		&__item {
			display: flex;
			justify-content: flex-start;
			align-items: center;

			&-date {
				margin-right: 20px;
			}

			&-content {
				display: flex;
				flex-direction: column;
			}

			&-title {
				font-size: 16px;
				margin-bottom: 10px;
			}

			&-description {
				font-size: 14px;
			}
		}
	}
</style>
