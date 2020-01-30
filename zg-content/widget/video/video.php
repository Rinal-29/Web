<?php
/*
 *
 * - Zagitanank Widget File
 *
 * - File : video.php
 * - Version : 1.0
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk widget galeri.
 * This is a php file for handling front end process for video widget.
 *
*/

/**
 * Memanggil class utama PoTemplate (diharuskan).
 *
 * Call main class PoTemplate (require).
 *
*/
use PoTemplate\Engine;
use PoTemplate\Extension\ExtensionInterface;

/**
 * Mendeklarasikan class widget diharuskan dengan mengimplementasikan class ExtensionInterface (diharuskan).
 *
 * Declaration widget class must with implements ExtensionInterface class (require).
 *
*/
class video implements ExtensionInterface
{

	/**
	 * Fungsi ini digunakan untuk menginisialisasi class utama (diharuskan).
	 *
	 * This function use to initialize the main class (require).
	 *
	*/
	public function __construct()
	{
		$this->core = new PoCore();
	}

	/**
	 * Fungsi ini digunakan untuk mendaftarkan semua fungsi widget (diharuskan).
	 *
	 * This function use to register all widget function (require).
	 *
	*/
    public function register(Engine $templates)
    {
        $templates->registerFunction('video', [$this, 'getObject']);
    }

	/**
	 * Fungsi ini digunakan untuk menangkap semua fungsi widget (diharuskan).
	 *
	 * This function use to catch all widget function (require).
	 *
	*/
    public function getObject()
    {
        return $this;
    }


	/**
	 * Fungsi ini digunakan untuk mengambil daftar video.
	 *
	 * This function use to get list of video.
	 *
	 * $limit = integer
	 * $order = string
	 * $page = integer from get active page
	*/
	public function getVideo($limit, $order='id_video DESC', $page)
    {
		$offset = $this->core->popaging->searchPosition($limit, $page);
		$video = $this->core->podb->from('video')
			->orderBy($order)
			->limit($offset.','.$limit)
			->fetchAll();
		return $video;
    }

	/**
	 * Fungsi ini digunakan untuk membuat nomor halaman pada halaman video
	 *
	 * This function use to create pagination in video page.
	 *
	 * $limit = integer
	 * $page = integer from get active page
	 * $type = 0 or 1
	 * $prev = string previous text
	 * $next = string next text
	*/
	public function getVideoPaging($limit, $page, $type, $prev, $next)
    {
		$totaldata = $this->core->podb->from('video')->count();
		$totalpage = $this->core->popaging->totalPage($totaldata, $limit);
		$pagination = $this->core->popaging->navPage($page, $totalpage, BASE_URL, 'video', 'page', $type, $prev, $next);
		return $pagination;
	}

	/**
	 * Fungsi ini digunakan untuk mengambil daftar galeri berdasarkan video.
	 *
	 * This function use to get list of video base on album.
	 *
	 * $limit = integer
	 * $order = string
	*/
    public function getHeadlineVideo($limit, $order)
    {
        $video = $this->core->podb->from('video')
            ->where('headline','Y')
            ->orderBy($order)
            ->limit($limit)
            ->fetchAll();
        return $video;
    }

}
