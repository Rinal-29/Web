<?php
/*
 *
 * - Zagitanank Front End File
 *
 * - File : document.php
 * - Version : 1.0
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk halaman kontak.
 * This is a php file for handling front end process for document page.
 *
*/

/**
 * Router untuk memproses request $_POST[] dokumen.
 *
 * Router for process request $_POST[] document.
 *
*/
$router->match('GET|POST', '/document', function() use ($core, $templates) {
	$lang = $core->setlang('document', WEB_LANG);
	$info = array(
		'page_title' => $lang['front_document_title'],
		'page_desc' => $core->posetting[2]['value'],
		'page_key' => $core->posetting[3]['value'],
		'social_mod' => $lang['front_document_title'],
		'social_name' => $core->posetting[0]['value'],
		'social_url' => $core->posetting[1]['value'].'/document',
		'social_title' => $core->posetting[0]['value'],
		'social_desc' => $core->posetting[2]['value'],
		'social_img' => $core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png',
		'page' => '1'
	);
	$adddata = array_merge($info, $lang);
	$templates->addData(
		$adddata
	);
	echo $templates->render('document', compact('lang'));
});

/**
 * Router untuk memproses request $_POST[] semua kategori dokumen.
 *
 * Router for process request $_POST[] document all category.
 *

$router->match('GET|POST', '/category-document/([a-z0-9_-]+)', function() use ($core, $templates) {
	$lang = $core->setlang('document', WEB_LANG);
	$info = array(
		'page_title' => $lang['front_category_document_title'],
		'page_desc' => $core->posetting[2]['value'],
		'page_key' => $core->posetting[3]['value'],
		'social_mod' => $lang['front_category_document_title'],
		'social_name' => $core->posetting[0]['value'],
		'social_url' => $core->posetting[1]['value'].'/document',
		'social_title' => $core->posetting[0]['value'],
		'social_desc' => $core->posetting[2]['value'],
		'social_img' => $core->posetting[1]['value'].'/'.DIR_INC.'/images/favicon.png',
		'page' => '1'
	);
	$adddata = array_merge($info, $lang);
	$templates->addData(
		$adddata
	);
	echo $templates->render('categorydocument', compact('lang'));
});
*/
$router->match('GET|POST', '/category-document/([a-z0-9_-]+)', function($seotitle) use ($core, $templates) {
	$lang = $core->setlang('document', WEB_LANG);
	if ($seotitle == 'all') {
		$category = array(
			'title' => $lang['front_category_document_all'],
			'seotitle' => 'all',
			'picture' => ''
		);

	} else {
		$category = $core->podb->from('category_document')
			->select(array('category_document_description.title'))
			->leftJoin('category_document_description ON category_document_description.id_category_document = category_document.id_category_document')
			->where('category_document.seotitle', $seotitle)
			->where('category_document_description.id_language', WEB_LANG_ID)
			->where('category_document.active', 'Y')
			->limit(1)
			->fetch();
	}
	if ($category) {
		$info = array(
			'page_title' => htmlspecialchars_decode($category['title']),
			'page_desc' => $category['title'].' - '.$core->posetting[2]['value'],
			'page_key' => $category['title'],
			'social_mod' => $lang['front_category_document_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'].'/category-document/'.$category['seotitle'],
			'social_title' => htmlspecialchars_decode($category['title']),
			'social_desc' => $category['title'].' - '.$core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'].'/'.DIR_CON.'/uploads/download_file.png',
			'page' => '1'
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('categorydocument', compact('category','lang'));
	} else {
		$info = array(
			'page_title' => $lang['front_category_document_not_found'],
			'page_desc' => $core->posetting[2]['value'],
			'page_key' => $core->posetting[3]['value'],
			'social_mod' => $lang['front_category_document_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'],
			'social_title' => $lang['front_category_document_not_found'],
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