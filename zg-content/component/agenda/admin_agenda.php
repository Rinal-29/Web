<?php
/*
 *
 * - Zagitanank Admin File
 *
 * - File : admin_agenda.php
 * - Version : 1.1
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses admin pada halaman.
 * This is a php file for handling admin process for agenda.
 *
*/

/**
 * Fungsi ini digunakan untuk mencegah file ini diakses langsung tanpa melalui router.
 *
 * This function use for prevent this file accessed directly without going through a router.
 *
*/
if (!defined('CONF_STRUCTURE')) {
	header('location:index.html');
	exit;
}

/**
 * Fungsi ini digunakan untuk mencegah file ini diakses langsung tanpa login akses terlebih dahulu.
 *
 * This function use for prevent this file accessed directly without access login first.
 *
*/
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser']) AND $_SESSION['login'] == 0) {
	header('location:index.php');
	exit;
}

class agenda extends PoCore
{

	/**
	 * Fungsi ini digunakan untuk menginisialisasi class utama.
	 *
	 * This function use to initialize the main class.
	 *
	*/
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index agenda.
	 *
	*/
	public function index()
	{
		if (!$this->auth($_SESSION['leveluser'], 'agenda', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=agenda&act=addnew" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=agenda&act=multidelete', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['agenda_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['agenda_date'], 'options' => 'class="no-sort" style="width:100px;"'),
								array('title' => $GLOBALS['_']['agenda_active'], 'options' => 'class="no-sort" style="width:30px;"'),
								array('title' => $GLOBALS['_']['agenda_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-agenda', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('agenda');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatable()
	{
		if (!$this->auth($_SESSION['leveluser'], 'agenda', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		$table = 'agenda';
		$primarykey = 'id_agenda';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $primarykey),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title',
				'formatter' => function($d, $row, $i){
					return "".$d."<br /><i><a href='".WEB_URL."agenda/".$row['seotitle']."' target='_blank'>".WEB_URL."agenda/".$row['seotitle']."</a></i>";
				}
			),
            array('db' => 'p.publishdate', 'dt' => '3', 'field' => 'publishdate'),
			array('db' => 'p.active', 'dt' => '4', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '5', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=agenda&act=edit&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			),
			array('db' => 'p.seotitle', 'dt' => '', 'field' => 'seotitle')
		);
		$joinquery = "FROM agenda AS p JOIN agenda_description AS pd ON (pd.id_agenda = p.id_agenda)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add agenda.
	 *
	*/
	public function addnew()
	{
		if (!$this->auth($_SESSION['leveluser'], 'agenda', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_POST['seotitle'] != "") {
				$seotitle = $_POST['seotitle'];
			} else {
				$seotitle = $this->postring->seo_title($this->postring->valid($_POST['agenda'][1]['title'], 'xss'));
			}
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$agenda = array(
				'seotitle' => $seotitle,
				'date_start' => $_POST['agendastartdate'],
                'date_end' => $_POST['agendaenddate'],
                'time' => $_POST['agendatime'],
                'picture' => $_POST['picture'],
				'publishdate' => $tanggalbuat,
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_agenda = $this->podb->insertInto('agenda')->values($agenda);
			$query_agenda->execute();
			$last_agenda = $this->podb->from('agenda')
				->orderBy('id_agenda DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['agenda'] as $id_language => $value) {
				$agenda_description = array(
					'id_agenda' => $last_agenda['id_agenda'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss'),
					'content' => stripslashes(htmlspecialchars($value['content'],ENT_QUOTES)),
                    'locations' => $this->postring->valid($value['locations'], 'xss')
				);
				$query_agenda_description = $this->podb->insertInto('agenda_description')->values($agenda_description);
				$query_agenda_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['agenda_message_1'], 'admin.php?mod=agenda');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['agenda_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=agenda&act=addnew', 'autocomplete' => 'off'));?>
						
                        <div class="row">
							<div class="col-md-12">
								<?php
									$notab = 1;
									$noctab = 1;
									$langs = $this->podb->from('language')->where('active', 'Y')->orderBy('id_language ASC')->fetchAll();
								?>
								<ul class="nav nav-tabs">
									<?php foreach($langs as $lang) { ?>
									<li <?php echo ($notab == '1' ? 'class="active"' : ''); ?>><a href="#tab-content-<?=$lang['id_language'];?>" data-toggle="tab"><img src="../<?=DIR_INC;?>/images/flag/<?=$lang['code'];?>.png" /> <?=$lang['title'];?></a></li>
									<?php $notab++;} ?>
								</ul>
								<div class="tab-content">
									<?php foreach($langs as $lang) { ?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_title_2'], 'name' => 'agenda['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
										<div class="form-group">
											<label><?=$GLOBALS['_']['agenda_content'];?> <span class="text-danger">*</span></label>
											<div class="row" style="margin-top:-30px;">
												<div class="col-md-12">
													<div class="pull-right">
														<div class="input-group">
															<span class="btn-group">
																<a class="btn btn-sm btn-default tiny-visual" data-lang="<?=$lang['id_language'];?>">Visual</a>
																<a class="btn btn-sm btn-success tiny-text" data-lang="<?=$lang['id_language'];?>">Text</a>
															</span>
														</div>
													</div>
												</div>
											</div>
											<textarea class="form-control" id="po-wysiwyg-<?=$lang['id_language'];?>" name="agenda[<?=$lang['id_language'];?>][content]" style="height:500px;"></textarea>
										</div>
                                        <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_locations'], 'name' => 'agenda['.$lang['id_language'].'][locations]', 'id' => 'locations-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
										
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_start'], 'name' => 'agendastartdate', 'id' => 'agendastartdate', 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            
							<div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_end'], 'name' => 'agendaenddate', 'id' => 'agendaenddate', 'mandatory' => false));?>
							</div>
                            
                            <div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_time'], 'name' => 'agendatime', 'id' => 'agendatime', 'mandatory' => false));?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_seotitle'], 'name' => 'seotitle', 'id' => 'seotitle', 'mandatory' => true, 'options' => 'required', 'help' => 'Permalink : '.WEB_URL.'agenda/<span id="permalink"></span>'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_picture'], 'name' => 'picture', 'id' => 'picture'), $inputgroup = true, $inputgroupopt = array('href' => '../'.DIR_INC.'/js/filemanager/dialog.php?type=0&field_id=picture', 'id' => 'browse-file', 'class' => 'btn-success', 'options' => '', 'title' => $GLOBALS['_']['action_7'].' '.$GLOBALS['_']['agenda_picture']));?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=$this->pohtml->formAction();?>
							</div>
						</div>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman edit halaman.
	 *
	 * This function is used to display and process edit agenda.
	 *
	*/
	public function edit()
	{
		if (!$this->auth($_SESSION['leveluser'], 'agenda', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_POST['seotitle'] != "") {
				$seotitle = $_POST['seotitle'];
			} else {
				$seotitle = $this->postring->seo_title($this->postring->valid($_POST['agenda'][1]['title'], 'xss'));
			}
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$agenda = array(
				'seotitle' => $seotitle,
				'date_start' => $_POST['agendastartdate'],
                'date_end' => $_POST['agendaenddate'],
                'time' => $_POST['agendatime'],
				'picture' => $_POST['picture'],
				'publishdate' => $tanggalbuat,
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_agenda = $this->podb->update('agenda')
				->set($agenda)
				->where('id_agenda', $this->postring->valid($_POST['id'], 'sql'));
			$query_agenda->execute();
			foreach ($_POST['agenda'] as $id_language => $value) {
				$othlang_agenda = $this->podb->from('agenda_description')
					->where('id_agenda', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_agenda > 0) {
					$agenda_description = array(
						'title' => $this->postring->valid($value['title'], 'xss'),
						'content' => stripslashes(htmlspecialchars($value['content'],ENT_QUOTES)),
                        'locations' => $this->postring->valid($value['locations'], 'xss')
					);
					$query_agenda_description = $this->podb->update('agenda_description')
						->set($agenda_description)
						->where('id_agenda_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$agenda_description = array(
						'id_agenda' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss'),
						'content' => stripslashes(htmlspecialchars($value['content'],ENT_QUOTES)),
                        'locations' => $this->postring->valid($value['locations'], 'xss')
					);
					$query_agenda_description = $this->podb->insertInto('agenda_description')->values($agenda_description);
				}
				$query_agenda_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['agenda_message_2'], 'admin.php?mod=agenda');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_agenda = $this->podb->from('agenda')
			->select('agenda_description.title')
			->leftJoin('agenda_description ON agenda_description.id_agenda = agenda.id_agenda')
			->where('agenda.id_agenda', $id)
			->limit(1)
			->fetch();
		if (empty($current_agenda)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['agenda_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=agenda&act=edit&id='.$current_agenda['id_agenda'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_agenda['id_agenda']));?>
						<div class="row">
							<div class="col-md-12">
								<?php
									$notab = 1;
									$noctab = 1;
									$langs = $this->podb->from('language')->where('active', 'Y')->orderBy('id_language ASC')->fetchAll();
								?>
								<ul class="nav nav-tabs">
									<?php foreach($langs as $lang) { ?>
									<li <?php echo ($notab == '1' ? 'class="active"' : ''); ?>><a href="#tab-content-<?=$lang['id_language'];?>" data-toggle="tab"><img src="../<?=DIR_INC;?>/images/flag/<?=$lang['code'];?>.png" /> <?=$lang['title'];?></a></li>
									<?php $notab++;} ?>
								</ul>
								<div class="tab-content">
									<?php foreach($langs as $lang) { ?>
									
                                    <?php
										$paglang = $this->podb->from('agenda_description')
											->where('agenda_description.id_agenda', $current_agenda['id_agenda'])
											->where('agenda_description.id_language', $lang['id_language'])
											->fetch();
											$content_before = html_entity_decode($paglang['content']);
											$content_after = preg_replace_callback(
												'/(?:\<code*\>([^\<]*)\<\/code\>)/',
												create_function(
												   '$matches',
													'return \'<code>\'.stripslashes(htmlspecialchars($matches[1],ENT_QUOTES)).\'</code>\';'
												),
												$content_before
											);
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'agenda['.$lang['id_language'].'][id]', 'value' => $paglang['id_agenda_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_title_2'], 'name' => 'agenda['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
										<div class="form-group">
											<label><?=$GLOBALS['_']['agenda_content'];?> <span class="text-danger">*</span></label>
											<div class="row" style="margin-top:-30px;">
												<div class="col-md-12">
													<div class="pull-right">
														<div class="input-group">
															<span class="btn-group">
																<a class="btn btn-sm btn-default tiny-visual" data-lang="<?=$lang['id_language'];?>">Visual</a>
																<a class="btn btn-sm btn-success tiny-text" data-lang="<?=$lang['id_language'];?>">Text</a>
															</span>
														</div>
													</div>
												</div>
											</div>
											<textarea class="form-control" id="po-wysiwyg-<?=$lang['id_language'];?>" name="agenda[<?=$lang['id_language'];?>][content]" style="height:500px;"><?=$content_after;?></textarea>
										</div>
                                        <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_locations'], 'name' => 'agenda['.$lang['id_language'].'][locations]', 'id' => 'locations-'.$lang['id_language'], 'value' => $paglang['locations'], 'mandatory' => true, 'options' => 'required'));?>
										
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_seotitle'], 'name' => 'seotitle', 'id' => 'seotitle', 'value' => $current_agenda['seotitle'], 'mandatory' => true, 'options' => 'required', 'help' => 'Permalink : '.WEB_URL.'agenda/<span id="permalink">'.$current_agenda['seotitle'].'</span>'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group" id="image-box">
									<div class="row">
										<?php if ($current_agenda['picture'] == '') { ?>
											<div class="col-md-3"><label><?=$GLOBALS['_']['agenda_picture_2'];?></label></div>
											<div class="col-md-9">
												<a href="data:image/gif;base64,R0lGODdhyACWAOMAAO/v76qqqubm5t3d3bu7u7KystXV1cPDw8zMzAAAAAAAAAAAAAAAAAAAAAAAAAAAACwAAAAAyACWAAAE/hDISau9OOvNu/9gKI5kaZ5oqq5s675wLM90bd94ru987//AoHBILBqPyKRyyWw6n9CodEqtWq/YrHbL7Xq/4LB4TC6bz+i0es1uu9/wuHxOr9vv+Lx+z+/7/4CBgoOEhYaHiImKi4yNjo+QkZKTlJWWl5iZmpucnZ6foKGio6SlpqeoqaqrrK2ur7CxsrO0tba3TAMFBQO4LAUBAQW+K8DCxCoGu73IzSUCwQECAwQBBAIVCMAFCBrRxwDQwQLKvOHV1xbUwQfYEwIHwO3BBBTawu2BA9HGwcMT1b7Vw/Dt3z563xAIrHCQnzsAAf0F6ybhwDdwgAx8OxDQgASN/sKUBWNmwQDIfwBAThRoMYDHCRYJGAhI8eRMf+4OFrgZgCKgaB4PHqg4EoBQbxgBROtlrJu4ofYm0JMQkJk/mOMkTA10Vas1CcakJrXQ1eu/sF4HWhB3NphYlNsmxOWKsWtZtASTdsVb1mhEu3UDX3RLFyVguITzolQKji/GhgXNvhU7OICgsoflJr7Qd2/isgEPGGAruTTjnSZTXw7c1rJpznobf2Y9GYBjxIsJYQbXstfRDJ1luz6t2TDvosSJSpMw4GXG3TtT+hPpEoPJ6R89B7AaUrnolgWwnUQQEKVOAy199mlonPDfr3m/GeUHFjBhAf0SUh28+P12QOIIgDbcPdwgJV+Arf0jnwTwsHOQT/Hs1BcABObjDAcTXhiCOGppKAJI6nnIwQGiKZSViB2YqB+KHtxjjXMsxijjjDTWaOONOOao44489ujjj0AGKeSQRBZp5JFIJqnkkkw26eSTUEYp5ZRUVmnllVhmqeWWXHbp5ZdghinmmGSW6UsEADs=" target="_blank"><?=$GLOBALS['_']['agenda_picture_3'];?></a>
												<p><i><?=$GLOBALS['_']['agenda_picture_4'];?></i></p>
											</div>
										<?php } else { ?>
											<div class="col-md-2"><label><?=$GLOBALS['_']['agenda_picture_5'];?></label></div>
											<div class="col-md-10">
												<a href="../zg-content/uploads/<?=$current_agenda['picture'];?>" target="_blank"><?=$GLOBALS['_']['agenda_picture_6'];?></a>
												<p>
													<i><?=$GLOBALS['_']['agenda_picture_4'];?></i>
													<button type="button" class="btn btn-xs btn-danger pull-right del-image" id="<?=$current_agenda['id_agenda'];?>"><i class="fa fa-trash-o"></i></button>
												</p>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
                        <div class="row">
							<div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_start'], 'name' => 'agendastartdate', 'id' => 'agendastartdate', 'value' => $current_agenda['date_start'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            
							<div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_end'], 'name' => 'agendaenddate', 'id' => 'agendaenddate', 'value' => $current_agenda['date_end'], 'mandatory' => false));?>
							</div>
                            
                            <div class="col-md-4">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_time'], 'name' => 'agendatime', 'id' => 'agendatime', 'value' => $current_agenda['time'], 'mandatory' => false));?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['agenda_picture'], 'name' => 'picture', 'id' => 'picture', 'value' => $current_agenda['picture']), $inputgroup = true, $inputgroupopt = array('href' => '../'.DIR_INC.'/js/filemanager/dialog.php?type=0&field_id=picture', 'id' => 'browse-file', 'class' => 'btn-success', 'options' => '', 'title' => $GLOBALS['_']['action_7'].' '.$GLOBALS['_']['agenda_picture']));?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php
									if ($current_agenda['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['agenda_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['agenda_active'], 'mandatory' => true), $radioitem, $inline = true);
									}
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?=$this->pohtml->formAction();?>
							</div>
						</div>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<div id="alertdelimg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form method="post" action="route.php?mod=agenda&act=edit&id='.<?=$current_agenda['id_agenda'];?>" autocomplete="off">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h3 id="modal-title"><i class="fa fa-exclamation-triangle text-danger"></i> <?=$GLOBALS['_']['dialogdel_1'];?></h3>
						</div>
						<div class="modal-body">
							<?=$GLOBALS['_']['dialogdel_2'];?>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-danger btn-del-image" id=""><i class="fa fa-trash-o"></i> <?=$GLOBALS['_']['dialogdel_3'];?></button>
							<button type="button" class="btn btn-sm btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-sign-out"></i> <?=$GLOBALS['_']['dialogdel_4'];?></button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete agenda.
	 *
	*/
	public function delete()
	{
		if (!$this->auth($_SESSION['leveluser'], 'agenda', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('agenda_description')->where('id_agenda', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('agenda')->where('id_agenda', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['agenda_message_3'], 'admin.php?mod=agenda');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete agenda.
	 *
	*/
	public function multidelete()
	{
		if (!$this->auth($_SESSION['leveluser'], 'agenda', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('agenda_description')->where('id_agenda', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('agenda')->where('id_agenda', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['agenda_message_3'], 'admin.php?mod=agenda');
			} else {
				$this->poflash->error($GLOBALS['_']['agenda_message_6'], 'admin.php?mod=agenda');
			}
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus gambar terpilih.
	 *
	 * This function is used to display and process delete selected image.
	 *
	*/
	public function delimage()
	{
		if (!$this->auth($_SESSION['leveluser'], 'agenda', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$agenda = array(
				'picture' => ''
			);
			$query_agenda = $this->podb->update('agenda')
				->set($agenda)
				->where('id_agenda', $this->postring->valid($_POST['id'], 'sql'));
			$query_agenda->execute();
		}
	}

}
