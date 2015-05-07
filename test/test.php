<audio controls>
    <source src="voicemail/10000/msg_0770f99a-a897-11e4-a46a-b74370fb1d23.wav" type="audio/wav">
    Your browser does not support the audio element
</audio>

<?php


$path2 = "/var/www/html/homeinsted/voicemail/20000/";
$fp2 = popen("ls -t -1 --file-type " . $path2, "r");

$path20001 = "//var/www/html/homeinsted/voicemail/20001/";
$fp20001 = popen("ls -t -1 --file-type " . $path20001, "r");

$vm_file_list2 = array();
$j = 0;
while ($rec2 = fgets($fp2)) {
    $vm_file_list2[$j]['date'] = date('Y-m-d H:i:s', filectime($path2 . trim($rec2)));
    $vm_file_list2[$j]['file'] = trim("20000::" . $rec2);
    $j++;
}

$vm_file_list20001 = array();
while ($rec20001 = fgets($fp20001)) {
// 					    $vm_file_list20001[] = trim($rec20001);
    $vm_file_list2[$j]['date'] = date('Y-m-d H:i:s', filectime($path20001 . trim($rec20001)));
    $vm_file_list2[$j]['file'] = trim("20001::" . $rec20001);
    $j++;
}

foreach ($vm_file_list2 as $key => $row) {
    $date2[$key] = $row['date'];
    //     $file[$key] = $row['file'];
}

// Sort the data with volume descending, edition ascending
// Add $vm_file_list as the last parameter, to sort by the common key
array_multisort($date2, SORT_DESC, $vm_file_list2);

$ua = getBrowser();
$browser = $ua['name'];

?>
<table width="100%">
    <?php
    for ($i = 0; $i < count($vm_file_list2); $i++) {
        $explode_vm_file_list2 = explode("::", $vm_file_list2[$i]['file']);
        ?>
        <tr>
            <td width="20%" style="text-align:center">
                <?php //echo date('Y-m-d H:i:s',filectime($path2.$vm_file_list2[$i]));?>
                <?php echo $vm_file_list2[$i]['date']; ?>
            </td>

            <td width="20%">
                <?php if ($explode_vm_file_list2[0] == '20000') { ?>
                    <div
                        style="background-color: #78399C; color: white; height: 22px; width: 80%; text-align: center; margin-top: -5px;">
                        HI
                    </div>
                <?php } else { ?>
                    <div
                        style="background-color: #22B14C; color: white; height: 22px; width: 80%; text-align: center; margin-top: -5px;">
                        VID
                    </div>
                <?php } ?>
            </td>
            <td style="vertical-align:none !important;" width="50%" style="text-align:center">
                <!-- 							    <img src="img/rec.png"> -->
                <?php
                // 								$filepath2="/homeinstead/voicemail/20000/".$vm_file_list2[$i];
                $filepath2 = "voicemail/$explode_vm_file_list2[0]/" . $explode_vm_file_list2[1];
                if ($browser != "Internet Explorer" && $ua['platform'] != "IPHONE" && $ua['platform'] != "IPAD") {
                    ?>
                    <audio controls preload="none" style="width: 100%;">
                        <source src='<?php echo $filepath2; ?>' type="audio/wav">
                    </audio>
                <?php } else { ?>

                    <a href=<? echo $filepath2; ?>>Click To PLay</a>

                <?php } ?>
            </td>
        </tr>
        <tr class="vc_text_separator">
            <td>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<?php
function getBrowser()
{
$u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    //Detect special conditions devices
    $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
    $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");

    //do something with this information
    if ($iPhone) {
        $platform = 'IPHONE';
    } elseif ($iPad) {
        $platform = 'IPAD';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    } else {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }

    return array(
        'platform' => $platform,
        'name' => $bname,
    );
}
