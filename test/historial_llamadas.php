<?php
ini_set("session.gc_maxlifetime", "1400000");
session_start();
//if(!session_is_registered(myusername)){
//header("location:index.php"); }

include 'php/dbconnect.php';
mysql_select_db("cdr", $con); // para server
mysql_query('SET NAMES UTF-8');

//$mes_log = '8';
//$anio_log = '2014';
$mes_log = date(n);
$anio_log = date(Y);

$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Instead - Senior Care</title>

    <!-- metas -->
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <!--/ metas -->

    <!-- styles -->
    <link rel="stylesheet" type="text/css" href="css/layerslider.css">
    <link rel="stylesheet" type="text/css" href="css/fullwidth/skin.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/color-purple.css">
    <link rel="stylesheet" type="text/css" href="tuner/css/styles.css">
    <!--/ styles -->

    <!--[if lt IE 9]>
    <script src="js/html5.js"></script><![endif]-->
</head>

<body>
<div class="page">


<!-- page header -->
<header class="page-header main-page">
    <!-- logo -->
    <section id="logo" class="logo">
        <div>
            <a href="index.php"><img src="img/purple/logo.gif" alt="Home Instead - Senior Care"></a>
        </div>
    </section>
    <!--/ logo -->

    <!-- main nav -->
    <nav class="main-nav">
        <ul>
            <li>
                <a href="index.php"><i class="fa fa-plus"></i>Inicio</a>
            </li>
            <li>
                <a href="staff.php"><i class="fa fa-plus"></i>Staff</a>
            </li>
            <li>
                <a href="pacientes.php"><i class="fa fa-plus"></i>Pacientes</a>
            </li>
            <li>
                <a href="turnos_activos.php"><i class="fa fa-plus"></i>Turnos</a>
            </li>
            <li>
                <a href="historial_monitoreo.php">
                    <i class="fa fa-plus"></i>Monitoreo
                </a>
            </li>
            <li>
                <a href="historial_llamadas.php" class="active">
                    <i class="fa fa-plus"></i>Historial CDR
                </a>
            </li>
        </ul>
    </nav>
    <!--/ main nav -->

    <!-- mobile nav -->
    <nav id="mobile-main-nav" class="mobile-main-nav">
        <i class="fa fa-bars"></i>
        <a href="#" class="opener">Navegar por sección</a>
        <ul>
            <li>
                <a href="404.html">Inicio</a>
            </li>
            <li>
                <a href="404.html">Staff</a>
            </li>
            <li>
                <a href="404.html">Pacientes</a>
            </li>
            <li>
                <a href="404.html">Turnos</a>
            </li>
            <li>
                <a href="404.html">Historial</a>
            </li>
        </ul>
    </nav>
    <!--/ mobile nav -->

</header>
<!--/ page header -->


<!-- page title -->
<section class="page-title">
    <div class="grid-row clearfix">
        <h1>Historial de Llamadas - CDR</h1>
    </div>
</section>
<!--/ page title -->


<main class="page-content">
<div class="grid-row">
<div class="grid-row">
<div class="grid-col grid-col-9">


<!-- tabs -->
<div class="widget-title">
    <? echo $meses[$mes_log - 1] ?>, <? echo $anio_log ?>
</div>
<div class="wpb_tour wpb_content_element">
<div class="wpb_tour_tabs_wrapper clearfix">
<ul class="wpb_tabs_nav clearfix" role="tablist">
    <li role="tab" aria-selected="true">
        <a href="#tab-normales">Detalle</a>
    </li>
    <li role="tab">
        <a href="#tab-incidencias">Mensajes de Buzón 1</a>
    </li>
    <li role="tab">
        <a href="#tab-incidencias2">Mensajes de Buzón 2</a>
    </li>
</ul>

