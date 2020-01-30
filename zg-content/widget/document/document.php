<?php
/*
 *
 * - Zagitanank document File
 *
 * - File : document.php
 * - Version : 1.0
 * - Author : Zagitanank
 * - License : MIT License
 *
 *
 * Ini adalah file php yang di gunakan untuk menangani proses di bagian depan untuk document document.
 * This is a php file for handling front end process for document document.
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
 * Mendeklarasikan class document diharuskan dengan mengimplementasikan class ExtensionInterface (diharuskan).
 *
 * Declaration document class must with implements ExtensionInterface class (require).
 *
*/
class Document implements ExtensionInterface
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
	 * Fungsi ini digunakan untuk mendaftarkan semua fungsi document (diharuskan).
	 *
	 * This function use to register all document function (require).
	 *
	*/
    public function register(Engine $templates)
    {
        $templates->registerFunction('document', [$this, 'getObject']);
    }

	/**
	 * Fungsi ini digunakan untuk menangkap semua fungsi document (diharuskan).
	 *
	 * This function use to catch all document function (require).
	 *
	*/
    public function getObject()
    {
        return $this;
    }

	/**
	 * Fungsi ini digunakan untuk mengambil daftar semua document.
	 *
	 * This function use to get all list of document.
	 *
	 * $order = string
	 * $limit = integer
     * $lang = string
	*/
	public function getDocument($order, $lang)
    {
		$document = $this->core->podb->from('document')
			->select(array('document_description.title'))
			->leftJoin('document_description ON document_description.id_document = document.id_document')
			->where('document_description.id_language', $lang)
            ->where('document.active', 'Y')
			->orderBy('document.id_document '.$order.'')
			->fetchAll();
        return $document;
    }

	/**
	 * Fungsi ini digunakan untuk mengambil daftar kategori berdasarkan id_post.
	 *
	 * This function use to get list of category base on id_post.
	 *
	 * $id_document = integer
	 * $lang = WEB_LANG_ID
	 * $link = boolean
	*/
    public function getDocCategory($id_document, $lang)
    {
		$doc_cats = $this->core->podb->from('document_category')
			->where('id_document', $id_document)
			->fetchAll();
		$category = '';
		foreach($doc_cats as $doc_cat){
			$categorys = $this->core->podb->from('category_document')
				->select('category_document_description.title')
				->leftJoin('category_document_description ON category_document_description.id_category_document = category_document.id_category_document')
				->where('category_document.id_category_document', $doc_cat['id_category_document'])
				->where('category_document_description.id_language', $lang)
				->where('category_document.active', 'Y')
				->limit(1)
				->fetch();
		$category .= $categorys['title'];
		}
        return $category;
    }

	/**
	 * Fungsi ini digunakan untuk mengambil daftar post berdasarkan kategori.
	 *
	 * This function use to get list of post base on category.
	 *
	 * $order = string
	 * $category = array of category
	 * $lang = WEB_LANG_ID
	*/
	public function getDocFromCategory($order, $category, $lang)
    {
	   if ($category['seotitle'] == 'all') {
			$document = $this->core->podb->from('document')
				->select(array('document_description.title'))
				->leftJoin('document_description ON document_description.id_document = document.id_document')
				->where('document_description.id_language', $lang)
				->where('document.active', 'Y')
				->fetchAll();
		} else {
       	    $document = array();
			$categorys = $this->core->podb->from('document_category')
				->where('id_category_document', $category['id_category_document'])
				->orderBy($order)
				->fetchAll();
			foreach($categorys as $cat){
				$if_doc = $this->getDocById($cat['id_document'], $lang);
				if (!empty($if_doc['active'])) {
					$document[] = $this->getDocById($cat['id_document'], $lang);
				}
			}
		}
        return $this->arrayOrderBy($document, 'id_document', SORT_DESC);
    }
    
    /**
	 * Fungsi ini digunakan untuk mengambil daftar document berdasarkan id_document.
	 *
	 * This function use to get list of document base on id_document.
	 *
	 * $id_document = integer
	 * $lang = WEB_LANG_ID
	*/
    public function getDocById($id_document, $lang)
    {
		$document = $this->core->podb->from('document')
			->select(array('document_description.title'))
			->leftJoin('document_description ON document_description.id_document = document.id_document')
			->where('document.id_document', $id_document)
			->where('document_description.id_language', $lang)
			->where('document.active', 'Y')
			->limit(1)
			->fetch();
        return $document;
    }
    
    /**
	 * Fungsi ini digunakan untuk membuat daftar kategori bercabang berdasarkan parent.
	 *
	 * This function use to create list of category tree base on parent.
	 *
	 * $id_category = integer
	*/
	public function getCategoryParentTree($id_category)
    {
		$ptree = array();
		$ptree[] = "".$id_category."";
		$ctree = $this->getCategoryTree($id_category);
		$ptree = array_merge($ptree, $ctree);
		return $ptree;
	}

	/**
	 * Fungsi ini digunakan untuk membuat daftar kategori bercabang.
	 *
	 * This function use to create list of category tree.
	 *
	 * $id_category = integer
	*/
	public function getCategoryTree($id_category)
    {
		$tree = array();
		$catfuns = $this->core->podb->from('category_document')
			->select('category_document_description.title')
			->leftJoin('category_document_description ON category_document_description.id_category_document = category_document.id_category_document')
			->where('category_document.id_parent', $id_category)
			->where('category_document_description.id_language', '1')
			->orderBy('category_document.id_category_document ASC')
			->fetchAll();
		$tree[] = $catfun['id_category_document'];
        return $tree;
    }
    
    /**
	 * Fungsi ini digunakan untuk mengurutkan array.
	 *
	 * This function use to array order.
	 *
	*/
	public function arrayOrderBy()
	{
		$args = func_get_args();
		$data = array_shift($args);
		foreach ($args as $n => $field) {
			if (is_string($field)) {
				$tmp = array();
				foreach ($data as $key => $row)
					$tmp[$key] = $row[$field];
				$args[$n] = $tmp;
				}
		}
		$args[] = &$data;
		call_user_func_array('array_multisort', $args);
		return array_pop($args);
	}

}
