<?php

function getmicrotime(){
	list($usec, $sec) = explode(" ",microtime());
	return ((float)$usec + (float)$sec);
}



function get_bytes($val) {

	$val	= trim($val);
	$last	= strtolower($val[strlen($val)-1]);

	switch($last) {

		case 'g': $val *= 1024;
		case 'm': $val *= 1024;
		case 'k': $val *= 1024;
	}

	return $val;
}

function superaddslashes($string) { // deprecated

	trigger_error('superaddslashes function deprecated', E_USER_NOTICE);
	
	return Database::escapeString($string);
}

function sas($string) { // deprecated

	return superaddslashes($string);
}

function superstripslashes($element) { // deprecated

	trigger_error('superstripslashes function deprecated', E_USER_NOTICE);

	return $element;
}

function sss($element) { // deprecated

	return superstripslashes($element);
}

function stripslashes_deep($value) { // deprecated

	return (is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value));
}

function utf8_decode_deep($value) {

	return $value;
//	return (is_array($value) ? array_map('utf8_decode_deep', $value) : utf8_decode($value));
}

function utf8_encode_deep($value) {

	return $value;
//	return (is_array($value) ? array_map('utf8_encode_deep', $value) : utf8_encode($value));
}

function json_encode_utf8($value) {

	return json_encode($value);
//	return json_encode(utf8_encode_deep($value));
}

function iconv_decode_deep($value) {

	return $value;
//	return (is_array($value) ? array_map('iconv_decode_deep', $value) : iconv('UTF-8', 'cp1252//IGNORE//TRANSLIT', $value));
}

function iconv_encode_deep($value) {

	return $value;
//	return (is_array($value) ? array_map('iconv_encode_deep', $value) : iconv('cp1252', 'UTF-8', $value));
}

function json_encode_iconv($value) {

	return json_encode($value);
//	return json_encode(iconv_encode_deep($value));
}

function entities($string) {

	return htmlentities($string, ENT_QUOTES, CHARSET);
}

function format_message($page,$string) { // deprecated

	require_once(DOC_ROOT.CLASS_DIR.'parser.lib.php');
	$parser = Parser::instance();
	return $parser->parse($string);
}

if(!function_exists('mb_ucfirst')) {

	function mb_ucfirst($str){ 
		$str[0] = mb_strtoupper($str[0]); 
		return $str; 
	}
}

function encodeQ($str, $charset = CHARSET, $firstlen = 75) {

	// remove this check when false positives appear, however this will reduce readabilty of raw email-headers in plain ASCII
	if(mb_detect_encoding($str, 'ASCII', true))
		return $str;

	// define start delimiter, end delimiter and spacer 
	$end    = "?="; 
	$start  = "=?".$charset."?Q?"; 
	$spacer = $end."\r\n ".$start;

	// determine length of allowed encoded string-length within chunks
	$maxlen = $firstlen - strlen($start) - strlen($end); 

	$strlen = strlen($str); 
	$out    = ''; 

	for($i = 0; $i < $strlen; $i ++) { 

		$outlen = strlen($out);

		if(($outlen + 3) > $maxlen) {

			$out   .= $spacer;
			$maxlen = $outlen + 75;
		}

		$chr = $str[$i];
		$asc = ord($chr);

		if($asc == 0x20)
			$out .= '_';
		else if($chr == "\r")
			$out .= '=0D';
		else if($chr == "\n")
			$out .= '=0A';
		else if(in_array($chr, array('=', '?', '_')) or $asc >= 0x80)
			$out .= '='.strtoupper(bin2hex($chr));
		else
			$out .= $chr;

	} 

	return $start.$out.$end; 
}

