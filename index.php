<?PHP
require_once 'config/config.inc.php';
require_once DOC_ROOT.CLASS_DIR.'user.lib.php';
require_once DOC_ROOT.CLASS_DIR.'product.lib.php';

?>
<!DOCTYPE html>
<html>
<head>
	<?PHP
echo '<meta http-equiv="Content-Type" content="text/html; '. ENCODING .'="'. CHARSET .'" />
<title>Scoutbar2.0</title>
<link href="'. STYLE_DIR.'modern.css" rel="stylesheet">
<link href="'. STYLE_DIR.'modern-responsive.css" rel="stylesheet">
<link href="'. STYLE_DIR.'site.css" rel="stylesheet" type="text/css">
<script src="'. JAVASCRIPT_DIR.'jquery-1.8.2.min.js"></script>
<script src="'. JAVASCRIPT_DIR.'google-analytics.js"></script>
<script src="'. JAVASCRIPT_DIR.'github.info.js"></script>';
?>
</head>
<?PHP 
	if(isset($_GET['page'])){
	 switch($_GET['page']){
	 case "user":
	 	include("user.php");
	 break;
	 case "poduct":
	 	include("product.php");
	 break;
	 }
	}else{
		include("user.php");
	}
?>
</html>
