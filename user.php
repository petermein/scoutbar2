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
          	$users = USER::allUsers();
			foreach($users as $user){
				echo $user->photo(true);
			}
			?>
        </div>
      </div>
    </div>
  </div>
  <? include("footer.php")?>
</div>
</body>