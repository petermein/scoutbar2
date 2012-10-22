/**
 * @author Peter
 */

function error(text){
	var error = '<div class="error-bar" style="position:fixed;" id="error">'+ text +'  <button><i class="icon-swap-up right"></i>Close</button></div>';
	
	$(error).insertAfter('body');
	var contentHeight = $('#error').height();
	$('#error').css('top', -contentHeight);
	$('#error').animate({
                    top:0
                },400,function() {
                    animating = false;
                    hidden = false;
                    $('#footer .handle a').html("Close");
   });
	
}
