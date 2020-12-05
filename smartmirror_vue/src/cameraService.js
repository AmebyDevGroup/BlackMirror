import * as faceapi from 'face-api.js';

export default class CameraService {
	constructor() {
		this.handleFaceRecognition();
	}

	startVideo() {
		if (navigator.getUserMedia) {
			navigator.getUserMedia({ video: true }, this.handleSrc, this.handleError);
		}
	}

	handleSrc(stream) {
		const video = document.querySelector("#videoElement");
		video.srcObject = stream;

		video.addEventListener('play', () => {
			setInterval(async () => {
				const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceExpressions();

				if (detections.length === 0) {
					window.Vue.$root.$emit('screenSaver', false);
					return;
				}

				if (detections[0].detection.score >= 0.75) {
					window.Vue.$root.$emit('screenSaver', detections[0].detection.score);
				}
			}, 100);
		})
	}

	handleError(error) {
		console.log('error', error);
	}

	handleFaceRecognition() {
		Promise.all([
			faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
			faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
			faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
			faceapi.nets.faceExpressionNet.loadFromUri('/models')
		]).then(() => {
			this.startVideo();
		});
	}
}
