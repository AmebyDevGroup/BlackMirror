<template>
	<div v-if="show" class="tasks">
		<span class="tasks__title">{{title}}</span>
		<div v-for="item in data" class="tasks__item">
			<div>Autor: {{ item.owner }}</div>
			<div>Tytuł: {{ item.title }}</div>
			<div>Opis: {{ item.description }}</div>
			<div>Priorytet: {{ item.priority }}</div>
			<div v-if="item.deadline_at">Deadline: {{ item.deadline_at }}</div>
			<div>Utworzono: {{ item.created_at }}</div>
			<div v-if="item.updated_at">Update: {{ item.updated_at }}</div>
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
				this.data = data;
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
		}
	}
</style>
