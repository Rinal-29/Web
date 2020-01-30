<?php
/*
 *
 * - Zagitanank Front End File
 *
 * - File : pemdes.php
 * - Version : 1.1
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk halaman kategori.
 * This is a php file for handling front end process for pemdes page.
 *
*/

/**
 * Router untuk memproses request $_POST[] pemdes.
 *
 * Router for process request $_POST[] pemdes.
 *
*/
$router->match('GET|POST', '/pemdes', function() use ($core, $templates) {
	$lang = $core->setlang('pemdes', WEB_LANG);
	$info = array(
		'page_title' => $lang['front_pemdes_title'],
		'page_desc' => $core->posetting[2]['value'],
		'page_key' => $core->posetting[3]['value'],
		'social_mod' => $lang['front_pemdes_title'],
		'social_name' => $core->posetting[0]['value'],
		'social_url' => $core->posetting[1]['value'].'/pemdes',
		'social_title' => $core->posetting[0]['value'],
		'social_desc' => $core->posetting[2]['value'],
		'social_img' => $core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png',
		'page' => '1'
	);
	$adddata = array_merge($info, $lang);
	$templates->addData(
		$adddata
	);
	echo $templates->render('pemdes', compact('lang'));
});