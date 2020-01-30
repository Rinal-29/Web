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
 * Ini adalah file utama javascript Zagitanank yang memuat semua javascript di pustaka.
 * This is a main javascript file from Zagitanank which contains all javascript in library.
 *
*/

$(document).ready(function() {
	$('#table-library').buildtable('route.php?mod=library&act=datatable');
});
