<template>
	<div v-if="show" class="news">
		<div class="news__wrapper">
			<div v-for="(item, index) in data" class="news__item" v-if="index < 1">
				<span class="news__item-date">
					{{ item.hours }}:{{ item.minutes }}
				</span>
				<div class="news__item-content">
					<div class="news__item-title">{{ item.title }}</div>
					<div class="news__item-description">{{ item.description }}</div>
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
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('newsChange', this.handleData);
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
			}
		}
	}
</script>

<style lang="less">
	.news {
		&__wrapper {
			max-width: 90%;
			padding: 10px;
			background: #252525;
			border-radius: 10px;
			margin: auto;
		}

		&__item {
			display: flex;
			justify-content: flex-start;
			align-items: center;

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

			&-date {
				margin-right: 20px;
			}
		}
	}
</style>
