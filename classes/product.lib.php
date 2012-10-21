<?php

class Product {

	var $product_id;
	var $name;
	var $price;
	var $min_age;
	var $categorie;
	var $weight;

	function Product($Product) {

		$this -> product_id = $Product['product_id'];
		$this -> update($Product);
	}

	static function byId($Product_id) {

		static $Products = array();

		if (!is_numeric($Product_id) or $Product_id <= 0)
			return null;

		if (array_key_exists($Product_id, $Products))
			return $Products[$Product_id];

		$database = Database::instance();

		$query = "
			SELECT
				*
			FROM
				product_product
		";

		$result = $database -> query($query);
		if ($row = $database -> row($result)) {
			$Products[$Product_id] = new Product($row);
		} else {
			$Products[$Product_id] = null;
		}

		return $Products[$Product_id];
	}

	function update($Product) {

		$this -> name = $Product['naam'];
		$this -> price = $Product['prijs'];
		$this -> min_age = $Product['min_leeftijd'];

		$this -> categorie = $Product['categorie'];
		$this -> weight = $Product['weight'];
	}

	function hasPhoto() {

		return self::photoExists($this -> product_id);
	}

	static function photoExists($Product_id) {

		return file_exists(DOC_ROOT . IMAGE_DIR . 'Products/' . $Product_id . '.png');
	}

	function photo($odd = false, $ghosted = false, $centered = false) {

		$string = self::ProductPhoto($this, $odd, $ghosted, $centered);
		return $string;

	}

	static function ProductPhoto($Product = null, $odd = false, $ghosted = false, $centered = false) {

		if ($Product !== null and self::photoExists($Product -> product_id)) {
			$image = WEB_ROOT . IMAGE_DIR . 'Products/' . $Product ->product_id . ".png";
		} else {
			$image = WEB_ROOT . IMAGE_DIR . 'default/user_photo_empty.png';
		}

		//TODO: Add style to image
		$string = "<img src='" . $image . "' class='Product_image' />";

		return $string;
	}



	function ProductLink() {
		//TODO: link to Product information
	}

	function toString(){
		echo "<pre>";
		var_dump($this);
		echo "</pre>";
		
	}

}
?>