<body class="modern-ui">
<div class="page secondary">
  <?php include("header.php")?>
  <div class="page-header">
    <div class="page-header-content"> <a href="#" class="back-button big page-back"></a>
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
      		<div class="tile bg-color-grayDark"> </div>
        </div>
        <div class="row">
          <?PHP 
          	$products = PRODUCT::allProducts();
			foreach($products as $product){
				echo $product->photo(true);
			}
			?>
        </div>
      </div>
    </div>
  </div>
  <? include("footer.php")?>
</div>
</body>
