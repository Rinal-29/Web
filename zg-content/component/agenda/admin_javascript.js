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
 * This is a main javascript file from Zagitanank which contains all javascript in agenda.
 *
*/

$(document).ready(function() {
	$('#table-agenda').buildtable('route.php?mod=agenda&act=datatable');
});

$(document).ready(function() {
	$('#title-1').on('input', function() {
		var permalink;
		permalink = $.trim($(this).val());
		permalink = permalink.replace(/\s+/g,' ');
		$('#seotitle').val(permalink.toLowerCase());
		$('#seotitle').val($('#seotitle').val().replace(/\W/g, ' '));
		$('#seotitle').val($.trim($('#seotitle').val()));
		$('#seotitle').val($('#seotitle').val().replace(/\s+/g, '-'));
		var gappermalink = $('#seotitle').val();
		$('#permalink').html(gappermalink);
	});

	$('#seotitle').on('input', function() {
		var permalink;
		permalink = $(this).val();
		permalink = permalink.replace(/\s+/g,' ');
		$('#seotitle').val(permalink.toLowerCase());
		$('#seotitle').val($('#seotitle').val().replace(/\W/g, ' '));
		$('#seotitle').val($('#seotitle').val().replace(/\s+/g, '-'));
		var gappermalink = $('#seotitle').val();
		$('#permalink').html(gappermalink);
	});

	$('.del-image').click(function () {
		var id = $(this).attr("id");
		$('#alertdelimg').modal('show');
		$('.btn-del-image').attr("id",id);
	});

	$('.btn-del-image').click(function () {
		var id = $(this).attr("id");
		var dataString = 'id='+ id;
		$.ajax({
			type: "POST",
			url: "route.php?mod=agenda&act=delimage",
			data: dataString,
			cache: false,
			success: function(data){
				$('#alertdelimg').modal('hide');
				$('#image-box').hide();
				$('#picture').val('');
			}
		});
		return false;
	});

	initMCEall();

	$('.tiny-text').on('click', function (e) {
		e.stopPropagation();
		var id = $(this).attr("data-lang");
		tinymce.EditorManager.execCommand('mceRemoveEditor',true, 'po-wysiwyg-'+id);
	});

	$('.tiny-visual').on('click', function (e) {
		e.stopPropagation();
		var id = $(this).attr("data-lang");
		tinymce.EditorManager.execCommand('mceAddEditor',true, 'po-wysiwyg-'+id);
	});
 
});

$(document).ready(function() {
	$('#agendastartdate').datetimepicker({
		format: 'YYYY-MM-DD',
		showTodayButton: true,
		showClear: true
	});
    
    $('#agendaenddate').datetimepicker({
		format: 'YYYY-MM-DD',
		showTodayButton: true,
		showClear: true
	});
    
	$('#agendatime').datetimepicker({
		format: 'HH:mm:ss'
	});

	$("#agendastartdate").mask("9999/99/99");
    $("#agendaenddate").mask("9999/99/99");
	$("#agendatime").mask("99:99:99");
});
