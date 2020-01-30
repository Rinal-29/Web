<?php
/*
 *
 * - Zagitanank Admin File
 *
 * - File : admin_statistik.php
 * - Version : 1.1
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses admin pada halaman.
 * This is a php file for handling admin process for statistik.
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

class statistik extends PoCore
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
	 * This function use for index statistik.
	 *
	*/
	public function index()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnew" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multidelete', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_jumlah'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-statistik', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik');?>
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
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'statistik';
		$primarykey = 'id_statistik';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.jumlah', 'dt' => '3', 'field' => 'jumlah'),
			array('db' => 'p.active', 'dt' => '4', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '5', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=edit&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM statistik AS p JOIN statistik_description AS pd ON (pd.id_statistik = p.id_statistik)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnew()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'jumlah' => $_POST['jumlah'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('statistik')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('statistik')
				->orderBy('id_statistik DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['statistik'] as $id_language => $value) {
				$statistik_description = array(
					'id_statistik' => $last_statistik['id_statistik'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('statistik_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_message_1'], 'admin.php?mod=statistik');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnew', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'statistik['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_jumlah'], 'name' => 'jumlah', 'mandatory' => true, 'options' => 'required'));?>
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function edit()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'jumlah' => $_POST['jumlah'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('statistik')
				->set($statistik)
				->where('id_statistik', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['statistik'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('statistik_description')
					->where('id_statistik', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('statistik_description')
						->set($statistik_description)
						->where('id_statistik_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_statistik' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('statistik_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_message_2'], 'admin.php?mod=statistik');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('statistik')
			->select('statistik_description.title')
			->leftJoin('statistik_description ON statistik_description.id_statistik = statistik.id_statistik')
			->where('statistik.id_statistik', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=edit&id='.$current_statistik['id_statistik'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_statistik']));?>
						
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
										$paglang = $this->podb->from('statistik_description')
											->where('statistik_description.id_statistik', $current_statistik['id_statistik'])
											->where('statistik_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'statistik['.$lang['id_language'].'][id]', 'value' => $paglang['id_statistik_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'statistik['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-2">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_jumlah'], 'name' => 'jumlah', 'value' => $current_statistik['jumlah'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
					<form method="post" action="route.php?mod=statistik&act=edit&id='.<?=$current_statistik['id_statistik'];?>" autocomplete="off">
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
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function delete()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('statistik_description')->where('id_statistik', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('statistik')->where('id_statistik', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_message_3'], 'admin.php?mod=statistik');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multidelete()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('statistik_description')->where('id_statistik', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('statistik')->where('id_statistik', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_message_3'], 'admin.php?mod=statistik');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_message_6'], 'admin.php?mod=statistik');
			}
		}
	}
    
    
    
    
    
    
    
    
    
    
    /**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index statistik.
	 *
	*/
	public function dusun()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name_dusun'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnewdusun" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multideletedusun', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_male'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_female'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-dusun', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik', 'deletedusun');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatabledusun()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'dusun';
		$primarykey = 'id_dusun';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.male', 'dt' => '3', 'field' => 'male'),
			array('db' => 'p.female', 'dt' => '4', 'field' => 'female'),
			array('db' => 'p.active', 'dt' => '5', 'field' => 'active'),
				array('db' => 'p.'.$primarykey, 'dt' => '6', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=editdusun&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM dusun AS p JOIN dusun_description AS pd ON (pd.id_dusun = p.id_dusun)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnewdusun()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
			$statistik = array(
				'male' => $_POST['male'],
				'female' => $_POST['female'],
				'color' => $_POST['color'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('dusun')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('dusun')
				->orderBy('id_dusun DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['dusun'] as $id_language => $value) {
				$statistik_description = array(
					'id_dusun' => $last_statistik['id_dusun'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('dusun_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_dusun_message_1'], 'admin.php?mod=statistik&act=dusun');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_dusun_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnewdusun', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'dusun['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_male'], 'name' => 'male', 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-4">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_female'], 'name' => 'female', 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="color"><?=$GLOBALS['_']['statistik_color'];?></label>
                                    <div  id="colordusun" class="input-group colorpicker-component">
                                        <input class="form-control" name="color" value="#000000" placeholder="" type="text">
                                        <span class="input-group-addon"><i></i></span> 
                                    </div>
                                </div>   
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function editdusun()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'male' => $_POST['male'],
				'female' => $_POST['female'],
				'color' => $_POST['color'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('dusun')
				->set($statistik)
				->where('id_dusun', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['dusun'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('dusun_description')
					->where('id_dusun', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('dusun_description')
						->set($statistik_description)
						->where('id_dusun_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_dusun' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('dusun_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_dusun_message_2'], 'admin.php?mod=statistik&act=dusun');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('dusun')
			->select('dusun_description.title')
			->leftJoin('dusun_description ON dusun_description.id_dusun = dusun.id_dusun')
			->where('dusun.id_dusun', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_dusun_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=editdusun&id='.$current_statistik['id_dusun'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_dusun']));?>
						
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
										$paglang = $this->podb->from('dusun_description')
											->where('dusun_description.id_dusun', $current_statistik['id_dusun'])
											->where('dusun_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'dusun['.$lang['id_language'].'][id]', 'value' => $paglang['id_dusun_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'dusun['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-4">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_male'], 'name' => 'male', 'value' => $current_statistik['male'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-4">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_female'], 'name' => 'female', 'value' => $current_statistik['female'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="color"><?=$GLOBALS['_']['statistik_color'];?></label>
                                    <div  id="colordusun" class="input-group colorpicker-component">
                                        <input class="form-control" name="color" value="<?=$current_statistik['color'];?>" placeholder="" type="text">
                                        <span class="input-group-addon"><i></i></span> 
                                    </div>
                                </div>   
                            </div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function deletedusun()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('dusun_description')->where('id_dusun', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('dusun')->where('id_dusun', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_dusun_message_3'], 'admin.php?mod=statistik&act=dusun');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multideletedusun()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('dusun_description')->where('id_dusun', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('dusun')->where('id_dusun', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_dusun_message_3'], 'admin.php?mod=statistik&act=dusun');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_dusun_message_6'], 'admin.php?mod=statistik&act=dusun');
			}
		}
	}
    
    
    
    
    
    
    
    
    
    /**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index statistik.
	 *
	*/
	public function rw()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name_rw'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnewrw" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multideleterw', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_jumlah'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-rw', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik', 'deleterw');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatablerw()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'rw';
		$primarykey = 'id_rw';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.jumlah', 'dt' => '3', 'field' => 'jumlah'),
			array('db' => 'p.active', 'dt' => '4', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '5', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=editrw&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM rw AS p JOIN rw_description AS pd ON (pd.id_rw = p.id_rw)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnewrw()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
			$statistik = array(
				'jumlah' => $_POST['jumlah'],
                'color' => $_POST['color'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('rw')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('rw')
				->orderBy('id_rw DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['rw'] as $id_language => $value) {
				$statistik_description = array(
					'id_rw' => $last_statistik['id_rw'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('rw_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_rw_message_1'], 'admin.php?mod=statistik&act=rw');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_rw_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnewrw', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'rw['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_jumlah'], 'name' => 'jumlah', 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color"><?=$GLOBALS['_']['statistik_color'];?></label>
                                    <div  id="colordusun" class="input-group colorpicker-component">
                                        <input class="form-control" name="color" value="#000000" placeholder="" type="text">
                                        <span class="input-group-addon"><i></i></span> 
                                    </div>
                                </div>   
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function editrw()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'jumlah' => $_POST['jumlah'],
                'color' => $_POST['color'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('rw')
				->set($statistik)
				->where('id_rw', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['rw'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('rw_description')
					->where('id_rw', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('rw_description')
						->set($statistik_description)
						->where('id_rw_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_rw' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('rw_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_rw_message_2'], 'admin.php?mod=statistik&act=rw');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('rw')
			->select('rw_description.title')
			->leftJoin('rw_description ON rw_description.id_rw = rw.id_rw')
			->where('rw.id_rw', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_rw_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=editrw&id='.$current_statistik['id_rw'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_rw']));?>
						
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
										$paglang = $this->podb->from('rw_description')
											->where('rw_description.id_rw', $current_statistik['id_rw'])
											->where('rw_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'rw['.$lang['id_language'].'][id]', 'value' => $paglang['id_rw_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'rw['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_jumlah'], 'name' => 'jumlah', 'value' => $current_statistik['jumlah'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color"><?=$GLOBALS['_']['statistik_color'];?></label>
                                    <div  id="colordusun" class="input-group colorpicker-component">
                                        <input class="form-control" name="color" value="<?=$current_statistik['color'];?>" placeholder="" type="text">
                                        <span class="input-group-addon"><i></i></span> 
                                    </div>
                                </div>   
                            </div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function deleterw()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('rw_description')->where('id_rw', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('rw')->where('id_rw', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_rw_message_3'], 'admin.php?mod=statistik&act=rw');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multideleterw()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('rw_description')->where('id_rw', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('rw')->where('id_rw', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_rw_message_3'], 'admin.php?mod=statistik&act=rw');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_rw_message_6'], 'admin.php?mod=statistik&act=rw');
			}
		}
	}
    
    
    
    
    
    
        /**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index statistik.
	 *
	*/
	public function pekerjaan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name_pekerjaan'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnewpekerjaan" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multideletepekerjaan', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_male'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_female'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-pekerjaan', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik', 'deletepekerjaan');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatablepekerjaan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'pekerjaan';
		$primarykey = 'id_pekerjaan';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.male', 'dt' => '3', 'field' => 'male'),
			array('db' => 'p.female', 'dt' => '4', 'field' => 'female'),
			array('db' => 'p.active', 'dt' => '5', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '6', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=editpekerjaan&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM pekerjaan AS p JOIN pekerjaan_description AS pd ON (pd.id_pekerjaan = p.id_pekerjaan)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnewpekerjaan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
			$statistik = array(
				'male' => $_POST['male'],
				'female' => $_POST['female'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('pekerjaan')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('pekerjaan')
				->orderBy('id_pekerjaan DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['pekerjaan'] as $id_language => $value) {
				$statistik_description = array(
					'id_pekerjaan' => $last_statistik['id_pekerjaan'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('pekerjaan_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_pekerjaan_message_1'], 'admin.php?mod=statistik&act=pekerjaan');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_pekerjaan_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnewpekerjaan', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'pekerjaan['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_male'], 'name' => 'male', 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_female'], 'name' => 'female', 'mandatory' => true, 'options' => 'required'));?>
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function editpekerjaan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'male' => $_POST['male'],
				'female' => $_POST['female'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('pekerjaan')
				->set($statistik)
				->where('id_pekerjaan', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['pekerjaan'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('pekerjaan_description')
					->where('id_pekerjaan', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('pekerjaan_description')
						->set($statistik_description)
						->where('id_pekerjaan_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_pekerjaan' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('pekerjaan_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_pekerjaan_message_2'], 'admin.php?mod=statistik&act=pekerjaan');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('pekerjaan')
			->select('pekerjaan_description.title')
			->leftJoin('pekerjaan_description ON pekerjaan_description.id_pekerjaan = pekerjaan.id_pekerjaan')
			->where('pekerjaan.id_pekerjaan', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_pekerjaan_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=editpekerjaan&id='.$current_statistik['id_pekerjaan'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_pekerjaan']));?>
						
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
										$paglang = $this->podb->from('pekerjaan_description')
											->where('pekerjaan_description.id_pekerjaan', $current_statistik['id_pekerjaan'])
											->where('pekerjaan_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'pekerjaan['.$lang['id_language'].'][id]', 'value' => $paglang['id_pekerjaan_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'pekerjaan['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_male'], 'name' => 'male', 'value' => $current_statistik['male'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_female'], 'name' => 'female', 'value' => $current_statistik['female'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function deletepekerjaan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('pekerjaan_description')->where('id_pekerjaan', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('pekerjaan')->where('id_pekerjaan', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_pekerjaan_message_3'], 'admin.php?mod=statistik&act=pekerjaan');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multideletepekerjaan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('pekerjaan_description')->where('id_pekerjaan', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('pekerjaan')->where('id_pekerjaan', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_pekerjaan_message_3'], 'admin.php?mod=statistik&act=pekerjaan');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_pekerjaan_message_6'], 'admin.php?mod=statistik&act=pekerjaan');
			}
		}
	}
    
    
    
    
    
    
    
    
    
        /**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index statistik.
	 *
	*/
	public function pendidikan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name_pendidikan'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnewpendidikan" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multideletependidikan', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_male'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_female'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-pendidikan', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik', 'deletependidikan');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatablependidikan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'pendidikan';
		$primarykey = 'id_pendidikan';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.male', 'dt' => '3', 'field' => 'male'),
			array('db' => 'p.female', 'dt' => '4', 'field' => 'female'),
			array('db' => 'p.active', 'dt' => '5', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '6', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=editpendidikan&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM pendidikan AS p JOIN pendidikan_description AS pd ON (pd.id_pendidikan = p.id_pendidikan)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnewpendidikan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
			$statistik = array(
				'male' => $_POST['male'],
				'female' => $_POST['female'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('pendidikan')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('pendidikan')
				->orderBy('id_pendidikan DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['pendidikan'] as $id_language => $value) {
				$statistik_description = array(
					'id_pendidikan' => $last_statistik['id_pendidikan'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('pendidikan_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_pendidikan_message_1'], 'admin.php?mod=statistik&act=pendidikan');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_pendidikan_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnewpendidikan', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'pendidikan['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_male'], 'name' => 'male', 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_female'], 'name' => 'female', 'mandatory' => true, 'options' => 'required'));?>
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function editpendidikan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'male' => $_POST['male'],
				'female' => $_POST['female'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('pendidikan')
				->set($statistik)
				->where('id_pendidikan', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['pendidikan'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('pendidikan_description')
					->where('id_pendidikan', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('pendidikan_description')
						->set($statistik_description)
						->where('id_pendidikan_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_pendidikan' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('pendidikan_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_pendidikan_message_2'], 'admin.php?mod=statistik&act=pendidikan');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('pendidikan')
			->select('pendidikan_description.title')
			->leftJoin('pendidikan_description ON pendidikan_description.id_pendidikan = pendidikan.id_pendidikan')
			->where('pendidikan.id_pendidikan', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_pendidikan_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=editpendidikan&id='.$current_statistik['id_pendidikan'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_pendidikan']));?>
						
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
										$paglang = $this->podb->from('pendidikan_description')
											->where('pendidikan_description.id_pendidikan', $current_statistik['id_pendidikan'])
											->where('pendidikan_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'pendidikan['.$lang['id_language'].'][id]', 'value' => $paglang['id_pendidikan_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'pendidikan['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_male'], 'name' => 'male', 'value' => $current_statistik['male'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_female'], 'name' => 'female', 'value' => $current_statistik['female'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function deletependidikan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('pendidikan_description')->where('id_pendidikan', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('pendidikan')->where('id_pendidikan', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_pendidikan_message_3'], 'admin.php?mod=statistik&act=pendidikan');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multideletependidikan()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('pendidikan_description')->where('id_pendidikan', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('pendidikan')->where('id_pendidikan', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_pendidikan_message_3'], 'admin.php?mod=statistik&act=pendidikan');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_pendidikan_message_6'], 'admin.php?mod=statistik&act=pendidikan');
			}
		}
	}
    
    
    
    
    
    
    /**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index statistik.
	 *
	*/
	public function agama()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name_agama'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnewagama" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multideleteagama', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_jumlah'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-agama', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik', 'deleteagama');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatableagama()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'agama_penduduk';
		$primarykey = 'id_agama';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.jumlah', 'dt' => '3', 'field' => 'jumlah'),
			array('db' => 'p.active', 'dt' => '4', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '5', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=editagama&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM agama_penduduk AS p JOIN agama_penduduk_description AS pd ON (pd.id_agama = p.id_agama)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnewagama()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
			$statistik = array(
				'jumlah' => $_POST['jumlah'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('agama_penduduk')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('agama_penduduk')
				->orderBy('id_agama DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['agama'] as $id_language => $value) {
				$statistik_description = array(
					'id_agama' => $last_statistik['id_agama'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('agama_penduduk_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_agama_message_1'], 'admin.php?mod=statistik&act=agama');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_agama_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnewagama', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'agama['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_jumlah'], 'name' => 'jumlah', 'mandatory' => true, 'options' => 'required'));?>
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function editagama()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'jumlah' => $_POST['jumlah'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('agama_penduduk')
				->set($statistik)
				->where('id_agama', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['agama'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('agama_penduduk_description')
					->where('id_agama', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('agama_penduduk_description')
						->set($statistik_description)
						->where('id_agama_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_agama' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('agama_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_agama_message_2'], 'admin.php?mod=statistik&act=agama');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('agama_penduduk')
			->select('agama_penduduk_description.title')
			->leftJoin('agama_penduduk_description ON agama_penduduk_description.id_agama = agama_penduduk.id_agama')
			->where('agama_penduduk.id_agama', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_agama_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=editagama&id='.$current_statistik['id_agama'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_agama']));?>
						
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
										$paglang = $this->podb->from('agama_penduduk_description')
											->where('agama_penduduk_description.id_agama', $current_statistik['id_agama'])
											->where('agama_penduduk_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'agama['.$lang['id_language'].'][id]', 'value' => $paglang['id_agama_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'agama['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_jumlah'], 'name' => 'jumlah', 'value' => $current_statistik['jumlah'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function deleteagama()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('agama_penduduk_description')->where('id_agama', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('agama_penduduk')->where('id_agama', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_agama_message_3'], 'admin.php?mod=statistik&act=agama');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multideleteagama()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('agama_penduduk_description')->where('id_agama', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('agama_penduduk')->where('id_agama', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_agama_message_3'], 'admin.php?mod=statistik&act=agama');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_agama_message_6'], 'admin.php?mod=statistik&act=agama');
			}
		}
	}
    
    
    
    
    
    /**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index statistik.
	 *
	*/
	public function kawin()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name_kawin'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnewkawin" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multideletekawin', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_jumlah'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-kawin', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik', 'deletekawin');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatablekawin()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'kawin';
		$primarykey = 'id_kawin';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.jumlah', 'dt' => '3', 'field' => 'jumlah'),
			array('db' => 'p.active', 'dt' => '4', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '5', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=editkawin&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM kawin AS p JOIN kawin_description AS pd ON (pd.id_kawin = p.id_kawin)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnewkawin()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
			$statistik = array(
				'jumlah' => $_POST['jumlah'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('kawin')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('kawin')
				->orderBy('id_kawin DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['kawin'] as $id_language => $value) {
				$statistik_description = array(
					'id_kawin' => $last_statistik['id_kawin'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('kawin_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_kawin_message_1'], 'admin.php?mod=statistik&act=kawin');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_kawin_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnewkawin', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'kawin['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_jumlah'], 'name' => 'jumlah', 'mandatory' => true, 'options' => 'required'));?>
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function editkawin()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'jumlah' => $_POST['jumlah'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('kawin')
				->set($statistik)
				->where('id_kawin', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['kawin'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('kawin_description')
					->where('id_kawin', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('kawin_description')
						->set($statistik_description)
						->where('id_kawin_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_kawin' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('kawin_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_kawin_message_2'], 'admin.php?mod=statistik&act=kawin');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('kawin')
			->select('kawin_description.title')
			->leftJoin('kawin_description ON kawin_description.id_kawin = kawin.id_kawin')
			->where('kawin.id_kawin', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_kawin_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=editkawin&id='.$current_statistik['id_kawin'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_kawin']));?>
						
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
										$paglang = $this->podb->from('kawin_description')
											->where('kawin_description.id_kawin', $current_statistik['id_kawin'])
											->where('kawin_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'kawin['.$lang['id_language'].'][id]', 'value' => $paglang['id_kawin_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'kawin['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_jumlah'], 'name' => 'jumlah', 'value' => $current_statistik['jumlah'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function deletekawin()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('kawin_description')->where('id_kawin', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('kawin')->where('id_kawin', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_kawin_message_3'], 'admin.php?mod=statistik&act=kawin');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multideletekawin()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('kawin_description')->where('id_kawin', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('kawin')->where('id_kawin', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_kawin_message_3'], 'admin.php?mod=statistik&act=kawin');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_kawin_message_6'], 'admin.php?mod=statistik&act=kawin');
			}
		}
	}
    
    
    
    
        /**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index statistik.
	 *
	*/
	public function umur()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name_umur'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnewumur" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multideleteumur', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_male'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_female'], 'options' => 'style="width:100px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-umur', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik', 'deleteumur');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatableumur()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'umur';
		$primarykey = 'id_umur';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.male', 'dt' => '3', 'field' => 'male'),
			array('db' => 'p.female', 'dt' => '4', 'field' => 'female'),
			array('db' => 'p.active', 'dt' => '5', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '6', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=editumur&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM umur AS p JOIN umur_description AS pd ON (pd.id_umur = p.id_umur)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnewumur()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
			$statistik = array(
				'male' => $_POST['male'],
				'female' => $_POST['female'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('umur')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('umur')
				->orderBy('id_umur DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['umur'] as $id_language => $value) {
				$statistik_description = array(
					'id_umur' => $last_statistik['id_umur'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('umur_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_umur_message_1'], 'admin.php?mod=statistik&act=umur');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_umur_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnewumur', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'umur['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_male'], 'name' => 'male', 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_female'], 'name' => 'female', 'mandatory' => true, 'options' => 'required'));?>
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function editumur()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'male' => $_POST['male'],
				'female' => $_POST['female'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('umur')
				->set($statistik)
				->where('id_umur', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['umur'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('umur_description')
					->where('id_umur', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('umur_description')
						->set($statistik_description)
						->where('id_umur_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_umur' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('umur_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_umur_message_2'], 'admin.php?mod=statistik&act=umur');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('umur')
			->select('umur_description.title')
			->leftJoin('umur_description ON umur_description.id_umur = umur.id_umur')
			->where('umur.id_umur', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_umur_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=editumur&id='.$current_statistik['id_umur'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_umur']));?>
						
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
										$paglang = $this->podb->from('umur_description')
											->where('umur_description.id_umur', $current_statistik['id_umur'])
											->where('umur_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'umur['.$lang['id_language'].'][id]', 'value' => $paglang['id_umur_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'umur['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_male'], 'name' => 'male', 'value' => $current_statistik['male'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_female'], 'name' => 'female', 'value' => $current_statistik['female'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function deleteumur()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('umur_description')->where('id_umur', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('umur')->where('id_umur', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_umur_message_3'], 'admin.php?mod=statistik&act=umur');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multideleteumur()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('umur_description')->where('id_umur', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('umur')->where('id_umur', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_umur_message_3'], 'admin.php?mod=statistik&act=umur');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_umur_message_6'], 'admin.php?mod=statistik&act=umur');
			}
		}
	}
    
    

        /**
	 * Fungsi ini digunakan untuk menampilkan halaman index halaman.
	 *
	 * This function use for index statistik.
	 *
	*/
	public function sosial()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['component_name_sosial'],
                    '<div class="btn-title pull-right">
					   <a href="admin.php?mod=statistik&act=addnewsosial" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
					</div>'
                    );?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=multideletesosial', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => $GLOBALS['_']['statistik_title'], 'options' => ''),
								array('title' => $GLOBALS['_']['statistik_atas'], 'options' => 'style="width:150px;"'),
								array('title' => $GLOBALS['_']['statistik_bawah'], 'options' => 'style="width:150px;"'),
								array('title' => $GLOBALS['_']['statistik_active'], 'options' => 'style="width:50px;"'),
								array('title' => $GLOBALS['_']['statistik_action'], 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-sosial', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('statistik', 'deletesosial');?>
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan data json pada tabel.
	 *
	 * This function use for display json data in table.
	 *
	*/
	public function datatablesosial()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
        $no = 1;
		$table = 'sosial';
		$primarykey = 'id_sosial';
		$columns = array(
			array('db' => 'p.'.$primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => 'p.'.$primarykey, 'dt' => '1', 'field' => $no),
			array('db' => 'pd.title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'p.atas', 'dt' => '3', 'field' => 'atas'),
			array('db' => 'p.bawah', 'dt' => '4', 'field' => 'bawah'),
			array('db' => 'p.active', 'dt' => '5', 'field' => 'active'),
			array('db' => 'p.'.$primarykey, 'dt' => '6', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=statistik&act=editsosial&id=".$d."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
        $no++;
		$joinquery = "FROM sosial AS p JOIN sosial_description AS pd ON (pd.id_sosial = p.id_sosial)";
		$extrawhere = "pd.id_language = '1'";
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns, $joinquery, $extrawhere));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman add halaman.
	 *
	 * This function is used to display and process add statistik.
	 *
	*/
	public function addnewsosial()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = "Y";
			} else {
				$active = "N";
			}
			$statistik = array(
				'atas' => $_POST['atas'],
				'bawah' => $_POST['bawah'],
                'editor' => $_SESSION['iduser'],
                'active' => $active
			);
			$query_statistik = $this->podb->insertInto('sosial')->values($statistik);
			$query_statistik->execute();
			$last_statistik = $this->podb->from('sosial')
				->orderBy('id_sosial DESC')
				->limit(1)
				->fetch();
			foreach ($_POST['sosial'] as $id_language => $value) {
				$statistik_description = array(
					'id_sosial' => $last_statistik['id_sosial'],
					'id_language' => $id_language,
					'title' => $this->postring->valid($value['title'], 'xss')
				);
				$query_statistik_description = $this->podb->insertInto('sosial_description')->values($statistik_description);
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_sosial_message_1'], 'admin.php?mod=statistik&act=sosial');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_sosial_addnew']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=addnewsosial', 'autocomplete' => 'off'));?>
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
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'sosial['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_atas'], 'name' => 'atas', 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_bawah'], 'name' => 'bawah', 'mandatory' => true, 'options' => 'required'));?>
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
	 * This function is used to display and process edit statistik.
	 *
	*/
	public function editsosial()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			if ($_SESSION['leveluser'] == '1' OR $_SESSION['leveluser'] == '2') {
				$active = $this->postring->valid($_POST['active'], 'xss');
			} else {
				$active = "N";
			}
            $tanggalbuat = date("Y-m-d H:i:s");
			$statistik = array(
				'atas' => $_POST['atas'],
				'bawah' => $_POST['bawah'],
                'editor' => $_SESSION['iduser'],
				'active' => $active
			);
			$query_statistik = $this->podb->update('sosial')
				->set($statistik)
				->where('id_sosial', $this->postring->valid($_POST['id'], 'sql'));
			$query_statistik->execute();
			foreach ($_POST['sosial'] as $id_language => $value) {
				$othlang_statistik = $this->podb->from('sosial_description')
					->where('id_sosial', $this->postring->valid($_POST['id'], 'sql'))
					->where('id_language', $id_language)
					->count();
				if ($othlang_statistik > 0) {
					$statistik_description = array(
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->update('sosial_description')
						->set($statistik_description)
						->where('id_sosial_description', $this->postring->valid($value['id'], 'sql'));
				} else {
					$statistik_description = array(
						'id_sosial' => $this->postring->valid($_POST['id'], 'sql'),
						'id_language' => $id_language,
						'title' => $this->postring->valid($value['title'], 'xss')
					);
					$query_statistik_description = $this->podb->insertInto('sosial_description')->values($statistik_description);
				}
				$query_statistik_description->execute();
			}
			$this->poflash->success($GLOBALS['_']['statistik_sosial_message_2'], 'admin.php?mod=statistik&act=sosial');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_statistik = $this->podb->from('sosial')
			->select('sosial_description.title')
			->leftJoin('sosial_description ON sosial_description.id_sosial = sosial.id_sosial')
			->where('sosial.id_sosial', $id)
			->limit(1)
			->fetch();
		if (empty($current_statistik)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle($GLOBALS['_']['statistik_sosial_edit']);?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=statistik&act=editsosial&id='.$current_statistik['id_sosial'], 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_statistik['id_sosial']));?>
						
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
										$paglang = $this->podb->from('sosial_description')
											->where('sosial_description.id_sosial', $current_statistik['id_sosial'])
											->where('sosial_description.id_language', $lang['id_language'])
											->fetch();
									?>
                                    <?=$this->pohtml->inputHidden(array('name' => 'sosial['.$lang['id_language'].'][id]', 'value' => $paglang['id_sosial_description']));?>
									<div class="tab-pane <?php echo ($noctab == '1' ? 'active' : ''); ?>" id="tab-content-<?=$lang['id_language'];?>">
										<?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_title'], 'name' => 'sosial['.$lang['id_language'].'][title]', 'id' => 'title-'.$lang['id_language'], 'value' => $paglang['title'], 'mandatory' => true, 'options' => 'required'));?>
									</div>
									<?php $noctab++;} ?>
								</div>
							</div>
						</div>
                        <div class="row">
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_atas'], 'name' => 'atas', 'value' => $current_statistik['atas'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                            <div class="col-md-6">
                                <?=$this->pohtml->inputText(array('type' => 'text', 'label' => $GLOBALS['_']['statistik_bawah'], 'name' => 'bawah', 'value' => $current_statistik['bawah'], 'mandatory' => true, 'options' => 'required'));?>
							</div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12">
								<?php
									if ($current_statistik['active'] == 'N') {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'active', 'id' => 'active', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'active', 'id' => 'active', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => $GLOBALS['_']['statistik_active'], 'mandatory' => true), $radioitem, $inline = true);
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
		<?php
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus halaman.
	 *
	 * This function is used to display and process delete statistik.
	 *
	*/
	public function deletesosial()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query_desc = $this->podb->deleteFrom('sosial_description')->where('id_sosial', $this->postring->valid($_POST['id'], 'sql'));
			$query_desc->execute();
			$query_pag = $this->podb->deleteFrom('sosial')->where('id_sosial', $this->postring->valid($_POST['id'], 'sql'));
			$query_pag->execute();
			$this->poflash->success($GLOBALS['_']['statistik_sosial_message_3'], 'admin.php?mod=statistik&act=sosial');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi halaman.
	 *
	 * This function is used to display and process multi delete statistik.
	 *
	*/
	public function multideletesosial()
	{
		if (!$this->auth($_SESSION['leveluser'], 'statistik', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query_desc = $this->podb->deleteFrom('sosial_description')->where('id_sosial', $this->postring->valid($item['deldata'], 'sql'));
					$query_desc->execute();
					$query_pag = $this->podb->deleteFrom('sosial')->where('id_sosial', $this->postring->valid($item['deldata'], 'sql'));
					$query_pag->execute();
				}
				$this->poflash->success($GLOBALS['_']['statistik_sosial_message_3'], 'admin.php?mod=statistik&act=sosial');
			} else {
				$this->poflash->error($GLOBALS['_']['statistik_sosial_message_6'], 'admin.php?mod=statistik&act=sosial');
			}
		}
	}
    
    
}
