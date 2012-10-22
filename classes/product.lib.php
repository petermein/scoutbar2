<?php

class Product {

	var $product_id;
	var $name;
	var $price;
	var $min_age;
	var $categorie;
	var $weight;
	
	static $Products = array();
	

	function Product($Product) {

		$this -> product_id = $Product['product_id'];
		$this -> update($Product);
	}

	static function byId($Product_id) {

		
		if (!is_numeric($Product_id) or $Product_id <= 0)
			return null;

		if (array_key_exists($Product_id, self::$Products))
			return self::$Products[$Product_id];

		$database = Database::instance();

		$query = "
			SELECT
				*
			FROM
				product_product
		";

		$result = $database -> query($query);
		if ($row = $database -> row($result)) {
			self::$Products[$Product_id] = new Product($row);
		} else {
			self::$Products[$Product_id] = null;
		}

		return self::$Products[$Product_id];
	}
	
	static function allProducts() {

		$database = MYSQL::instance();

		$query = "
			SELECT
				*
			FROM
				product_product";

		$rows = $database -> fetch_all_values($query);
		foreach($rows as $row){
		self::$Products[$row['product_id']] = new Product($row);
		}
		return self::$Products;
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

	function photo($name = false, $ghosted = false, $centered = false) {

		$string = self::ProductPhoto($this, $name, $ghosted, $centered);
		return $string;

	}

	static function ProductPhoto($Product = null, $name = false, $ghosted = false, $centered = false) {

		if ($Product !== null and self::photoExists($Product -> product_id)) {
			$image = WEB_ROOT . IMAGE_DIR . 'Products/' . $Product ->product_id . ".png";
		} else {
			$image = WEB_ROOT . IMAGE_DIR . 'default/user_photo_empty.png';
		}

		//TODO: Add style to image
		$string = "<div class=\"tile\">
           <div class=\"tile-content image\"> <img src='" . $image . "' /> </div>";
           if($name){
           	           $string .= "<div class=\"brand bg-color-green\">";
		   	if($Product -> min_age == 16){
		$string .= "<div class=\"badge bg-color-red\">16</div>";
		   }
        $string .=  "<p class=\"name\">" . $Product -> name . "</p>";
        
           $string .= "</div>";
   	   }
        $string .= "</div>";
		 
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