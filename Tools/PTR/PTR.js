dns = require("dns");

var result = [];

async function reverse(ip) {
	dns.reverse(ip, function(err, hostnames) {
		let obj = {};
		obj[ip] = hostnames != null ? hostnames[0] : "";
		result.push(obj);
	});
}

for (i = 0; i <= 255; i++) {
	reverse(process.argv[2]+i);
}

let interval = setInterval(function() {
	if (result.length == 256) {
		console.log(JSON.stringify(result));
		clearInterval(interval);
	}
}, 100);