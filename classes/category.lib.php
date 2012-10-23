<?php

class Category implements Comparable {

	var $Category_id;
	var $Name;
	var $Weight;
	var $Hidden;
	var $Color;
	
	static $Categorys = array();

	function Category($Category) {

		$this -> Category_id = $Category['categorie_id'];
		$this -> update($Category);
	}

	static function byId($Category_id) {

		if (!is_numeric($Category_id) or $Category_id <= 0)
			return null;

		if (array_key_exists($Category_id, self::$Categorys))
			return self::$Categorys[$Category_id];

		$database = Database::instance();

		$query = "
			SELECT
				*
			FROM
				product_categorie
			WHERE
				categorie_id = '" . $Category_id . "'
		";

		$result = $database -> query($query);
		if ($row = $database -> row($result)) {
			self::$Categorys[$Category_id] = new Category($row);
		} else {
			self::$Categorys[$Category_id] = null;
		}

		return self::$Categorys[$Category_id];
	}

	static function all($hidden = false, $sort = false) {

		$database = MYSQL::instance();

		$query = "
			SELECT
				*
			FROM
				product_categorie";
		if(!$hidden){
			$query .= "
			WHERE 
				hidden = '0'";
		}

		$rows = $database -> fetch_all_values($query);
		foreach ($rows as $row) {
			self::$Categorys[$row['categorie_id']] = new Category($row);
		}
		if ($sort) {
			$array = self::$Categorys;
			usort($array, array("Category", "compare"));
		}
		return $array;
	}

	static function compare($a, $b) {
		$aw = $a -> weight;
		$bw = $b -> weight;
		if ($aw == $bw) {
			return 0;
		}
		return ($aw < $bw) ? +1 : -1;
	}

	function update($Category) {

		$this -> name = $Category['naam'];
		$this -> weight = $Category['weight'];
			$this -> hidden = $Category['hidden'];
						$this -> color = $Category['color'];
	}

	function toString() {
		echo "<pre>";
		var_dump($this);
		echo "</pre>";

	}

}
?>