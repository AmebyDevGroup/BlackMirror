import Vue from 'vue'
import App from './App.vue'
import Echo from 'laravel-echo';
import CameraService from './cameraService';

window.Pusher = require('pusher-js');
window.io = require('socket.io-client');

let eventCounter = 0;
let activeSections = 0;
let module_inactive = false;

const handleLoading = (ev) => {
	const data = Object.values(ev.data);
	activeSections = [...data].filter(elem => elem === true).length;
	if (activeSections === 0) module_inactive = true;
};

const echo = new Echo({
	broadcaster: 'socket.io',
	key: "023a905bee315629c3157500199f5065",
	// cluster: 'mt1',
	// encrypted: true
	host: 'https://ws.myblackmirror.pl',
});

setTimeout(() => {
	const isConnected = echo.connector.socket.connected;
	console.log('isConnected', isConnected);
	if (!isConnected) window.Vue.$root.$emit('connectionError', isConnected);
}, 5000)

echo.join('mirror.123')
	.here((users) => {
		console.log(users)
	})
	.joining((user) => {
		console.log(user.name);
	})
	.leaving((user) => {
		console.log(user.name);
	})
	.listen('Message', (e) => {
		console.log(e);
		if (e.type === "config") handleLoading(e);
		window.Vue.$root.$emit(`${e.type}Change`, e.data);
		eventCounter++;
		if (eventCounter === activeSections || module_inactive) {
			setTimeout(() => {
				window.Vue.$root.$emit('loading', false);
				window.Vue.$root.$emit('connectionError', echo.connector.socket.connected);
				window.Vue.$root.$emit('hideSaver', echo.connector.socket.connected);
				new CameraService();
			}, 500)
		}
	});

Vue.config.productionTip = false;

window.Vue = new Vue({
	render: h => h(App),
}).$mount('#app');
