<script type="text/javascript">
    function getWindowsSize(){
        $("#sizeX").html('W: '+$(window).width());
        $("#sizeY").html('H: '+$(window).height());
    }
    
    $(function(){
        getWindowsSize();
        $(window).resize(function(){
            getWindowsSize()
        });
    });
    
    $(document).ready(function(){
    	    $('.navigation-icons-cogweel').click(function(){
    	    	if($(this).hasClass("bg-color-red")){ $(this).removeClass("bg-color-red") }
    	    	else { $(this).addClass("bg-color-red") }
  				$('#settings').slideToggle('slow', function() {});
  		
  					
  				
  		});
	});
</script>

<div style="position: fixed; height: 100px; width: 100px; padding: 10px; z-index: 10000;" class="bottom-right bg-color-darken fg-color-white">
    Screen size:
    <div id="sizeX">0</div>
    <div id="sizeY">0</div>
</div>

<div class="navigation-bar">
        <div class="navigation-bar-inner">
            <div class="brand">
                <span class="name">
                Scoutbar
                <sup class="fg-color-yellow tertiary-info-secondary-text"> v 0.1.0</sup>
                </span>
            </div>
 			<div class="navigation-icons-cogweel">
 				<img id="cogweel" alt="Instellingen" src="./media/images/default/cogwheel.png" /></a>
           </div>
            <ul class="place-right">
            	
                <li data-role="dropdown" class="sub-menu">
                    <a>Filters</a>
                    <ul class="dropdown-menu place-right">
                        <li class="check"><a href="#">Ouderenstam</a></li>
                        <li><a href="#">Leiding</a></li>
                    </ul>
                </li>
                
            </ul>
 
            <ul>
                <li>
                    <a href="index.php">Streeplijst</a>
                </li>
                <li data-role="dropdown" class="sub-menu">
                    <a href="#">Options</a>
                    <ul class="dropdown-menu">
                        <li><a href="index.php?page=poduct&amp;user_id=16">User</a></li>
                        <li><a href="#" onclick="MassaStreep()">ProductList</a></li>
                    </ul>
                </li>
                <li data-role="dropdown" class="sub-menu">
                    <a href="#">Extra's</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">MassaStreep</a></li>
                        <li><a href="#">SubItem</a></li>
                    </ul>
                </li>
                
            </ul>
            
        </div>
        
     <div class="page-header-notification bg-color-red" id="settings"> 
    	<div class="page-header-notification-content ">
    	</div>
    </div>  
  </div>
<?PHP
echo '<script src="'. JAVASCRIPT_DIR.'dropdown.js"></script>';
?>