function encodeB($str, $charset = CHARSET) {

	// remove this check when false positives appear, however this will reduce readabilty of raw email-headers in plain ASCII
	if(mb_detect_encoding($str, 'ASCII', true))
		return $str;

	// define start delimiter, end delimiter and spacer 
	$end    = "?="; 
	$start  = "=?".$charset."?B?"; 
	$spacer = $end."\r\n ".$start; 

	// determine length of allowed encoded string-length within chunks and ensure length is even 
	$maxlen = 75 - strlen($start) - strlen($end); 

	// in  base64-encoding 3 8-bit-chars are represented by 4 6-bit-chars. These 4 chars must not be split between two encoded words, according to RFC-2047.
	$maxlen -= ($maxlen % 4); 

	// encode the string and split it into chunks with spacers after each chunk 
	$str = base64_encode($str); 
	$str = chunk_split($str, $maxlen, $spacer); 

	// remove trailing spacer and add start and end delimiters 
	$spacer = preg_quote($spacer); 
	$str    = preg_replace("/".$spacer."$/", "", $str); 

	return $start.$str.$end; 
}

function makebutton($link,$title,$pressed = false, $width = 100, $onclick = "") {

	$page = CurrentPage::instance();
	
	switch($page->style) {
	
		case 'rond/':
				
			$string  = "<table".(strlen($link) == 0 ? " class='button_ghosted'" : ($pressed ? " class='button_pressed'" : " class='button_normal' onmouseover='this.className=\"button_active\";' onmouseout='this.className=\"button_normal\";' onmousedown='this.className=\"button_pressed\";'")).(strlen($onclick) > 0 ? " onclick='".$onclick."'" : "")." cellspacing=0 cellpadding=0>";
			$string .= "<tr>";
			$string .= "<td class='button_part_left'></td>";
			$string .= "<td class='button_part_center' style='width: ".$width."px;'><a".(strlen($link) == 0 ? "" : " href='".$link."'").">".$title."</a></td>";
			$string .= "<td class='button_part_right'></td>";
			$string .= "</tr>";
			$string .= "</table>";
			break;
		
		default:
		
			$string  = "<div class='button".(empty($link) ? "_ghosted" : "").($pressed ? "_pressed" : "")."'".(empty($onclick) ? "" : " onclick='".$onclick."'").">";
			$string .= "<div class='button-left'></div>";
			$string .= "<div class='button-center'><a".(empty($link) ? "" : " href='".$link."'")." title='' style='width: ".$width."px;'>".$title."</a></div>";
			$string .= "<div class='button-right'></div>";
			$string .= "</div>";
			break;
	}

	return $string;
}

function makebreadcrumb($title) {
	/*
	echo "<table cellspacing='0' cellpadding='0'>";
	echo "<tr>";
	echo "<td class='button_normal_left'></td>";
	echo "<td class='button_normal_center' style='text-align: center; white-space: nowrap;'>";
	echo $title;
	echo "</td>";
	echo "<td class='button_normal_right'></td>";
	echo "</tr>";
	echo "</table>";
	*/
}

function xmlcharacters($string, $trans = null) {

	$trans = (is_array($trans) ? $trans : array('"' => '&quot;', "'" => '&apos;', '<' => '&lt;', '>' => '&gt;', '&' => '&amp;'));
	
	return strtr($string, $trans);
/*
	
	foreach ($trans as $k=>$v)
		$trans[$k]= "&#".ord($k).";";
		
	return strtr($string, $trans);
*/
}

function make_top_row($odd = true,$ghosted = false,$colspan = 1) {
	if (!isset($odd)) {
		$odd = false;
	}
	if (!isset($ghosted)) {
		$ghosted = false;
	}
	
	echo "<tr>";
	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_left_top'></td>";
	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_center_top' colspan='$colspan'></td>";
	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_right_top'></td>";
	echo "</tr>";
}

function make_bottom_row($odd = true,$ghosted = false,$colspan = 1) {
	if (!isset($odd)) {
		$odd = false;
	}
	if (!isset($ghosted)) {
		$ghosted = false;
	}

	echo "<tr>";
	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_left_bottom'></td>";
	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_center_bottom' colspan='$colspan'></td>";
	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_right_bottom'></td>";
	echo "</tr>";
}

