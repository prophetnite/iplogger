<?php
ini_set('display_errors', 'on');
error_reporting(1);


log_display();

function log_display() {
echo '

                               <table class="table table-striped pull-left">
                                    <thead>
                                        <th></th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>IP</th>
                                        <th class="align-right">Tor Request</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
';
        $myfile = fopen("./logs/visitors.log", "r") or die("Unable to open file!");
        $i=0;
        while(!feof($myfile)) {
                        echo"             <tr>
                                            <td class='align-center'>
                                                
                                            </td>";
          $i++;
          $linex=fgets($myfile);
          list($date_post, $time_post, $ip_post, $tor_req) = split("\t", $linex);

          if ($tor_req == 1){
                $message = "<font color='red'>$tor_req - DETECTED</font>";
          }else {
                $message = "false - real ip";

          }

          echo "<td>$date_post</td>";
          echo "<td>$time_post</td>";
          echo "<td><a href='http://www.telize.com/geoip/$ip_post' target='_blank'>$ip_post</a></td>";
          echo "<td class='align-right'><span class='price'>
                        Is TOR:  
                        $tor_req $message

                </span></td>";

                            echo" <td class='align-right'><a href='#'>View</a> | <a href='#'>Delete</a></td>
                                        </tr>";
        }
        fclose($myfile);
echo '                                    </tbody>
                                </table>';


}

?>
