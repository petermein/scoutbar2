<body class="modern-ui">
    <div class="page secondary">
        <?php include("header.php")
        ?>

        <script>
			$(document).ready(function() {
				$('.tile.product').click(function() {
					$(this).addClass('selected');
					var i = $(this).find('.count').html();
					i++;
					var count = $(this).find('.count').html(i);
					$(this).find('.count').show();
					var id = $(this).find(':input[name=id]').val();
					var url = ".//api/api.php?request=product&id=" + id;
					$.getJSON(url, function(data) {
						addproduct(data.product_id, data.name, data.price, 1);
					})
					$('#footer').animate({
						bottom:0
					},400);
				});

				$('#knop1').click(function() {
					truncatedb();
				});

				// set up click/tap panels
				$('.hover').toggle(function() {
					$(this).addClass('flip');
				}, function() {
					$(this).removeClass('flip');
				});

			});

			function clearSelect() {
				$('.tile.selected').each(function() {
					$(this).removeClass('selected');
					$(this).find('.count').html(0);
					$(this).find('.count').hide();
					$('#footer').animate({
						bottom:-75
					},400);
				})
			}

			function updateList() {
				$('#pricelist').html('');
				var total = 0;
				db.read('SELECT * FROM Cart', [], function(e) {
					for (var i = 0; i < e.length; i++) {
						var price = e.item(i).amount * e.item(i).price;
						var row = '<div class="brand-row"><p class="name">' + e.item(i).productname + '</p><p class="badge">' + price + '</p></div>';
						total = total + price;
						$('#pricelist').append(row);
					}
					var row = '<div class="brand"><p class="name">Total</p><p class="badge">' + total + '</p></div>';
					$('#pricelist').append(row);
				});
			}
        </script>
        <div class="page-header">
            <div class="page-header-content bg">
                <a href="index.php" class="back-button big page-back"></a>
                <h1> Producten <small>streeplijst</small></h1>
            </div>
        </div>
        <div class="page-region">
            <div class="page-region-content">
                <div class="grid">
                    <div class="row">
                        <?PHP
						$user = USER::byId($_GET['user_id']);
						echo $user -> productPhoto();
                        ?>
                        <div class="tile bg-color-green">
                            <div class="icon-set">
                                <div class="tile-block bg-color-green" style="border-bottom: 1px #fff solid; border-right: 1px #fff solid;" id="knop1">
                                    <div class="icon-Close white" style="margin: 12px"></div>
                                </div>
                                <div class="tile-block bg-color-green" style="border-bottom: 1px #fff solid; border-left: 1px #fff solid;">
                                    <div class="icon-Login3 white" style="margin: 12px"></div>
                                </div>
                                <div class="tile-block bg-color-green" style="border-top: 1px #fff solid; border-right: 1px #fff solid;">
                                    <div class="icon-Add white" style="margin: 12px"></div>
                                </div>
                                <div class="tile-block bg-color-green" style="border-top: 1px #fff solid; border-left: 1px #fff solid;">
                                    <div class="icon-Negative white" style="margin: 12px"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <?PHP
	$first = true;
	$category = CATEGORY::all('', true);
	foreach ($category as $cat) {
		echo '<div class="row">';
		echo '<div class="span8" style="margin-right: 0px; width:640px;">';
		$products = PRODUCT::byCategory($cat -> Category_id);
		$i = 0;
		foreach ($products as $product) {
			echo $product -> photo(true);
			$i++;
			$color = CATEGORY::byId($product -> categorie) -> color;
		}
		for ($j = ($i % 4 == 0 ? 0 : 4 - $i % 4); $j == 0, $j--; ) {
			echo "<div class=\"tile bg-color-" . $color . "\">

</div>";
		}
		echo '</div>';
		if ($first) {
			echo '<div class="span2">';
			echo '<div class="hover panel">';
			echo '<div id="pricelist" class="tile front double-vertical bg-color-yellow"> </div>';
			echo '<div class="tile back double-vertical bg-color-green"> </div>';
			echo '</div>';
			echo '</div>';
			$first = false;
		}
		echo '</div>';
	}
                        ?>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div id="streep" class="bar">
                        <div class="bar-inner bg-color-grayDark" id="footer" style=" position:fixed; width:940px; bottom:-75px; padding:10px">
                            <div class="input-control text" style="width=10% padding: 10px 10px 5px;">
                               	<button class="button center" style="width: 100%">Streep</button>
                            </div>
                        </div>
                    </div>
                </div>
</body>
