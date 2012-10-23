<body class="modern-ui">
<div class="page secondary">
  <?php include("header.php")?>

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
						echo '<div class="tile double-vertical bg-color-yellow"> </div>';
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