<div id="tab-normales" class="wpb_tab">
    <div class="wpb_text_column wpb_content_element">
        <table>

            <?php
            $query = "SELECT
						      id ,
						      call_start_time,
						      call_end_time,
						      caller_id_number,
						      call_duration,
						      call_for

						      FROM call_detail

						      WHERE (access_number = '528185261009' OR access_number = '528185261014')
								  AND YEAR(call_start_time) = '" . $anio_log . "'
								  AND MONTH(call_start_time) = '" . $mes_log . "'
								  ORDER BY id DESC
								  LIMIT 0 , 10";
            $result = mysql_query($query) or die(mysql_error());
            while ($row = mysql_fetch_array($result)) {
                ?>


                <tr>
                    <td id="hide_this_td" style="width:20%">
                        <img src="img/IVR.png" width="107px" height="22px">
                    </td>
                    <td style="width:10%;">
                        <?php if ($row['call_for'] == "HI") { ?>
                        <div
                            style="background-color: #78399C; color: white; height: 22px; width: 80%; text-align: center; margin-top: -5px;">
                            <?php } else if ($row['call_for'] == "VID"){ ?>
                            <div
                                style="background-color: #22B14C; color: white; height: 22px; width: 80%; text-align: center; margin-top: -4px;">
                                <?php } else { ?>
                                <div style="height: 22px; width: 80%; text-align: center; margin-top: -5px;">
                                    <?php } ?>
                                    <?php echo $row['call_for']; ?>
                                </div>
                    </td>
                    <td style="width:30%">
                        <i class="fa fa-phone"></i> <? echo $row['caller_id_number'] ?><br><a href=""><i
                                class="fa fa-clock-o"></i> <? echo gmdate("H:i:s", $row['call_duration']); ?></a>
                    </td>
                    <td style="width:40%">
                        Inicio: <? echo $row['call_start_time'] ?> <br>Fin: &nbsp; &nbsp;
                        &nbsp; <? echo $row['call_end_time'] ?>
                    </td>
                </tr>
                <tr class="vc_text_separator">
                    <td>
                    </td>
                </tr>


            <?
            }
            ?>

        </table>
    </div>
</div>
<?php
$path = "/var/www/vhosts/solucionesdevoz.com.mx/httpdocs/homeinstead/voicemail/10000/";
$fp = popen("ls -t -1 --file-type " . $path, "r");

$path10001 = "/var/www/vhosts/solucionesdevoz.com.mx/httpdocs/homeinstead/voicemail/10001/";
$fp10001 = popen("ls -t -1 --file-type " . $path10001, "r");

$vm_file_list = array();
$i = 0;
while ($rec = fgets($fp)) {
    $vm_file_list[$i]['date'] = date('Y-m-d H:i:s', filectime($path . trim($rec)));
    $vm_file_list[$i]['file'] = trim("10000::" . $rec);
    $i++;
}

while ($rec10001 = fgets($fp10001)) {
    $vm_file_list[$i]['date'] = date('Y-m-d H:i:s', filectime($path10001 . trim($rec10001)));
    $vm_file_list[$i]['file'] = trim("10001::" . $rec10001);
    $i++;
}
foreach ($vm_file_list as $key => $row) {
    $date[$key] = $row['date'];
    //     $file[$key] = $row['file'];
}

// Sort the data with volume descending, edition ascending
// Add $vm_file_list as the last parameter, to sort by the common key
array_multisort($date, SORT_DESC, $vm_file_list);

