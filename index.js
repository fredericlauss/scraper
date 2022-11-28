const fetch = require('node-fetch');

const getReddit = async () => {
	const response = await fetch('http://vps-a47222b1.vps.ovh.net:8484/');
	const body = await response.text();
	console.log(body); // prints a chock full of HTML richness
	return body;
};