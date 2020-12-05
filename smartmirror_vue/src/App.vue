<template>
	<div id="app" class="app">
		<video autoplay="true" id="videoElement"></video>
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
				<HomeSensors></HomeSensors>
			</div>
			<div class="app__section">
				<Air></Air>
			</div>
			<div class="app__section">
				<CoronaVirus></CoronaVirus>
			</div>
		</div>
		<div class="app__section app__section--news">
			<News></News>
		</div>
		<Loader></Loader>
		<ScreenSaver></ScreenSaver>
		<ConnectionError></ConnectionError>
	</div>
</template>

<script>
	import Weather from "./components/Weather";
	import Air from "./components/Air";
	import Tasks from "./components/Tasks";
	import DateTime from "./components/DateTime";
	import News from "./components/News";
	import Calendar from "./components/Calendar";
	import Loader from "./components/Loader";
	import CoronaVirus from "./components/CoronaVirus";
	import ScreenSaver from "./components/ScreenSaver";
	import HomeSensors from "./components/HomeSensors";
  import ConnectionError from "@/components/ConnectionError";

	export default {
		name: 'app',
		components: {
      ConnectionError,
			HomeSensors,
			ScreenSaver,
			CoronaVirus,
			Loader,
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
		overflow: hidden;

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

		video {
			display: none;
		}

		.fade-right-enter-active, .fade-right-leave-active {
			animation: fade-in-right 1.2s both;
		}

		.fade-left-enter-active, .fade-left-leave-active {
			animation: fade-in-left 1.2s both;
		}

		.fade-bottom-enter-active, .fade-bottom-leave-active {
			animation: fade-in-bottom 1.2s both;
		}

		@keyframes fade-in-bottom {
			0% {
				transform: translateY(50px);
				opacity: 0;
			}

			100% {
				transform: translateX(0);
				opacity: 1;
			}
		}

		@keyframes fade-in-left {
			0% {
				transform: translateX(-50px);
				opacity: 0;
			}

			100% {
				transform: translateX(0);
				opacity: 1;
			}
		}

		@keyframes fade-in-right {
			0% {
				transform: translateX(50px);
				opacity: 0;
			}

			100% {
				transform: translateX(0);
				opacity: 1;
			}
		}

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
