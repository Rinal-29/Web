<?php
/*
 *
 * - Zagitanank Front End File
 *
 * - File : pengumuman.php
 * - Version : 1.1
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk halaman kategori.
 * This is a php file for handling front end process for pengumuman page.
 *
*/

/**
 * Router untuk menampilkan request halaman kategori.
 *
 * Router for display request in pengumuman page.
 *
 * $seotitle = string [a-z0-9_-]
*/
$router->match('GET|POST', '/pengumuman/([a-z0-9_-]+)', function($seotitle) use ($core, $templates) {
	$lang = $core->setlang('pengumuman', WEB_LANG);
	if ($seotitle == 'all') {
		$pengumuman = array(
			'title' => $lang['front_pengumuman'],
			'seotitle' => 'all',
			'picture' => ''
		);
	} else {
		$pengumuman = $core->podb->from('pengumuman')
			->select(array('pengumuman_description.title'))
			->leftJoin('pengumuman_description ON pengumuman_description.id_pengumuman = pengumuman.id_pengumuman')
			->where('pengumuman.seotitle', $seotitle)
			->where('pengumuman_description.id_language', WEB_LANG_ID)
			->where('pengumuman.active', 'Y')
			->limit(1)
			->fetch();
	}
	if ($pengumuman) {
		$info = array(
			'page_title' => htmlspecialchars_decode($pengumuman['title']),
			'page_desc' => $pengumuman['title'].' - '.$core->posetting[2]['value'],
			'page_key' => $pengumuman['title'],
			'social_mod' => $lang['front_pengumuman_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'].'/pengumuman/'.$pengumuman['seotitle'],
			'social_title' => htmlspecialchars_decode($pengumuman['title']),
			'social_desc' => $pengumuman['title'].' - '.$core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'].'/'.DIR_CON.'/uploads/'.$pengumuman['picture'],
			'page' => '1'
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('pengumuman', compact('pengumuman','lang'));
	} else {
		$info = array(
			'page_title' => $lang['front_pengumuman_not_found'],
			'page_desc' => $core->posetting[2]['value'],
			'page_key' => $core->posetting[3]['value'],
			'social_mod' => $lang['front_pengumuman_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'],
			'social_title' => $lang['front_pengumuman_not_found'],
			'social_desc' => $core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png'
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('404', compact('lang'));
	}
});

/**
 * Router untuk menampilkan request halaman pengumuman dengan nomor halaman.
 *
 * Router for display request in pengumuman page with pagination.
 *
 * $seotitle = string [a-z0-9_-]
 * $page = integer
*/
$router->match('GET|POST', '/pengumuman/([a-z0-9_-]+)/page/(\d+)', function($seotitle, $page) use ($core, $templates) {
	$lang = $core->setlang('pengumuman', WEB_LANG);
	if ($seotitle == 'all') {
		$pengumuman = array(
			'title' => $lang['front_pengumuman'],
			'seotitle' => 'all',
			'picture' => ''
		);
	} else {
		$pengumuman = $core->podb->from('pengumuman')
			->select(array('pengumuman_description.title'))
			->leftJoin('pengumuman_description ON pengumuman_description.id_pengumuman = pengumuman.id_pengumuman')
			->where('pengumuman.seotitle', $seotitle)
			->where('pengumuman_description.id_language', WEB_LANG_ID)
			->where('pengumuman.active', 'Y')
			->limit(1)
			->fetch();
	}
	if ($pengumuman) {
		$info = array(
			'page_title' => htmlspecialchars_decode($pengumuman['title']),
			'page_desc' => $pengumuman['title'].' - '.$core->posetting[2]['value'],
			'page_key' => $pengumuman['title'],
			'social_mod' => $lang['front_pengumuman_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'].'/pengumuman/'.$pengumuman['seotitle'],
			'social_title' => htmlspecialchars_decode($pengumuman['title']),
			'social_desc' => $pengumuman['title'].' - '.$core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'].'/'.DIR_CON.'/uploads/'.$pengumuman['picture'],
			'page' => $page
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('pengumuman', compact('pengumuman','lang'));
	} else {
		$info = array(
			'page_title' => $lang['front_pengumuman_not_found'],
			'page_desc' => $core->posetting[2]['value'],
			'page_key' => $core->posetting[3]['value'],
			'social_mod' => $lang['front_pengumuman_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'],
			'social_title' => $lang['front_pengumuman_not_found'],
			'social_desc' => $core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png'
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('404', compact('lang'));
	}
});
