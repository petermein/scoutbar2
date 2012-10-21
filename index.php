<?php

require_once 'config/config.inc.php';
require_once DOC_ROOT.CLASS_DIR.'database.class.php';
require_once DOC_ROOT.CLASS_DIR.'user.lib.php';
require_once DOC_ROOT.CLASS_DIR.'product.lib.php';

$user = USER::byId(1);
$user->toString();
echo $user->photo();

$product = PRODUCT::byId(1);
$product->toString();
echo $product->photo();
?>
