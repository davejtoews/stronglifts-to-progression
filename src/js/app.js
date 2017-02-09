import 'whatwg-fetch';
var FileSaver = require('file-saver');

function populateFws(workouts) {
	document.querySelector('#fws').value = JSON.stringify(workouts);
}

function populateUp(program) {
	document.querySelector('#up').value = JSON.stringify(program);
}

function saveFws() {
	var blob = new Blob([document.querySelector('#fws').value], {type: "text/plain;charset=utf-8"});
	FileSaver.saveAs(blob, "fws.json");
}
	
function saveUp() {
	var blob = new Blob([document.querySelector('#up').value], {type: "text/plain;charset=utf-8"});
	FileSaver.saveAs(blob, "up.json");
}

function responseError() {
	var errorString = 'Problem with response from server. Please ensure you have uploaded the correct file.';
	document.querySelector('#fws').value = errorString;
	document.querySelector('#up').value = errorString;
}
	
function getAjax() {
	event.preventDefault();
	var form = document.querySelector('form');
	fetch('ajax.php', {
		method: 'POST',
		body: new FormData(form)
	}).then(function(response) {
		console.log(response);
	    return response.json()
	}).then(function(json) {
		var workouts = (json.workouts.length) ? json.workouts : "Problem generating workouts";
		populateFws(workouts);
		var program = (json.program.length) ? json.program : "Problem generating program";
		populateUp(program);
	}).catch(function(ex) {
		responseError();
		console.log('parsing failed', ex)
	});
}

window.onload = function () {
	document.querySelector('form').addEventListener('submit', function(event){
		event.preventDefault();
		getAjax();
	});

	document.querySelector('#saveFws').addEventListener('submit', function(event){
		event.preventDefault();
		saveFws();
	});

	document.querySelector('#saveUp').addEventListener('submit', function(event){
		event.preventDefault();
		saveUp();
	});

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-57700392-9', 'auto');
	ga('send', 'pageview');

}