<?php
/*
sudo apt-get install php-pear
sudo pear install http://download.pear.php.net/package/Net_URL2-0.3.0.tgz
sudo pear install http://download.pear.php.net/package/HTTP_Request2-0.4.1.tgz
sudo pear install http://download.pear.php.net/package/Services_W3C_HTMLValidator-1.0.0RC2.tgz
*/
// PEAR Class for W3C Validator
require_once 'Services/W3C/HTMLValidator.php';

// Add data
require_once 'config.php';

$options = array('validator_uri' => VALIDATOR_WEBSERVER . '/check');

$validator = new Services_W3C_HTMLValidator($options);

$page = $_GET['url'];

$r = $validator->validate($page);

$errors   = count($r->errors);
$warnings = count($r->warnings);

if ($r->isValid()) {
  // Se è validata la pagina
  $status = 'valid';
} elseif ($errors == 0 && $warnings > 0) {
  // Se non è validata la pagina
  $status = 'warning';
} elseif ($errors > 0) {
  // Se non è validata la pagina
  $status = 'error';
} elseif($errors == 0  || $warnings == 0) {
  $status = 'unaviable';
  $page .= '&No200=1';
}

header('Content-Type: application/javascript');
print 
'{
  "status"  : "' . $status . '",
  "error"   : "' . $errors . '",
  "warning" : "' . $warnings . '",
  "url"     : "' . VALIDATOR_WEBSERVER . '/check?uri=' . $page . '"
 }';
