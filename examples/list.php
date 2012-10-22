<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sales Vu</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    
    // JavaScript Document
$(document).ready(function () {
	$('#search').keyup(function(event) {
		var search_text = $('#search').val();
		var rg = new RegExp(search_text,'i');
		$('#product_list .product-list .product').each(function(){
 			if($.trim($(this).html()).search(rg) == -1) {
				$(this).parent().parent().parent().parent().parent().css('display', 'none');
 				$(this).css('display', 'none');
				$(this).next().css('display', 'none');
				$(this).next().next().css('display', 'none');
			}	
			else {
				$(this).parent().parent().parent().parent().parent().css('display', '');
				$(this).css('display', '');
				$(this).next().css('display', '');
				$(this).next().next().css('display', '');
			}
		});
	});
});
 
$('#search_clear').click(function() {
	$('#search').val('');	
 
	$('#product_list .product-list .product').each(function(){
		$(this).parent().parent().parent().parent().parent().css('display', '');
		$(this).css('display', '');
		$(this).next().css('display', '');
		$(this).next().next().css('display', '');
	});
});
</script>
<style type="text/css">
	ul{
		list-style-type:none;
		width:1240px;
	}
	li {
		float:left;
		margin: 10px 10px 0 0;
		padding: 0 0 0 0;
		width:300px;
		-moz-border-radius: 3px;
		border-radius: 3px;
		-moz-box-shadow: 3px 3px 3px black;
		-webkit-box-shadow: 3px 3px 3px black;
		box-shadow: 3px 3px 3px black;
		-moz-user-select: -moz-none;
		-khtml-user-select: none;
		-webkit-user-select: none;
	}
	input {
		width: 70%;
		hight: 40px;
	}
	-
</style>
</head>
<body>
	
	<center>
	<input name="" type="text"  id="search" autocomplete="off" class="search-box-bg" />
	<div id="product_list">

		<div class="product-list">
			<ul>
				<? for($i=0; $i<100; $i++){
					echo '
						<li>
							<table ALIGN="left"><tr>
							<td><div ALIGN="left"><img src="mugshot.png" alt="mugshot"/><div></td>
							<td><div ALIGN="right" class="product">Test'. $i .'</div>
							<div ALIGN="right" class="price">'. $i .'</div></td>
							</tr></table>
						</li>';

				} ?>

			</ul>		
		</div>
	</div>
	</center>
</body>
</html>
