/*
 *
 * - Zagitanank Javascript
 *
 * - File : admin_javascript.js
 * - Version : 1.0
 * - Author : Jenuar Dalapang
 * - License : MIT License
 *
 *
 * Ini adalah file utama javascript Zagitanank yang memuat semua javascript di komponen.
 * This is a main javascript file from Zagitanank which contains all javascript in component.
 *
*/

$(document).ready(function() {
	$('#table-component').buildtable('route.php?mod=component&act=datatable');
});
