<?php

/********
 * De DOC_ROOT en WEB_ROOT worden dynamisch bepaald zodat we dit niet hoeven aan te passen als
 * we een site verhuizen. Mocht dit niet op elke server werken dan kan de oude methode ge-uncomment
 * worden:
 *
 * define('DOC_ROOT',realpath($_SERVER['DOCUMENT_ROOT']).'/');
 * define('WEB_ROOT','/');
 ********/

// Dynamisch DOC_ROOT en WEB_ROOT bepalen (zodat we dit niet meer per site hoeven te configureren)
define('SERVER_DOC_ROOT', realpath($_SERVER['DOCUMENT_ROOT']));

// Bepaal de doc_root door de laatste 7 karakters (system/) uit __FILE__ te filteren
// Dit is mogelijk omdat we altijd zeker weten dat dit bestand in de system map staat
define('DOC_ROOT',substr(realpath(dirname(__FILE__)), 0, -6));

// Bepaal de web_root door de server_doc_root van doc_root af te trekken aan het begin
define('WEB_ROOT',str_replace('\\', '/', substr(DOC_ROOT, strlen(SERVER_DOC_ROOT))));

// aantal vaste directories definieren
define('SYSTEM_DIR','system/');
define('CLASS_DIR','classes/');
define('CONFIG_DIR','config/');
define('JAVASCRIPT_DIR','javascript/');
define('STYLE_DIR','css/');
define('MEDIA_DIR','media/');
define('IMAGE_DIR',MEDIA_DIR.'images/');
define('BANNER_DIR',MEDIA_DIR.'banners/');

define('CHARSET','utf-8');
define('ENCODING',CHARSET);

// locale instellen, zodat nummers en data op de juiste manier geformateerd worden
setlocale(LC_ALL, 'nl_NL.UTF-8');
date_default_timezone_set('Europe/Amsterdam');

require DOC_ROOT.SYSTEM_DIR."functions.inc.php";
require DOC_ROOT.SYSTEM_DIR."interfaces.inc.php";


?>
