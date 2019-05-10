<?php

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class Product extends Model {

	const SESSION = "User";

	
	public static function listAll()
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_products ORDER BY desproduct");

		return $results;
	}

	public function save()
	{

		$sql = new Sql();

		$results = $sql->select("CALL sp_products_save(:idproduct, :desproduct, :vlprice, :vlwidth, :vlheight, :vllength, :vlweight, :desurl)", 
			array(
			":idproduct"=>$this->getidproduct(),
			":desproduct"=>$this->getdesproduct(),
			":vlprice"=>$this->getvlprice(),
			":vlwidth"=>$this->getvlwidth(),
			":vlheight"=>$this->getvlheight(),
			":vllength"=>$this->getvllength(),
			":weight"=>$this->getweight(),
			":desurl"=>$this->getdesurl()
		));

		$this->setData($results[0]);

		Category::updateFile();
	}

	public function get($idproduct)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_products WHERE idproduct = :idproduct",[
			':idproduct'=>$idproduct
		]);

		$this->setData($results[0]);
	}

	public function delete()
	{
		$sql = new Sql();

		$sql->query("DELETE FROM tb_categories WHERE idcategory = :idcategory", [
			':idcategory'=>$this->getidcategory()
		]);

		Category::updateFile();
	}



}
?>  