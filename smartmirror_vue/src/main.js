import Vue from 'vue'
import App from './App.vue'
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

let eventCounter = 0;
let activeSections = 0;

const handleLoading = (ev) => {
	const data = Object.values(ev.data);
	activeSections = [...data].filter(elem => elem === true).length;
};

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
		if (e.type === "config") handleLoading(e);
		window.Vue.$root.$emit(`${e.type}Change`, e.data);
		eventCounter++;
		if (eventCounter === activeSections) window.Vue.$root.$emit('loading', false);
	});

Vue.config.productionTip = false;

window.Vue = new Vue({
	render: h => h(App),
}).$mount('#app');
