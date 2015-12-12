<?php
ini_set('display_errors', 'on');  // disable for production!!!!!!!
error_reporting(E_ALL);

// ================================================================
use Dapphp\TorUtils\TorDNSEL;
include './TorUtils/src/TorDNSEL.php';

if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
  $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
}

// =================================================================

try {
    $isTor = TorDNSEL::IpPort(
        //$_SERVER['SERVER_ADDR'],
        '8.8.8.8',
        $_SERVER['SERVER_PORT'],
        $_SERVER['REMOTE_ADDR']
    );
    //var_dump($isTor);
    if ($isTor) {echo "<br/>Is TOR Exit Node: " . $isTor . " -- TOR DETECTED!";}
} catch (\Exception $ex) {
    echo $ex->getMessage() . "\n";
}
echo '<br/>';

// =================================================================
	
//$wifiap_clean=$_POST["wifiap_list"];
$line = date('Y-m-d') . "\t" . date('H:i:s') . "\t" . "$_SERVER[REMOTE_ADDR]" . "\t" . "$isTor";
file_put_contents('logs/visitors.log', $line . PHP_EOL, FILE_APPEND);


echo "NSA tracking Database: Thanks for reporting in!";
//echo "Is TOR Exit Node: " . IsTorExitPoint;

?>