function make_special_bottom_row($odd = true,$ghosted = false,$colspan = 1,$row_id, $object_id) {
	if (!isset($odd)) {
		$odd = false;
	}
	if (!isset($ghosted)) {
		$ghosted = false;
	}

	echo "<tr style='display: none;' id='".$row_id."_row_".$object_id."'>";
	make_center_left($odd,$ghosted);
	make_center_cell($odd,$ghosted,$colspan,"<div id='".$row_id."_content_".$object_id."'></div>",'padding-top: 10px;');
	make_center_right($odd,$ghosted);
	echo "</tr>";

	echo "<tr style='cursor: row-resize;' onclick='xajax_".$row_id."(document.getElementById(\"".$row_id."_row_".$object_id."\").style.display, ".$object_id.");'>";
	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) { 
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_left_bottom'></td>";
	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) { 
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_center_bottom' colspan=".$colspan."><div class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) { 
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_handle'>&nbsp;</div></td><td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) { 
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_right_bottom'></td>";
	echo "</tr>";

}

function make_center_left($odd = true,$ghosted = false) {
	if (!isset($odd)) {
		$odd = false;
	}
	if (!isset($ghosted)) {
		$ghosted = false;
	}

	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_left_middle'></td>";
}

function make_center_right($odd = true,$ghosted = false) {
	if (!isset($odd)) {
		$odd = false;
	}
	if (!isset($ghosted)) {
		$ghosted = false;
	}

	echo "<td class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_right_middle'></td>";
}

function make_center_cell($odd = true,$ghosted = false,$colspan = 1,$content = '',$style = '',$isheader = false) {
	if (!isset($odd)) {
		$odd = false;
	}
	if (!isset($ghosted)) {
		$ghosted = false;
	}

	if ($isheader) {
		echo "<th ";
	} else {
		echo "<td ";
	}
	echo "class='big_row_";
	if ($ghosted) {
		echo "ghosted";
	} else {
		if ($odd) {
			echo "odd";
		} else {
			echo "even";
		}
	}
	echo "_center_middle'";
	if (strlen($style)>0) {
		echo " style='$style'";
	}
	if ($colspan>1) {
		echo " colspan='$colspan'";
	}
	echo ">$content";
	if ($isheader) {
		echo "</th>";
	} else {
		echo "</td>";
	}
}

function generate_password($pw_length = 8) {
	// init vars
	$password = NULL;

	// toegestane ASCII's bepalen
	$lower_ascii_bound = 50; // "2"
	$upper_ascii_bound = 122; // "z"

	// 'lastige' letters verwijderen
	// o,O,0,I,1,l etc
	$notuse = array (58,59,60,61,62,63,64,73,79,91,92,93,94,95,96,108,111);
	$i = 0;
	while ($i<$pw_length) {
		mt_srand ((double)microtime() * 1000000);
		// random limieten in de ascii
		$randnum = mt_rand ($lower_ascii_bound, $upper_ascii_bound);
		if (!in_array ($randnum, $notuse)) {
			$password = $password . chr($randnum);
			$i++;
		}
	}

	return $password;
}

function is_valid_email($email) {
	return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', $email);
}

//Encodes an image in base64 for use in the API
function base64_encode_image ($imagefile) {

	$imgtype = array('image/jpg', 'image/jpeg', 'image/gif', 'image/png');
	$finfo = finfo_open(FILEINFO_MIME_TYPE);
	
	if(!file_exists($imagefile))
		trigger_error('Image file name does not exist', E_USER_ERROR);
		
	$mime = finfo_file($finfo, $imagefile);
	  
	if(!in_array($mime, $imgtype))
		trigger_error('Invalid image type, jpg, gif, and png is only allowed', E_USER_ERROR);

	//$imgbinary = fread(fopen($imagefile, "r"), filesize($imagefile));
	if(!$imgbinary = file_get_contents($imagefile))
		trigger_error('Error while reading the image contents', E_USER_ERROR);
	
	return 'data:'. $mime .';base64,' . base64_encode($imgbinary);
}

