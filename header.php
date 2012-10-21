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
    })
</script>

<div style="display: none; position: fixed; height: 100px; width: 100px; padding: 10px; z-index: 10000;" class="bottom-right bg-color-darken fg-color-white">
    Screen size:
    <div id="sizeX">0</div>
    <div id="sizeY">0</div>
</div>

<div class="navigation-bar">
        <div class="navigation-bar-inner">
            <div class="brand">
                <span class="name">Project Name</span>
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
                        <li><a href="user.php">User</a></li>
                        <li><a href="#">Config</a></li>
                    </ul>
                </li>
                <li data-role="dropdown" class="sub-menu">
                    <a href="#">Extra's</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">SubItem</a></li>
                        <li><a href="#">SubItem</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

<script src="js/dropdown.js"></script>
