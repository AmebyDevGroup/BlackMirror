<template>
  <div id="app">
    <div class="app__section">
      <DateTime></DateTime>
    </div>
    <div class="app__section">
      <Weather></Weather>
    </div>
    <div class="app__wrapper">
      <Air></Air>
    </div>
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
    &__section {
      margin-bottom: 40px;
    }

    &__wrapper {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }
  }
</style>
