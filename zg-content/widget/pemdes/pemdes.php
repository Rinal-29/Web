<?php
/*
 *
 * - Zagitanank Widget File
 *
 * - File : pemdes.php
 * - Version : 1.0
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk widget galeri.
 * This is a php file for handling front end process for pemdes widget.
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
class Pemdes implements ExtensionInterface
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
        $templates->registerFunction('pemdes', [$this, 'getObject']);
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
	 * Fungsi ini digunakan untuk mengambil daftar pemdes.
	 *
	 * This function use to get list of pemdes.
	 *
	 * $limit = integer
	 * $order = string ASC or DESC
	 * $lang = WEB_LANG_ID
	*/
	public function getPemdes($order, $lang)
    {
		$pemdes = $this->core->podb->from('pemdes')
			->select(array('pemdes_description.jabatan'))
			->leftJoin('pemdes_description ON pemdes_description.id_pemdes = pemdes.id_pemdes')
			->where('pemdes_description.id_language', $lang)
			->where('pemdes.active', 'Y')
			->orderBy('pemdes.id_pemdes '.$order.'')
			->fetchAll();
        return $pemdes;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil data agama.
	 *
	 * This function use to get agama data.
	 *
	 * $id_agama = integer
	*/
	public function getAgama($id_agama)
    {
		$agama = $this->core->podb->from('agama')
			->select(array('nama_agama'))
			->where('id_agama', $id_agama)
			->limit(1)
			->fetch();
        return $agama;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil data author.
	 *
	 * This function use to get author data.
	 *
	 * $id_user = integer
	*/
	public function getAuthor($id_user)
    {
		$author = $this->core->podb->from('users')
			->select(array('username', 'nama_lengkap', 'email', 'no_telp', 'bio', 'picture'))
			->where('id_user', $id_user)
			->limit(1)
			->fetch();
        return $author;
    }

	/**
	 * Fungsi ini digunakan untuk mengambil nama author.
	 *
	 * This function use to get author name.
	 *
	 * $id_user = integer
	*/
	public function getAuthorName($id_user)
    {
		$author = $this->core->podb->from('users')
			->select(array('nama_lengkap', 'email', 'no_telp', 'bio', 'picture'))
			->where('id_user', $id_user)
			->limit(1)
			->fetch();
        return $author['nama_lengkap'];
    }
    

}