/*
 * Password hashing with PBKDF2.
 * Author: havoc AT defuse.ca
 * www: https://defuse.ca/php-pbkdf2.htm
 */

// These constants may be changed without breaking existing hashes.
define("PBKDF2_HASH_ALGORITHM", "sha256");
define("PBKDF2_ITERATIONS", 8192);
define("PBKDF2_SALT_BYTES", 24);
define("PBKDF2_HASH_BYTES", 24);

define("HASH_SECTIONS", 4);
define("HASH_ALGORITHM_INDEX", 0);
define("HASH_ITERATION_INDEX", 1);
define("HASH_SALT_INDEX", 2);
define("HASH_PBKDF2_INDEX", 3);

function create_hash($password)
{
	// format: algorithm:iterations:salt:hash
	$salt = base64_encode(random_bytes(PBKDF2_SALT_BYTES));
	return PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":" .  $salt . ":" . 
		base64_encode(pbkdf2(
			PBKDF2_HASH_ALGORITHM,
			$password,
			$salt,
			PBKDF2_ITERATIONS,
			PBKDF2_HASH_BYTES,
			true
		)
	);
}

function validate_password($password, $good_hash) {

	$params = explode(":", $good_hash);
	if(count($params) < HASH_SECTIONS)
	   return false; 
	$pbkdf2 = base64_decode($params[HASH_PBKDF2_INDEX]);
	return slow_equals(
		$pbkdf2,
		pbkdf2(
			$params[HASH_ALGORITHM_INDEX],
			$password,
			$params[HASH_SALT_INDEX],
			(int)$params[HASH_ITERATION_INDEX],
			strlen($pbkdf2),
			true
		)
	);
}

