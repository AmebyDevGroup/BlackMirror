import Vue from 'vue'
import App from './App.vue'
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 123456,
    cluster: 'mt1',
    // encrypted: true
    wsHost: 'localhost',
    wsPort: 6001
});

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
}).$mount('#app')
