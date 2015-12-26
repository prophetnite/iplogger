<?php
ini_set('display_errors', 'on');  // DISABLE IN PRODUCTION ENVIRONMENT
error_reporting(E_ALL);

use Dapphp\TorUtils\TorDNSEL;
include './TorUtils/src/TorDNSEL.php';

$ACCESS_TOKEN = false;  // bool FALSE or string PASSWORD/TOKEN
$MESSAGE_DENIED = "Are you sure your supposed to be here?";  // MESSAGE FOR USERS LOGGING WHO ARE NOT AUTHORIZED
!isset($_POST['ACCESS_TOKEN']) ? $_POST['ACCESS_TOKEN'] = 0:0;

// ================================================================
if ($_POST['ACCESS_TOKEN'] === $ACCESS_TOKEN || !$ACCESS_TOKEN) {    // ACCESS GRANTED FOR LOGGING
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
    $line = date('Y-m-d') . "\t" . date('H:i:s') . "\t" . "$_SERVER[REMOTE_ADDR]" . "\t" . "$isTor";
    file_put_contents('logs/visitors.log', $line . PHP_EOL, FILE_APPEND);

    echo "NSA tracking Database: Thanks for reporting in!";
    //echo "Is TOR Exit Node: " . IsTorExitPoint;

} else {    // ACCESS DENIED FOR LOGGING
    echo $MESSAGE_DENIED;
}
?>


