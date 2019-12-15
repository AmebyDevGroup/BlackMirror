<template>
	<div id="app" class="app">
		<div class="app__wrapper">
			<div class="app__section">
				<DateTime></DateTime>
			</div>
			<div class="app__section">
				<Calendar></Calendar>
			</div>
			<div class="app__section">
				<Tasks></Tasks>
			</div>
		</div>
		<div class="app__wrapper app__wrapper--right">
			<div class="app__section">
				<Weather></Weather>
			</div>
			<div class="app__section">
				<Air></Air>
			</div>
		</div>
		<div class="app__section app__section--news">
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
	import Calendar from "./components/Calendar";

	export default {
		name: 'app',
		components: {
			Calendar,
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
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		flex-wrap: wrap;
		height: 1600px;

		&__section {
			margin-bottom: 40px;

			&--news {
				margin: auto auto 20px;
			}
		}

		&__wrapper {
			display: flex;
			justify-content: flex-start;
			align-items: flex-start;
			flex-direction: column;
			margin-bottom: 40px;
			width: 58%;

			&--right {
				align-items: flex-end;
				width: 42%;
			}
		}
	}
</style>
