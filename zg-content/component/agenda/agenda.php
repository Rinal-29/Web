<?php
/*
 *
 * - Zagitanank Front End File
 *
 * - File : agenda.php
 * - Version : 1.1
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk halaman kategori.
 * This is a php file for handling front end process for agenda page.
 *
*/

/**
 * Router untuk menampilkan request halaman agenda.
 *
 * Router for display request in agenda page.
 *
 * $seotitle = string [a-z0-9_-]
*/
$router->match('GET|POST', '/detailagenda/([a-z0-9_-]+)', function($seotitle) use ($core, $templates) {
	$lang = $core->setlang('agenda', WEB_LANG);
	$agenda = $core->podb->from('agenda')
		->select(array('agenda_description.title', 'agenda_description.content', 'agenda_description.locations'))
		->leftJoin('agenda_description ON agenda_description.id_agenda = agenda.id_agenda')
		->where('agenda.seotitle', $seotitle)
		->where('agenda_description.id_language', WEB_LANG_ID)
		->where('agenda.active', 'Y')
		->limit(1)
		->fetch();
	if ($agenda) {
        $query_hits = $core->podb->update('agenda')
			->set(array('hits' => $agenda['hits']+1))
			->where('id_agenda', $agenda['id_agenda']);
		$query_hits->execute();
		$info = array(
			'page_title' => $agenda['title'],
			'page_desc' => $core->postring->cuthighlight('post', $agenda['content'], '60'),
			'page_key' => $agenda['title'],
			'social_mod' => $lang['front_agenda_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'].'/detailagenda/'.$agenda['seotitle'],
			'social_title' => $agenda['title'],
			'social_desc' => $core->postring->cuthighlight('post', $agenda['content'], '60'),
			'social_img' => $core->posetting[1]['value'].'/'.DIR_CON.'/uploads/'.$agenda['picture']
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('detailagenda', compact('agenda','lang'));
	} else {
		$info = array(
			'page_title' => $lang['front_agenda_not_found'],
			'page_desc' => $core->posetting[2]['value'],
			'page_key' => $core->posetting[3]['value'],
			'social_mod' => $lang['front_agenda_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'],
			'social_title' => $lang['front_agenda_not_found'],
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
 * Router untuk menampilkan request halaman kategori.
 *
 * Router for display request in agenda page.
 *
 * $seotitle = string [a-z0-9_-]
*/
$router->match('GET|POST', '/agenda/([a-z0-9_-]+)', function($seotitle) use ($core, $templates) {
	$lang = $core->setlang('agenda', WEB_LANG);
	if ($seotitle == 'all') {
		$agenda = array(
			'title' => $lang['front_agenda'],
			'seotitle' => 'all',
			'picture' => ''
		);
	} else {
		$agenda = $core->podb->from('agenda')
			->select(array('agenda_description.title'))
			->leftJoin('agenda_description ON agenda_description.id_agenda = agenda.id_agenda')
			->where('agenda.seotitle', $seotitle)
			->where('agenda_description.id_language', WEB_LANG_ID)
			->where('agenda.active', 'Y')
			->limit(1)
			->fetch();
	}
	if ($agenda) {
		$info = array(
			'page_title' => htmlspecialchars_decode($agenda['title']),
			'page_desc' => $agenda['title'].' - '.$core->posetting[2]['value'],
			'page_key' => $agenda['title'],
			'social_mod' => $lang['front_agenda_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'].'/agenda/'.$agenda['seotitle'],
			'social_title' => htmlspecialchars_decode($agenda['title']),
			'social_desc' => $agenda['title'].' - '.$core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'].'/'.DIR_CON.'/uploads/'.$agenda['picture'],
			'page' => '1'
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('agenda', compact('agenda','lang'));
	} else {
		$info = array(
			'page_title' => $lang['front_agenda_not_found'],
			'page_desc' => $core->posetting[2]['value'],
			'page_key' => $core->posetting[3]['value'],
			'social_mod' => $lang['front_agenda_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'],
			'social_title' => $lang['front_agenda_not_found'],
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
 * Router untuk menampilkan request halaman agenda dengan nomor halaman.
 *
 * Router for display request in agenda page with pagination.
 *
 * $seotitle = string [a-z0-9_-]
 * $page = integer
*/
$router->match('GET|POST', '/agenda/([a-z0-9_-]+)/page/(\d+)', function($seotitle, $page) use ($core, $templates) {
	$lang = $core->setlang('agenda', WEB_LANG);
	if ($seotitle == 'all') {
		$agenda = array(
			'title' => $lang['front_agenda'],
			'seotitle' => 'all',
			'picture' => ''
		);
	} else {
		$agenda = $core->podb->from('agenda')
			->select(array('agenda_description.title'))
			->leftJoin('agenda_description ON agenda_description.id_agenda = agenda.id_agenda')
			->where('agenda.seotitle', $seotitle)
			->where('agenda_description.id_language', WEB_LANG_ID)
			->where('agenda.active', 'Y')
			->limit(1)
			->fetch();
	}
	if ($agenda) {
		$info = array(
			'page_title' => htmlspecialchars_decode($agenda['title']),
			'page_desc' => $agenda['title'].' - '.$core->posetting[2]['value'],
			'page_key' => $agenda['title'],
			'social_mod' => $lang['front_agenda_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'].'/agenda/'.$agenda['seotitle'],
			'social_title' => htmlspecialchars_decode($agenda['title']),
			'social_desc' => $agenda['title'].' - '.$core->posetting[2]['value'],
			'social_img' => $core->posetting[1]['value'].'/'.DIR_CON.'/uploads/'.$agenda['picture'],
			'page' => $page
		);
		$adddata = array_merge($info, $lang);
		$templates->addData(
			$adddata
		);
		echo $templates->render('agenda', compact('agenda','lang'));
	} else {
		$info = array(
			'page_title' => $lang['front_agenda_not_found'],
			'page_desc' => $core->posetting[2]['value'],
			'page_key' => $core->posetting[3]['value'],
			'social_mod' => $lang['front_agenda_title'],
			'social_name' => $core->posetting[0]['value'],
			'social_url' => $core->posetting[1]['value'],
			'social_title' => $lang['front_agenda_not_found'],
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
