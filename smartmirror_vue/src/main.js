import Vue from 'vue'
import App from './App.vue'
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

const echo = new Echo({
    broadcaster: 'pusher',
    key: 123456,
    cluster: 'mt1',
    // encrypted: true
    wsHost: '86.63.86.150',
    wsPort: 6001
});

echo.channel('mirror')
  .listen('Message', (e) => {
      console.log(e);
      window.Vue.$root.$emit(`${e.type}Change`, e.data);
  });

Vue.config.productionTip = false;

window.Vue = new Vue({
  render: h => h(App),
}).$mount('#app');
