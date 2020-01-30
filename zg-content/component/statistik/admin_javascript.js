/*
 *
 * - Zagitanank Javascript
 *
 * - File : admin_javascript.js
 * - Version : 1.0
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file utama javascript Zagitanank yang memuat semua javascript di halaman.
 * This is a main javascript file from Zagitanank which contains all javascript in statistik.
 *
*/

$(document).ready(function() {
	$('#table-statistik').buildtable('route.php?mod=statistik&act=datatable');
});

$(document).ready(function() {
	$('#table-dusun').buildtable('route.php?mod=statistik&act=datatabledusun');
});

$(document).ready(function() {
	$('#table-rw').buildtable('route.php?mod=statistik&act=datatablerw');
});

$(document).ready(function() {
	$('#table-pekerjaan').buildtable('route.php?mod=statistik&act=datatablepekerjaan');
});

$(document).ready(function() {
	$('#table-pendidikan').buildtable('route.php?mod=statistik&act=datatablependidikan');
});

$(document).ready(function() {
	$('#table-agama').buildtable('route.php?mod=statistik&act=datatableagama');
});

$(document).ready(function() {
	$('#table-kawin').buildtable('route.php?mod=statistik&act=datatablekawin');
});

$(document).ready(function() {
	$('#table-umur').buildtable('route.php?mod=statistik&act=datatableumur');
});

$(document).ready(function() {
	$('#table-sosial').buildtable('route.php?mod=statistik&act=datatablesosial');
});

$(document).ready(function() {
     $('#colordusun').colorpicker();
});