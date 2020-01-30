<?php
/*
 *
 * - Zagitanank statistik File
 *
 * - File : statistik.php
 * - Version : 1.0
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk statistik statistik.
 * This is a php file for handling front end process for statistik statistik.
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
 * Mendeklarasikan class statistik diharuskan dengan mengimplementasikan class ExtensionInterface (diharuskan).
 *
 * Declaration statistik class must with implements ExtensionInterface class (require).
 *
*/
class Statistik implements ExtensionInterface
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
	 * Fungsi ini digunakan untuk mendaftarkan semua fungsi statistik (diharuskan).
	 *
	 * This function use to register all statistik function (require).
	 *
	*/
    public function register(Engine $templates)
    {
        $templates->registerFunction('statistik', [$this, 'getObject']);
    }

	/**
	 * Fungsi ini digunakan untuk menangkap semua fungsi statistik (diharuskan).
	 *
	 * This function use to catch all statistik function (require).
	 *
	*/
    public function getObject()
    {
        return $this;
    }

	/**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik.
	 *
	 * This function use to get all list of statistik.
	 *
	 * $order = string
	 * $limit = integer
	*/
	public function getStatistik($order, $lang)
    {
		$statistik = $this->core->podb->from('statistik')
			->select(array('statistik_description.title'))
			->leftJoin('statistik_description ON statistik_description.id_statistik = statistik.id_statistik')
			->where('statistik_description.id_language', $lang)
			->where('statistik.active', 'Y')
			->orderBy('statistik.id_statistik '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik pekerjaan.
	 *
	 * This function use to get all list of statistik work.
	 *
	 * $order = string
	 * $limit = integer
	*/
	public function getPekerjaan($order, $lang)
    {
		$statistik = $this->core->podb->from('pekerjaan')
			->select(array('pekerjaan_description.title'))
			->leftJoin('pekerjaan_description ON pekerjaan_description.id_pekerjaan = pekerjaan.id_pekerjaan')
			->where('pekerjaan_description.id_language', $lang)
			->where('pekerjaan.active', 'Y')
			->orderBy('pekerjaan.id_pekerjaan '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik pendidikan.
	 *
	 * This function use to get all list of statistik student.
	 *
	 * $order = string
	 * $limit = integer
	*/
	public function getPendidikan($order, $lang)
    {
		$statistik = $this->core->podb->from('pendidikan')
			->select(array('pendidikan_description.title'))
			->leftJoin('pendidikan_description ON pendidikan_description.id_pendidikan = pendidikan.id_pendidikan')
			->where('pendidikan_description.id_language', $lang)
			->where('pendidikan.active', 'Y')
			->orderBy('pendidikan.id_pendidikan '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik dusun.
	 *
	 * This function use to get all list of statistik dusun.
	 *
	 * $order = string
	 * $limit = integer
	*/
	public function getDusun($order, $lang)
    {
		$statistik = $this->core->podb->from('dusun')
			->select(array('dusun_description.title'))
			->leftJoin('dusun_description ON dusun_description.id_dusun = dusun.id_dusun')
			->where('dusun_description.id_language', $lang)
			->where('dusun.active', 'Y')
			->orderBy('dusun.id_dusun '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik agama.
	 *
	 * This function use to get all list of statistik religion.
	 *
	 * $order = string
	 * $limit = integer
	*/
    
    public function getAgama($order, $lang)
    {
		$statistik = $this->core->podb->from('agama_penduduk')
			->select(array('agama_penduduk_description.title'))
			->leftJoin('agama_penduduk_description ON agama_penduduk_description.id_agama = agama_penduduk.id_agama')
			->where('agama_penduduk_description.id_language', $lang)
			->where('agama_penduduk.active', 'Y')
			->orderBy('agama_penduduk.id_agama '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik kawin.
	 *
	 * This function use to get all list of statistik merried.
	 *
	 * $order = string
	 * $limit = integer
	*/
    
    public function getKawin($order, $lang)
    {
		$statistik = $this->core->podb->from('kawin')
			->select(array('kawin_description.title'))
			->leftJoin('kawin_description ON kawin_description.id_kawin = kawin.id_kawin')
			->where('kawin_description.id_language', $lang)
			->where('kawin.active', 'Y')
			->orderBy('kawin.id_kawin '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik umur.
	 *
	 * This function use to get all list of statistik age.
	 *
	 * $order = string
	 * $limit = integer
	*/
    
    public function getUmur($order, $lang)
    {
		$statistik = $this->core->podb->from('umur')
			->select(array('umur_description.title'))
			->leftJoin('umur_description ON umur_description.id_umur = umur.id_umur')
			->where('umur_description.id_language', $lang)
			->where('umur.active', 'Y')
			->orderBy('umur.id_umur '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik umur.
	 *
	 * This function use to get all list of statistik age.
	 *
	 * $order = string
	 * $limit = integer
	*/
    
    public function getRw($order, $lang)
    {
		$statistik = $this->core->podb->from('rw')
			->select(array('rw_description.title'))
			->leftJoin('rw_description ON rw_description.id_rw = rw.id_rw')
			->where('rw_description.id_language', $lang)
			->where('rw.active', 'Y')
			->orderBy('rw.id_rw '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar semua statistik sosial.
	 *
	 * This function use to get all list of statistik social.
	 *
	 * $order = string
	 * $limit = integer
	*/
    
    public function getSosial($order, $lang)
    {
		$statistik = $this->core->podb->from('sosial')
			->select(array('sosial_description.title'))
			->leftJoin('sosial_description ON sosial_description.id_sosial = sosial.id_sosial')
			->where('sosial_description.id_language', $lang)
			->where('sosial.active', 'Y')
			->orderBy('sosial.id_sosial '.$order.'')
			->fetchAll();
        return $statistik;
    }
    
    /**
	 * Fungsi ini digunakan untuk menghitung daftar statistik berdasarkan category.
	 *
	 * This function use to count list of statistik base on category.
	 *
	 * $category = array of category
	*/
    public function CountDusun()
    {
		//$offset = $this->core->popaging->searchPosition($limit, $page);
        
		$count = $this->core->podb->from('dusun')
			->count();
		return $count;
        
    }
    

}
