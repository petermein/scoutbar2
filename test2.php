<?PHP
require_once 'config/config.inc.php';
require_once DOC_ROOT.CLASS_DIR.'database.class.php';
require_once DOC_ROOT.CLASS_DIR.'category.lib.php';
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
<body class="modern-ui">
<div class="page secondary">
  <?php include("header.php")?>
  <div class="page-header">
    <div class="page-header-content"> <a href="#" class="back-button big page-back"></a>
      <h1> Gebruikers <small>streeplijst</small> </h1>
    </div>
  </div>
  <div class="page-region">
    <div class="page-region-content">
      <div class="grid">
      	<div class="row">
      		<?PHP
      		$user = USER::byId($_GET['user_id']);
			echo $user->productPhoto();
      		?>
      		 <div class="tile bg-color-grayDarks"> </div>
        </div>
        <?PHP 
        $category = CATEGORY::all(true);
		foreach($category as $cat){
			echo "<div class=\"row\">";
			echo $cat->Category_id;
			$products = PRODUCT::byCategory($cat->Category_id);
			foreach($products as $product){
				echo $product->photo(true);
			}
			echo "</div>";
		}
	?>
        </div>
      </div>
    </div>
  </div>
  <? include("footer.php")?>
</div>
</body>
</html>
