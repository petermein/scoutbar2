<?PHP
require_once 'config/config.inc.php';
require_once DOC_ROOT.CLASS_DIR.'database.class.php';
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
<script src="'. JAVASCRIPT_DIR.'error.js"></script>';
?>
<script>
	$(document).ready(function() {
		$('.tile.user').click(function() {
			console.log($(this).attr('id'));
		});
		
		$('#search').keyup(function(event) {
			var search_text = $('#search').val();
			var rg = new RegExp(search_text,'i');
			$('#userboard .tile').each(function(){
	 			if($.trim($(this).find("var").html()).search(rg) == -1) {
					$(this).hide().children().hide();
				}	
				else {
					$(this).show().children().show();
				}
			});
		});
		
		$('.helper').click(function(event) {
			$(this).parent().find(':input').val('').keyup();
			error('click');
		});
	
	});
</script>
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
      		<span class="tertiary" id="now-playing"></span>
      	</div>
        <div class="row" id="userboard">
          <?PHP 
          	$users = USER::all(true);
			
			foreach($users as $user){
				echo $user->photo(true);
			}
			?>
        </div>
        <div class="row">
        	<div class="input-control text">
        		<input type="text" id="search"/>
        		<span class="helper"></span>
    		</div>
        </div>
      </div>
    </div>
  </div>
  <?php include("footer.php")?>
</div>
</body>
</html>
