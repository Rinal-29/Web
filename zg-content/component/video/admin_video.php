<?php
/*
 *
 * - Zagitanank Admin File
 *
 * - File : admin_video.php
 * - Version : 1.0
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses admin pada halaman video.
 * This is a php file for handling admin process for video page.
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

class Video extends PoCore
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
	 * Fungsi ini digunakan untuk menampilkan halaman index video.
	 *
	 * This function use for index video page.
	 *
	*/
	public function index()
	{
		if (!$this->auth($_SESSION['leveluser'], 'video', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle('Video', '
						<div class="btn-title pull-right">
							<a href="admin.php?mod=video&act=addnew" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> '.$GLOBALS['_']['addnew'].'</a>
						</div>
					');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=video&act=multidelete', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'totaldata', 'value' => '0', 'options' => 'id="totaldata"'));?>
						<?php
							$columns = array(
								array('title' => 'Id', 'options' => 'style="width:30px;"'),
								array('title' => 'Title', 'options' => ''),
								array('title' => 'URL', 'options' => ''),
								array('title' => 'Date', 'options' => ''),
								array('title' => 'Headline', 'options' => 'style="width:50px;"'),
								array('title' => 'Action', 'options' => 'class="no-sort" style="width:50px;"')
							);
						?>
						<?=$this->pohtml->createTable(array('id' => 'table-video', 'class' => 'table table-striped table-bordered'), $columns, $tfoot = true);?>
					<?=$this->pohtml->formEnd();?>
				</div>
			</div>
		</div>
		<?=$this->pohtml->dialogDelete('video');?>
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
		if (!$this->auth($_SESSION['leveluser'], 'video', 'read')) {
			echo $this->pohtml->error();
			exit;
		}
		$table = 'video';
		$primarykey = 'id_video';
		$columns = array(
			array('db' => $primarykey, 'dt' => '0', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<input type='checkbox' id='titleCheckdel' />\n
						<input type='hidden' class='deldata' name='item[".$i."][deldata]' value='".$d."' disabled />\n
					</div>\n";
				}
			),
			array('db' => $primarykey, 'dt' => '1', 'field' => $primarykey),
			array('db' => 'title', 'dt' => '2', 'field' => 'title'),
			array('db' => 'url', 'dt' => '3', 'field' => 'url',
				'formatter' => function($d, $row, $i){
					return "<a href='".$d."' target='_blank'>".$d."</a>\n";
				}
			),
			array('db' => 'date', 'dt' => '4', 'field' => 'date'),
			array('db' => 'headline', 'dt' => '5', 'field' => 'headline',
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>".$d."</div>\n";
				}
			),
			array('db' => $primarykey, 'dt' => '6', 'field' => $primarykey,
				'formatter' => function($d, $row, $i){
					return "<div class='text-center'>\n
						<div class='btn-group btn-group-xs'>\n
							<a href='admin.php?mod=video&act=edit&id=".$row['id_video']."' class='btn btn-xs btn-default' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_1']}'><i class='fa fa-pencil'></i></a>\n
							<a class='btn btn-xs btn-danger alertdel' id='".$d."' data-toggle='tooltip' title='{$GLOBALS['_']['action_2']}'><i class='fa fa-times'></i></a>
						</div>\n
					</div>\n";
				}
			)
		);
		echo json_encode(SSP::simple($_POST, $this->poconnect, $table, $primarykey, $columns));
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman tambah video.
	 *
	 * This function is used to display and process add video page.
	 *
	*/
	public function addnew()
	{
		if (!$this->auth($_SESSION['leveluser'], 'video', 'create')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$video = array(
				'title' => $this->postring->valid($_POST['title'], 'xss'),
				'url' => $_POST['url'],
				'date' => date('Y-m-d')
			);
			$query_video = $this->podb->insertInto('video')->values($video);
			$query_video->execute();
			$this->poflash->success('Video has been successfully added', 'admin.php?mod=video');
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle('Add Video');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=video&act=addnew', 'autocomplete' => 'off'));?>
						<div class="row">
							<div class="col-md-6">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => 'Title', 'name' => 'title', 'id' => 'title', 'mandatory' => true, 'options' => 'required', 'help' => '<small>&nbsp;</small>'));?>
							</div>
							<div class="col-md-6">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => 'Url', 'name' => 'url', 'id' => 'url', 'mandatory' => true, 'options' => 'required', 'help' => '<small>Example : https://www.youtube.com/embed/_A9s8EN-mbw</small>'));?>
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
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman edit video.
	 *
	 * This function is used to display and process edit video.
	 *
	*/
	public function edit()
	{
		if (!$this->auth($_SESSION['leveluser'], 'video', 'update')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$video = array(
				'title' => $this->postring->valid($_POST['title'], 'xss'),
				'url' => $_POST['url'],
				'headline' => $this->postring->valid($_POST['headline'], 'xss')
			);
			$query_video = $this->podb->update('video')
				->set($video)
				->where('id_video', $this->postring->valid($_POST['id'], 'sql'));
			$query_video->execute();
			$this->poflash->success('Video has been successfully updated', 'admin.php?mod=video');
		}
		$id = $this->postring->valid($_GET['id'], 'sql');
		$current_video = $this->podb->from('video')
			->where('id_video', $id)
			->limit(1)
			->fetch();
		if (empty($current_video)) {
			echo $this->pohtml->error();
			exit;
		}
		?>
		<div class="block-content">
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->headTitle('Update Video');?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?=$this->pohtml->formStart(array('method' => 'post', 'action' => 'route.php?mod=video&act=edit', 'autocomplete' => 'off'));?>
						<?=$this->pohtml->inputHidden(array('name' => 'id', 'value' => $current_video['id_video']));?>
						<div class="row">
							<div class="col-md-6">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => 'Title', 'name' => 'title', 'id' => 'title', 'value' => $current_video['title'], 'mandatory' => true, 'options' => 'required', 'help' => '<small>&nbsp;</small>'));?>
							</div>
							<div class="col-md-6">
								<?=$this->pohtml->inputText(array('type' => 'text', 'label' => 'Url', 'name' => 'url', 'id' => 'url', 'value' => $current_video['url'], 'mandatory' => true, 'options' => 'required', 'help' => '<small>Example : https://www.youtube.com/embed/_A9s8EN-mbw</small>'));?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<?php
									if ($current_video['headline'] == 'N') {
										$radioitem = array(
											array('name' => 'headline', 'id' => 'headline1', 'value' => 'Y', 'options' => '', 'title' => 'Y'),
											array('name' => 'headline', 'id' => 'headline2', 'value' => 'N', 'options' => 'checked', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => 'Headline', 'mandatory' => true), $radioitem, $inline = true);
									} else {
										$radioitem = array(
											array('name' => 'headline', 'id' => 'headline1', 'value' => 'Y', 'options' => 'checked', 'title' => 'Y'),
											array('name' => 'headline', 'id' => 'headline2', 'value' => 'N', 'options' => '', 'title' => 'N')
										);
										echo $this->pohtml->inputRadio(array('label' => 'Headline', 'mandatory' => true), $radioitem, $inline = true);
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
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus video.
	 *
	 * This function is used to display and process delete video page.
	 *
	*/
	public function delete()
	{
		if (!$this->auth($_SESSION['leveluser'], 'video', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$query = $this->podb->deleteFrom('video')->where('id_video', $this->postring->valid($_POST['id'], 'sql'));
			$query->execute();
			$this->poflash->success('Video has been successfully deleted', 'admin.php?mod=video');
		}
	}

	/**
	 * Fungsi ini digunakan untuk menampilkan dan memproses halaman hapus multi video.
	 *
	 * This function is used to display and process multi delete video page.
	 *
	*/
	public function multidelete()
	{
		if (!$this->auth($_SESSION['leveluser'], 'video', 'delete')) {
			echo $this->pohtml->error();
			exit;
		}
		if (!empty($_POST)) {
			$totaldata = $this->postring->valid($_POST['totaldata'], 'xss');
			if ($totaldata != "0") {
				$items = $_POST['item'];
				foreach($items as $item){
					$query = $this->podb->deleteFrom('video')->where('id_video', $this->postring->valid($item['deldata'], 'sql'));
					$query->execute();
				}
				$this->poflash->success('Video has been successfully deleted', 'admin.php?mod=video');
			} else {
				$this->poflash->error('Error deleted video data', 'admin.php?mod=video');
			}
		}
	}

}