$ua = getBrowser();
$browser = $ua['name'];
?>
<div id="tab-incidencias" class="wpb_tab">
    <div class="wpb_text_column wpb_content_element ">
        <table width="100%">
            <?php
            for ($i = 0; $i < count($vm_file_list); $i++) {
                $explode_vm_file_list = explode("::", $vm_file_list[$i]['file']);
                ?>
                <tr>
                    <td width="20%" style="text-align:center">
                        <?php
                        echo $vm_file_list[$i]['date'];
                        ?>
                    </td>

                    <td width="20%">
                        <?php if ($explode_vm_file_list[0] == '10000') { ?>
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
                        <?php
                        $filepath = "/homeinstead/voicemail/$explode_vm_file_list[0]/" . $explode_vm_file_list[1];
                        if ($browser != "Internet Explorer" && $ua['platform'] != "IPHONE" && $ua['platform'] != "IPAD") {
                            ?>
                            <audio controls preload="none" style="width: 100%;">
                                <source src='<?php echo $filepath; ?>' type="audio/wav">
                            </audio>
                        <?php } else { ?>

                            <a href=<? echo $filepath; ?>>Click To PLay</a>

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
    </div>
</div>
<?php
$path2 = "/var/www/vhosts/solucionesdevoz.com.mx/httpdocs/homeinstead/voicemail/20000/";
$fp2 = popen("ls -t -1 --file-type " . $path2, "r");

$path20001 = "/var/www/vhosts/solucionesdevoz.com.mx/httpdocs/homeinstead/voicemail/20001/";
$fp20001 = popen("ls -t -1 --file-type " . $path20001, "r");

$vm_file_list2 = array();
$j = 0;
while ($rec2 = fgets($fp2)) {
// 					    $vm_file_list2[] = trim($rec2);
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

<div id="tab-incidencias2" class="wpb_tab">
    <div class="wpb_text_column wpb_content_element ">
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
                        $filepath2 = "/homeinstead/voicemail/$explode_vm_file_list2[0]/" . $explode_vm_file_list2[1];
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
    </div>
</div>
</div>
</div>
<!--/ tabs -->
</div>
<div class="grid-col grid-col-3">
    <!-- archives -->
    <section class="widget widget-archives">
        <div class="widget-title">
            Archivo
        </div>
        <ul>

            <?php
            $query = "SELECT DISTINCT DATE_FORMAT( `call_start_time` , '%Y-%m' ) AS fecha_cdr
				      FROM `call_detail`
				      WHERE call_start_time > '2014-01-01 00:00:00'
				      ORDER BY `call_start_time` DESC
					  LIMIT 0 , 10";
            $result = mysql_query($query) or die(mysql_error());
            while ($row = mysql_fetch_array($result)) {

                $data = $row['fecha_cdr'];
                list($anio_archivo, $mes_archivo) = explode("-", $data);

                ?>

                <li>
                    <a href="historial_llamadasb.php?a=<? echo $anio_archivo ?>&m=<? echo $mes_archivo ?>">
                        <i class="fa fa-calendar"></i><? echo $meses[$mes_archivo - 1] ?> <? echo $anio_archivo ?>
                    </a>
                </li>

            <?
            }
            mysql_close($con);
            ?>

        </ul>
    </section>
    <!--/ archives -->

</div>
</div>
</div>
</main>


<!-- FOOTERS -->
<!-- page footer -->
<footer class="page-footer">
    <a href="#" id="top-link" class="top-link">
        <i class="fa fa-angle-double-up"></i>
    </a>
</footer>
<!--/ page footer -->

<!-- copyrights -->
<div class="copyrights">
    ©2014: Home Instead - Senior Care | Powered by Audioweb
</div>
<!--/ copyrights -->

</div>
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

?>

<!-- scripts -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.migrate.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="js/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/jquery.flot.categories.js"></script>
<script type="text/javascript" src="js/greensock.js"></script>
<script type="text/javascript" src="js/layerslider.transitions.js"></script>
<script type="text/javascript" src="js/layerslider.kreaturamedia.jquery.js"></script>

<!-- Superscrollorama -->
<script type="text/javascript" src="js/jquery.superscrollorama.js"></script>
<script type="text/javascript" src="js/TweenMax.min.js"></script>
<script type="text/javascript" src="js/TimelineMax.min.js"></script>
<!--/ Superscrollorama -->

<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.tabs.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-tabs-rotate.js"></script>
-->
<script type="text/javascript" src="js/jquery.ui.accordion.min.js"></script>
<script type="text/javascript" src="js/jquery.tweet.js"></script>
<!-- EASYPIECHART -->
<script type="text/javascript" src="js/jquery.easypiechart.js"></script>
<!--/ EASYPIECHART -->
<script type="text/javascript" src="js/scripts.js"></script>
<!--/ scripts -->

</body>
</html>
