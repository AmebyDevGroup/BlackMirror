<template>
	<div id="app">
		<div class="app__wrapper">
			<DateTime></DateTime>
			<Weather></Weather>
		</div>
		<div class="app__section">
			<Air></Air>
		</div>
		<div class="app__section">
			<Tasks></Tasks>
		</div>
		<div class="app__section">
			<News></News>
		</div>
	</div>
</template>

<script>
	import Weather from "./components/Weather";
	import Air from "./components/Air";
	import Tasks from "./components/Tasks";
	import DateTime from "./components/DateTime";
	import News from "./components/News";

	export default {
		name: 'app',
		components: {
			News,
			Tasks,
			Weather,
			Air,
			DateTime,
		}
	}
</script>

<style lang="less">
	body {
		background-color: black;
		color: white;
		font-family: 'Montserrat', sans-serif;
		padding: 15px;

		* {
			box-sizing: border-box;
		}
	}

	.app {
		&__section {
			margin-bottom: 40px;
		}

		&__wrapper {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			margin-bottom: 40px;
		}
	}
</style>
