<template>
  <div id="app">
    <div class="app__wrapper">
      <DateTime></DateTime>
      <Weather></Weather>
    </div>
    <Air></Air>
  </div>
</template>

<script>
import Weather from "./components/Weather";
import Air from "./components/Air";
import DateTime from "./components/DateTime";

export default {
  name: 'app',
  components: {
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
  }

  .app {
    &__wrapper {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 20px;
    }
  }
</style>
