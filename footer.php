<script language="javascript">
	$('#echoField').focus(function(){
				console.log('focus');

	$('#footer').animate({
		bottom:0
		},400);
	});
</script>
<div class="bar">
    <div class="bar-inner bg-color-darken" id="footer" style=" position:fixed; width:940px; bottom:-270px; padding:10px">
        <div class="input-control text" style="width=10% padding: 10px 10px 5px;">
        	<input type="text" id="echoField" />
        	<span class="helper"></span>
           
        </div> 
        <div style="padding:0">
			<? include("keyboard.php"); ?>
        </div>
    </div>
</div> 
