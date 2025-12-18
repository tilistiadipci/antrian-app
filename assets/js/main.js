var span = document.getElementById("span");

function time() {
	var d = new Date();
	var s = d.getSeconds();
	var m = d.getMinutes();
	var h = d.getHours();
	span.textContent =
		("0" + h).substr(-2) +
		":" +
		("0" + m).substr(-2) +
		":" +
		("0" + s).substr(-2);
}

setInterval(time, 1000);

window.setTimeout("hari()", 0);
function hari() {
	var namah = new Array(
		"Minggu",
		"Senin",
		"Selasa",
		"Rabu",
		"Kamis",
		"Jum'at",
		"Sabtu"
	);
	var namab = new Array(
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Agu",
		"Sep",
		"Nov",
		"Des"
	);
	var tanggal = new Date();
	setTimeout("hari()", 0);
	document.getElementById("dino").innerHTML =
		tanggal.getDate() +
		" " +
		namab[tanggal.getMonth()-1] +
		" " +
		tanggal.getFullYear();
	document.getElementById("dino1").innerHTML = namah[tanggal.getDay()];
}
