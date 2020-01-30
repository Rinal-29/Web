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
 * Ini adalah file utama javascript Zagitanank yang memuat semua javascript di kategori.
 * This is a main javascript file from Zagitanank which contains all javascript in category.
 *
*/

$(document).ready(function() {
	$('#table-category').buildtable('route.php?mod=category&act=datatable');
});
