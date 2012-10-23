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
        <div class="row" id="userboard">
 			<?PHP 
          	$users = USER::all();
			foreach($users as $user){
				echo $user->photo(true);
			}
			?>
        </div>
      </div>
    </div>
  </div>
  <?php include("footer.php")?>
</div>
</body>
<script language="JavaScript">
//--user click handler--\\
	$(document).ready(function() {
		$('.tile.user').click(function() {
			console.log($(this).attr('id'));
			document.location.href = "index.php?page=poduct&user_id="+$(this).attr('id');
		});
		
		$('.tile.user').click(function() {
			console.log($(this).attr('id'));
		});
		
		$('#search').change(function(event) {
			console.log('2');
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
	function MassaStreep(){
		document.getElementById("main_row").innerHTML = "";
	}
	
</script>