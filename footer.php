<div class="bar">
    <div class="bar-inner bg-color-grayDark" id="footer" style=" position:fixed; width:940px; bottom:-270px; padding:10px">
        <div class="input-control text" style="width=10% padding: 10px 10px 5px;">
        	<input type="text" id="search" />
        	<span class="helper"></span>
           
        </div> 
        <div style="padding:0">
			<?php include("keyboard.php"); ?>
        </div>
    </div>
</div> 
<script>
	$('#search').focus(function(){
		$('#footer').animate({
		bottom:0
		},400);
	});
	$('#search').keypress(function(e) {
    	if(e.which == 13) {
       	 	defocus();
    	}
	});

	function defocus(){
		$("#search").blur();
		$('#footer').animate({
		bottom:-270
		},400);
	};
</script>