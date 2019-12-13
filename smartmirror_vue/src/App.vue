<template>
	<div id="app">
		<div class="app__section">
			<DateTime></DateTime>
		</div>
		<div class="app__section">
			<Weather></Weather>
		</div>
		<div class="app__section">
			<Air></Air>
		</div>
		<div class="app__section">
			<Tasks></Tasks>
		</div>
	</div>
</template>

<script>
	import Weather from "./components/Weather";
	import Air from "./components/Air";
	import Tasks from "./components/Tasks";
	import DateTime from "./components/DateTime";

	export default {
		name: 'app',
		components: {
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
	}
</style>
