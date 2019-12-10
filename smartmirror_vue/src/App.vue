<template>
  <div id="app">
    <Weather></Weather>
    <DateTime></DateTime>
  </div>
</template>

<script>
import Weather from "./components/Weather";
import DateTime from "./components/DateTime";

export default {
  name: 'app',
  components: {
    Weather,
    DateTime,
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