// Compares two strings $a and $b in length-constant time.
function slow_equals($a, $b) {

	$diff = strlen($a) ^ strlen($b);
	
	for($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
		$diff |= ord($a[$i]) ^ ord($b[$i]);

	return $diff === 0; 
}

/*
 * PBKDF2 key derivation function as defined by RSA's PKCS #5: https://www.ietf.org/rfc/rfc2898.txt
 * $algorithm - The hash algorithm to use. Recommended: SHA256
 * $password - The password.
 * $salt - A salt that is unique to the password.
 * $count - Iteration count. Higher is better, but slower. Recommended: At least 1000.
 * $key_length - The length of the derived key in bytes.
 * $raw_output - If true, the key is returned in raw binary format. Hex encoded otherwise.
 * Returns: A $key_length-byte key derived from the password and salt.
 *
 * Test vectors can be found here: https://www.ietf.org/rfc/rfc6070.txt
 *
 * This implementation of PBKDF2 was originally created by https://defuse.ca
 * With improvements by http://www.variations-of-shadow.com
 */
function pbkdf2($algorithm, $password, $salt, $count, $key_length, $raw_output = false) {

	$algorithm = strtolower($algorithm);
	if(!in_array($algorithm, hash_algos(), true))
		die('PBKDF2 ERROR: Invalid hash algorithm.');
	if($count <= 0 || $key_length <= 0)
		die('PBKDF2 ERROR: Invalid parameters.');

	$hash_length = strlen(hash($algorithm, "", true));
	$block_count = ceil($key_length / $hash_length);

	$output = "";
	for($i = 1; $i <= $block_count; $i++) {
		// $i encoded as 4 bytes, big endian.
		$last = $salt . pack("N", $i);
		// first iteration
		$last = $xorsum = hash_hmac($algorithm, $last, $password, true);
		// perform the other $count - 1 iterations
		for ($j = 1; $j < $count; $j++) {
			$xorsum ^= ($last = hash_hmac($algorithm, $last, $password, true));
		}
		$output .= $xorsum;
	}

	if($raw_output)
		return substr($output, 0, $key_length);
	else
		return bin2hex(substr($output, 0, $key_length));
}

function random_bytes($len = 10) {  

	/*
	* Our primary choice for a cryptographic strong randomness function is
	* openssl_random_pseudo_bytes. 
	*/
	$SSLstr = '4'; // http://xkcd.com/221/
	if (function_exists('openssl_random_pseudo_bytes') && 
		 (version_compare(PHP_VERSION, '5.3.4') >= 0 || 
	substr(PHP_OS, 0, 3) !== 'WIN'))
	{
		$SSLstr = openssl_random_pseudo_bytes($len, $strong);
		if ($strong)
			return $SSLstr;
	}

	/*
	* If mcrypt extension is available then we use it to gather entropy from 
	* the operating system's PRNG. This is better than reading /dev/urandom 
	* directly since it avoids reading larger blocks of data than needed. 
	* Older versions of mcrypt_create_iv may be broken or take too much time 
	* to finish so we only use this function with PHP 5.3 and above.
	*/
	if (function_exists('mcrypt_create_iv') && 
		(version_compare(PHP_VERSION, '5.3.0') >= 0 || 
		 substr(PHP_OS, 0, 3) !== 'WIN')) 
	{
		$str = mcrypt_create_iv($len, MCRYPT_DEV_URANDOM);
		if ($str !== false)
			return $str;	
	}


	/*
	* No build-in crypto randomness function found. We collect any entropy 
	* available in the PHP core PRNGs along with some filesystem info and memory
	* stats. To make this data cryptographically strong we add data either from 
	* /dev/urandom or if its unavailable, we gather entropy by measuring the 
	* time needed to compute a number of SHA-1 hashes. 
	*/
	$str = '';
	$bits_per_round = 2; // bits of entropy collected in each clock drift round
	$msec_per_round = 400; // expected running time of each round in microseconds
	$hash_len = 20; // SHA-1 Hash length
	$total = $len; // total bytes of entropy to collect

	$handle = @fopen('/dev/urandom', 'rb');   
	if ($handle && function_exists('stream_set_read_buffer'))
		@stream_set_read_buffer($handle, 0);

	do {
	
		$bytes = ($total > $hash_len)? $hash_len : $total;
		$total -= $bytes;

		//collect any entropy available from the PHP system and filesystem
		$entropy = rand() . uniqid(mt_rand(), true) . $SSLstr;
		$entropy .= implode('', @fstat(@fopen( __FILE__, 'r')));
		$entropy .= memory_get_usage();
		if ($handle) 
		{
			$entropy .= @fread($handle, $bytes);
		}
		else
		{	           	
			// Measure the time that the operations will take on average
			for ($i = 0; $i < 3; $i ++) 
			{
				$c1 = microtime(true);
				$var = sha1(mt_rand());
				for ($j = 0; $j < 50; $j++)
				{
					$var = sha1($var);
				}
				$c2 = microtime(true);
				$entropy .= $c1 . $c2;
			}

			// Based on the above measurement determine the total rounds
			// in order to bound the total running time.	
			$rounds = (int)($msec_per_round*50 / (int)(($c2-$c1)*1000000));

			// Take the additional measurements. On average we can expect
			// at least $bits_per_round bits of entropy from each measurement.
			$iter = $bytes*(int)(ceil(8 / $bits_per_round));
			for ($i = 0; $i < $iter; $i ++)
			{
				$c1 = microtime();
				$var = sha1(mt_rand());
				for ($j = 0; $j < $rounds; $j++)
				{
					$var = sha1($var);
				}
				$c2 = microtime();
				$entropy .= $c1 . $c2;
			}

		} 
		// We assume sha1 is a deterministic extractor for the $entropy variable.
		$str .= sha1($entropy, true);
	} while ($len > strlen($str));

	if ($handle) 
		@fclose($handle);

	return substr($str, 0, $len);
}

?>