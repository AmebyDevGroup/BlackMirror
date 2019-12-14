<template>
	<div v-if="show" class="tasks">
		<span class="tasks__title">{{title}}</span>
		<div v-for="item in data" class="tasks__item">
			<div class="tasks__item-content">
				<div class="tasks__item-title">{{ item.title }}</div>
				<div class="tasks__item-description" v-if="item.description">{{ item.description }}</div>
				<div v-if="item.deadline" class="tasks__deadline">
					<span class="tasks__deadline-alert">{{ item.deadline }}</span>
				</div>
			</div>
			<div class="tasks__priority">{{ item.priority }}</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'Tasks',
		data: function () {
			return {
				title: 'Tasks',
				data: [],
				show: false,
			}
		},
		mounted() {
			this.$root.$on('configChange', this.handleConfig);
			this.$root.$on('tasksChange', this.handleData);
		},
		methods: {
			handleConfig(event) {
				this.show = event.tasks;
			},
			handleData(data) {
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
			margin-bottom: 20px;
			display: flex;
			align-items: center;
			justify-content: flex-start;
			padding: 10px 0;
			border-bottom: 1px solid #505050;
			max-width: 800px;
			width: 100%;

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
				font-size: 18px;
			}

			&-description {
				font-size: 16px;
				margin-bottom: 10px;
			}
		}

		&__deadline {
			font-size: 12px;
			&-alert {
				color: red;
			}
		}
	}
</style>
