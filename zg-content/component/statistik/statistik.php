<?php
/*
 *
 * - Zagitanank Front End File
 *
 * - File : statistik.php
 * - Version : 1.1
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk halaman kategori.
 * This is a php file for handling front end process for statistik page.
 *
*/

/**
 * Router untuk memproses request $_POST[] statistik.
 *
 * Router for process request $_POST[] statistik.
 *
*/
$router->match('GET|POST', '/statistik', function() use ($core, $templates) {
	$lang = $core->setlang('statistik', WEB_LANG);
	$info = array(
		'page_title' => $lang['front_statistik_title'],
		'page_desc' => $core->posetting[2]['value'],
		'page_key' => $core->posetting[3]['value'],
		'social_mod' => $lang['front_statistik_title'],
		'social_name' => $core->posetting[0]['value'],
		'social_url' => $core->posetting[1]['value'].'/statistik',
		'social_title' => $core->posetting[0]['value'],
		'social_desc' => $core->posetting[2]['value'],
		'social_img' => $core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png',
		'page' => '1'
	);
	$adddata = array_merge($info, $lang);
	$templates->addData(
		$adddata
	);
	echo $templates->render('statistik', compact('lang'));
});