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
<script src="'. JAVASCRIPT_DIR.'github.info.js"></script>
<script src="'. JAVASCRIPT_DIR.'db.min.js"></script>
<script src="'. JAVASCRIPT_DIR.'error.js"></script>';
?>
</head>
<body class="modern-ui">
<div class="page secondary">
  <?php include("header.php")?>

<script>
	$(document).ready(function(){
	$('.tile.product').click(function(){
		$(this).addClass('selected');
		var i = $(this).find('.count').html();
		i++;
		var count = $(this).find('.count').html(i);
		$(this).find('.count').show();
		var id = $(this).find(':input[name=id]').val();
		var url = ".//api/api.php?request=product&id="+id;
		$.getJSON(url, function(data) {
				addproduct(data.product_id, data.name, data.price, 1);			
  			})
	});
	
	$('.tile.bg-color-green').click(function(){
		truncatedb();
		
	});
	
	// set up click/tap panels
			$('.hover').toggle(function(){
				$(this).addClass('flip');
			},function(){
				$(this).removeClass('flip');
			});
	
	
	});
	
	function clearSelect(){
		$('.tile.selected').each(function(){
			$(this).removeClass('selected');
			$(this).find('.count').html(0);
			$(this).find('.count').hide();
		})
	}
	
	function updateList(){
		$('#pricelist').html('');
		var total =0 ;
		db.read('SELECT * FROM Cart',[], function(e){
			 for (var i = 0; i < e.length; i++) {
			 	var price = e.item(i).amount * e.item(i).price;
			 	var row = '<div class="brand-row"><p class="name">'+ e.item(i).productname +'</p><p class="badge">'+ price +'</p></div>';
				total = total + price;
        		$('#pricelist').append(row);
    		}
				var row = 		'<div class="brand"><p class="name">Total</p><p class="badge">'+ total +'</p></div>';
				$('#pricelist').append(row);
		});
	}
</script>

  <div class="page-header"> 
  <div class="page-header-content bg">
     <a href="index.php" class="back-button big page-back"></a>
      <h1> Producten <small>streeplijst</small> </h1>
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
          <div class="tile bg-color-green"> </div>
          
        </div>
        <div class="row">
        
          	<?PHP 
			$first = true;
        		$category = CATEGORY::all('', true);
				foreach($category as $cat){
					echo '<div class="row">';
					echo '<div class="span8" style="margin-right: 0px; width:640px;">';
					$products = PRODUCT::byCategory($cat->Category_id);
					$i = 0;
					foreach($products as $product){
						echo $product->photo(true);
						$i++;
						$color = CATEGORY::byId($product->categorie) -> color;
					}
					for($j = ($i%4 == 0 ? 0 : 4 - $i%4); $j==0, $j--;){
								echo "<div class=\"tile bg-color-". $color ."\">
           								
									</div>";
					}
					echo '</div>';
					if($first){
						echo '<div class="span2">';
						echo '<div class="hover panel">';
						echo '<div id="pricelist" class="tile front double-vertical bg-color-yellow"> </div>';
						echo '<div class="tile back double-vertical bg-color-green"> </div>';
						echo '</div>';
						echo '</div>';
					$first = false;
					}
					echo '</div>';
				}
			?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
