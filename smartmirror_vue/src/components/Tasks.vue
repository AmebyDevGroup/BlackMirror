<template>
	<transition name="fade-left">
		<div v-if="show && data && !prerender" class="tasks">
			<span class="tasks__title">{{title}}</span>
			<ul>
				<li v-for="item in data"
						class="tasks__item"
						:class="{'star': item.priority === 'high'}">
					<div class="tasks__item-content">
						<div class="tasks__item-title">{{ item.title }}</div>
						<div class="tasks__item-description" v-if="item.description">{{ item.description }}</div>
						<div v-if="item.deadline" class="tasks__deadline">
							<span class="tasks__deadline-alert">{{ item.deadline }}</span>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</transition>
</template>

<script>
	export default {
		name: 'Tasks',
		data: function () {
			return {
				title: 'TODO',
				data: [],
				show: false,
				prerender: true,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('tasksChange', this.handleData);
			this.$root.$on('loading', this.handlePrerender);
		},
		methods: {
			handlePrerender(bool) {
				this.prerender = bool;
			},
			handleConfig(event) {
				this.show = event.tasks;
			},
			handleData(data) {
				if (data.hasOwnProperty('status') && data.status === 'failed') {
					this.show = false;
					return;
				}
				this.data = data.map(elem => {
					const deadlineDate = elem.deadline_at ? new Date(elem.deadline_at) : null;
					const day = deadlineDate ? deadlineDate.toLocaleString('PL-pl', {weekday: 'long', month: 'long', day: 'numeric'}) : null;
					return {...elem, deadline: day}
				});
			}
		}
	}
</script>

<style lang="less">
	.tasks {
		&__title {
			font-size: 30px;
			margin-bottom: 15px;
			display: block;
		}

		&__item {
			margin-bottom: 10px;
			display: flex;
			align-items: center;
			justify-content: flex-start;
			max-width: 800px;
			width: 100%;
			position: relative;

			&.star {
				&:before {
					background-image: url("../assets/star.svg");
					background-color: black;
					background-size: contain;
					background-repeat: no-repeat;
					width: 18px;
					height: 18px;
					left: -33px;
					top: 2px;
				}
			}

			&:before {
				content: '';
				width: 13px;
				height: 13px;
				border-radius: 50%;
				position: absolute;
				left: -30px;
				top: 3px;
				background-color: white;
			}

			&-content {
				display: flex;
				flex-direction: column;
				position: relative;
				max-width: 700px;
				width: 100%;
				margin-right: 25px;
			}

			&-title {
				margin-bottom: 10px;
				font-size: 16px;
				text-transform: uppercase;
			}

			&-description {
				font-size: 16px;
				margin-bottom: 10px;
			}
		}

		&__deadline {
			font-size: 14px;

			&-alert {
				color: red;
			}
		}
	}
</style>
