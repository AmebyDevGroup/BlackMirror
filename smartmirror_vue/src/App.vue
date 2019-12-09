<template>
  <div id="app">
    <Weather></Weather>
    <Time></Time>
  </div>
</template>

<script>
import Weather from "./components/Weather";
import Time from "./components/Time";

export default {
  name: 'app',
  components: {
    Weather,
    Time,
  }
}
</script>

<style>
  body {
    background-color: black;
    color: white;
    font-family: 'Montserrat', sans-serif;
    padding: 15px;
  }
</style>
