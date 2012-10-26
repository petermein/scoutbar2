/**
 * @author Peter
 */

/*
 * Initialize localstorage, sessionStorage and WebSQL
 * 
 */
var db;

$(document).ready(function(){
	
	    try {
          if (!window.openDatabase) {
          		console.log('Opened existing websql db');
              error('not supported');
          } else {
          		console.log('Creating new websql db');
           	db = new Database({
           		name: 'shoppingcart',
           		description: 'Shopping cart for scoutbar',
           		 size: 1 * 1024 * 1024 // 1Mb
           	});
              // invoke the createTables function explained below
          }
      } catch(e) {
          // Error handling 
          error("Error creating the database");
      }
        
        database();
        
         });    
    
      function database(){
        db.query(
            'CREATE TABLE IF NOT EXISTS Cart(productid INTEGER NOT NULL PRIMARY KEY, productname TEXT NOT NULL, price FLOAT, amount INTEGER);', 
            {}, function(e){
            	truncatedb()
            });
       }
      
      
      function addproduct(id, name, price){
      	db.read('SELECT * FROM Cart WHERE productid=?', [id], function (results) {
   			var len =  results.length;
   			console.log("In db? :"+len);
   			if(len > 0){
   				db.query('UPDATE Cart SET amount = ? WHERE productid = ?',[ results.item(0).amount+1,  id ], function(e){ 
   					updateList();	
   				});
   			} else {
   				db.insert("Cart",[ id, name, price, 1], function(e){
   					updateList();
   				});
   			}
      });
		}
      
      
       function truncatedb(){
       db.truncate("Cart", function (e) {
    		if (e.type === "success") {
        			updateList();
        			clearSelect();
    		}
		});
      }
       
      




/* This is the data handler which would be null in case of table creation and record insertion */
   function nullDataHandler(transaction, results)   {
   }
   /* This is the error handler */
   function killTransaction(transaction, error) {
   	   		alert('Kill data' +error.message);
   }
      

/*
 * 
 * Error function 
 * Only use in extreme non functional failure
 * 
 * 
 */

function error(text){
	var error = '<div class="message-dialog bg-color-red" style="position:fixed; height:400" id="error"><p>'+ text +'</p></div>';
	$(error).insertAfter('body');	
	$(".modern-ui").addClass("blur");
	$('#dialog-close').click(function(){
		$(this).parent().remove();
	});
}

/*
 * 
 * Dialog function 
 * 
 * 
 * 
 */
function dialog(text, color){
	var error = '<div class="message-dialog bg-color-'+ color +'" style="position:fixed;" id="error"><p>'+ text +'</p><button id="dialog-close" class="place-right">Close</button></div>';

	$(error).insertAfter('body');	
	$('#dialog-close').click(function(){
		$(this).parent().remove();
	});
}
	

	
/*
 * 
 * Notification function
 * 
 */

  function notification(content, color){
  	var notification = '<div class="page-header-notification bg-color-'+ color +'" id="notification"><div class="page-header-notification-content">'+ content +'</div></div>';
			$(notification).insertAfter('.navigation-bar-inner');	
  				$('#notification').slideToggle('slow', function() {
  			}).delay(4000).slideToggle('slow', function(){
  				$(this).remove();
  			});
   }
   
  /*
   * Override for notification
   * 
   */
  
  
   (function($){

	$.confirm = function(params){

		var buttonHTML = '';
		$.each(params.buttons,function(name,obj){

			buttonHTML += '<button class="button place-right">'+name+'</button>';

			if(!obj.action){
				obj.action = function(){};
			}
		});

		var markup = [
			'<div class="message-dialog bg-color-'+ params.color +'" style="position:fixed;" id="error">',
			'<p>'+ params.message +'</p>',
			'<div id="confirmButtons">',
			buttonHTML,
			'</div></div></div>'
		].join('');

		$(markup).hide().appendTo('body').fadeIn();

		var buttons = $('#confirmButtons button'),
			i = 0;

		$.each(params.buttons,function(name,obj){
			buttons.eq(i++).click(function(){
				console.log('click');
				$.confirm.hide();
				return false;
			});
		});
	}

	$.confirm.hide = function(){
		$('.message-dialog').fadeOut(function(){
			$(this).remove();
		});
	}

})(jQuery);




