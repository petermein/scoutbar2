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
        <div class="row" id="main_row">
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
  <? include("footer.php")?>
</div>
</body>
<script language="JavaScript">
//--user click handler--\\
	$(document).ready(function() {
		$('.tile.user').click(function() {
			console.log($(this).attr('id'));
			document.location.href = "index.php?page=poduct&user_id="+$(this).attr('id');
		});
	});
	function MassaStreep(){
		document.getElementById("main_row").innerHTML = "";
	}
//--user--\\
     $(function () {
         jsKeyboard.init("virtualKeyboard");
         $("#txtContent").val(initText);
     });
     
     function focusIt(t) {
        // define where the cursor is to write character clicked.
         jsKeyboard.currentElement = $(t);
         jsKeyboard.show();
     }

     function showKeyboard(id) {
         clean($("#" + id));
         jsKeyboard.currentElement = $("#"+id);
         jsKeyboard.show();
     }
     var isCleaned = false;
     function clean(t) {
         if (!isCleaned) {
             $(t).text("");
             isCleaned = true;
         }
     }
     var initText = "click to here to start writing...";
     function send() {
         if ( $("#txtContent").val() != initText && $("#txtContent").val().length > 0) {
             $("#requestForm").css("display", "none");
             window.setTimeout('$("#feedback").html("Your request has been processing. Please wait...").css("display","block");', 100);
             window.setTimeout('$("#feedback").html("Your request has been sent. You will see request form in 5 seconds").css("display","block");', 2000);
             window.setTimeout('showRequestForm()', 7000);
         }
         else {
             $("#feedback").html("Please write your request...").css("display","block");
         }
     }

     function showRequestForm() {
         $("#requestForm").css("display", "block");
         $("#feedback").css("display", "none");
         $("#feedback").html("");
     }
</script>