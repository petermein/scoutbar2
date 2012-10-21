<?php

class User {

	var $persoon_id;
	var $firstname;
	var $lastname;

	var $nickname;

	var $email;
	var $mobile;
	var $date_of_birth;

	var $age;

	var $sex;
	
	static $users = array();

	function User($user) {

		$this -> persoon_id = $user['persoon_id'];
		$this -> update($user);
	}

	static function byId($user_id) {

		if (!is_numeric($user_id) or $user_id <= 0)
			return null;

		if (array_key_exists($user_id, self::$users))
			return self::$users[$user_id];

		$database = Database::instance();

		$query = "
			SELECT
				*
			FROM
				personen
			WHERE
				persoon_id=" . $user_id . "
			LIMIT 1
		";

		$result = $database -> query($query);
		if ($row = $database -> row($result)) {
			$users[$user_id] = new User($row);
		} else {
			$users[$user_id] = null;
		}

		return $users[$user_id];
	}

	static function allUsers() {

		$database = MYSQL::instance();

		$query = "
			SELECT
				*
			FROM
				personen";

		$rows = $database -> fetch_all_values($query);
		foreach($rows as $row){
		self::$users[$row['persoon_id']] = new User($row);
		}
		return self::$users;
	}

	function update($user) {

		$this -> firstname = $user['voornaam'];
		$this -> lastname = $user['achternaam'];
		$this -> nickname = $user['nickname'];

		$this -> email = $user['email'];
		$this -> mobile = $user['telefoon_nr'];
		$this -> date_of_birth = $user['geboortedatum'];
		$this -> age = $this -> getAge();
		//TODO: Add sex to db
		//$this -> sex = $user['sex'];
	}

	function hasPhoto() {

		return self::photoExists($this -> persoon_id);
	}

	static function photoExists($user_id) {

		return file_exists(DOC_ROOT . IMAGE_DIR . 'users/' . $user_id . '.png');
	}

	function photo($odd = false, $ghosted = false, $centered = false) {

		$string = self::userPhoto($this, $odd, $ghosted, $centered);
		return $string;

	}

	static function userPhoto($user = null, $odd = false, $ghosted = false, $centered = false) {

		if ($user !== null and self::photoExists($user -> persoon_id)) {
			$image = WEB_ROOT . IMAGE_DIR . 'users/' . $user -> persoon_id . ".png";
		} else {
			$image = WEB_ROOT . IMAGE_DIR . 'default/user_photo_empty.png';
		}

		//TODO: Add style to image
		$string = "<div class=\"tile\">
           <div class=\"tile-content image\"> <img src='" . $image . "' /> </div>
           <div class=\"brand bg-color-orange\">
             <p class=\"name\">" . $user -> firstname . " " . $user -> lastname . "</p>
           </div>
         </div>";

		return $string;
	}

	function photoAndName() {
		//TODO: Add name to photo
		$s = ($smoelenboek == false ? "<div class='user_container'>" : "<a class='user_anchor' href='" . $smoelenboek . "?user_id=" . $this -> id . "'>");
		$s .= self::userPhoto($this);
		$s .= $this -> userFullname();
		$s .= ($smoelenboek == false ? "</div>" : "</a>");

		return $s;
	}

	function userLink() {
		//TODO: link to user information
	}

	function getAge() {
		if ($this -> date_of_birth != null) {
			list($year, $month, $day) = explode("-", $this -> date_of_birth);
			$year_diff = date("Y") - $year;
			$month_diff = date("m") - $month;
			$day_diff = date("d") - $day;
			if ($month_diff < 0)
				$year_diff--;
			elseif (($month_diff == 0) && ($day_diff < 0))
				$year_diff--;
			return $year_diff;
		}
	}

	function toString() {
		echo "<pre>";
		var_dump($this);
		echo "</pre>";

	}

}
?>