<?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$res = "[0m";
$red = "[1;31m";
$lime = "[1;32m";
$yellow = "[1;33m";
$turquoise = "[1;34m";
$black = "[0;30m";
$lightSkyBlue = "[1;35m";
$white = "[1;37m"; {
    $version = '1.0.0';
    if (file_exists("key.txt")) {
        $key = file_get_contents("key.txt");
    } else {
        echo $yellow . "Bn vui lng nhp API KEY  tip tc: $lime";
        $key = trim(fgets(STDIN));
        $file = @fopen('key.txt', 'w');
        fwrite($file, $key);
        fclose($file);
    }
    function gettime() {
        return date('Y/m/d - H:i:s', time());
    }
    function curl_get($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6');
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    function locDomain($data) {
        $parsedUrl = parse_url($data);
        return $parsedUrl['host'];
    }
    $checkKey = json_decode(curl_get("https://tuanjsc.xyz/api/Cron.php?token=$key"), true);
    if (isset($checkKey['status'])) {
        if ($checkKey['status'] != true) {
            echo $red . $checkKey['message'] . ' Ly token ti y: https://tuanori.com/Docs_api' . $green . "
$lime";
            echo "Nhp API KEY mi vo y  chy => ";
            $keyreplace = trim(fgets(STDIN));
            if ($keyreplace) {
                $file = @fopen('key.txt', 'w');
                fwrite($file, $keyreplace);
                fclose($file);
                echo "H thng  thay i key thnh cng. API KEY hin ti l: $red$keyreplace$lime
";
            } else {
                echo "Khng th  trng. Vui lng chy li d liu  thao tc li
";
            }
        } else {
            echo "in s 1: Nu bn dng  chy cron
in s 2:  kim tra phin bn tool hin ti
in s 3:  thay i API KEY hin ti
=>";
            $request = trim(fgets(STDIN));
            if ($request == 1) {
                echo "Xin cho $red" . $checkKey['username'] . "$lime  vo tool thnh cng.
";
                echo $white . "[  1 ][0;93mNhp link (ng dn) cron cn chy: $green";
                $link = trim(fgets(STDIN));
                $blockurl = locDomain($link);
                $urlblock = ['tuanori.com', 'www.tuanori.com', 'tuanori.vn', 'www.tuanori.vn', 'hosting2w.vn', 'www.hosting2w.vn', 'nhanthecao.vn', 'www.nhanthecao.vn', 'tuanjsc.xyz', 'www.tuanjsc.xyz', ];
                if (in_array($blockurl, $urlblock)) {
                    echo 'Url ny ca bn b cm. Bn nh ddos vo h thng TUANORI . Coi chng n BAND KEY nh.';
                    die();
                }
                echo $white . "[  2 ][0;93mNhp s ln mun chy: $green";
                $number = trim(fgets(STDIN));
                if (is_int($number)) {
                    echo 'S ln chy phi l s';
                }
                echo $white . "[  3 ][0;93mS giy cch mi ln chy: $green";
                $giay = trim(fgets(STDIN));
                $banner = "
[0;31m
|====================================================================================|
LU  S DNG:                                             
[]  CM S DNG VI MC CH TN CNG, CHNG PH.
[]  CM S DNG  DDOS CC WEBSITE CHNH PH, WEBSITE CHNH TR, X HI.
[]  C BIT: CM DDOS H THNG CA TUANORI => PHT HIN BAND KEY VNH VIN.
[] CC BN C TH TI TOOL TI [ YOUTUBE: TUN ORI IT ]                   
|==============================================================================================|
" . $lime;
                echo $banner;
                sleep(2);
                echo 'Lu : Nu bn s dng TOOL CRON ny vi mc ch tn cng d liu ca 1 s website no .' . "
" . 'M lin quan n php lut.' . "
" . 'H thng TUANORI.VN ca chng ti s hon ton KHNG chu trch nhim. ' . "
";
                sleep(2);
                echo "Nhn s 1: ng .
Nhp s 2: T chi
";
                echo $yellow . "Vui lng nhp cu tr li: $lime";
                $xacnhan = trim(fgets(STDIN));
                if ($xacnhan == '1') {
                    echo 'Ch h thng 5s  khi ng my ch li ....';
                    sleep(5);
                    echo "
|======================================|
";
                    for ($i = 1;$i <= $number;$i++) {
                        curl_get($link);
                        echo "H thng  chy cron ln th $red$i$lime vo lc " . gettime() . " 
";
                        if ($i == $number) {
                            echo $red . " chy thnh cng " . number_format($number) . " ln. Cm n bn  s dng dch v ti TUANORI.VN$lime";
                        } else {
                            sleep($giay);
                        }
                    }
                } else if ($xacnhan == '2') {
                    echo $yellow . 'Bn s b cm s dng TOOL nu nh bn khng ng ' . $lime;
                } else {
                    echo 'Bn ch c php chn 1 hoc 2. Khng th chn ' . $xacnhan;
                }
            } else if ($request == 2) {
                $data = curl_get("https://api.tuanori.vn/version.php?version=CRON");
                if ($version == $data) {
                    echo $red . 'Phin bn ca bn ang  phin bn mi nht' . $lime;
                } else {
                    echo "Phin bn ca bn hin l phin bn $red$version$lime. Phin bn mi nht l $red$data$lime. Ch 1 lt nh... 
";
                    sleep(2);
                    echo "in s 1:  cp nht phin bn mi nht
in s 2:  b qua, khng cp nht
=>";
                    $request = trim(fgets(STDIN));
                    if ($request == 1) {
                        $tenfile = explode('.', basename($_SERVER['PHP_SELF'])) [0];
                        if ($tenfile != 'cron1s') {
                            echo $red . "Bn vui lng i tn file hin ti ($tenfile.php) thnh tn file (cron1s.php)  tin hnh update d liu.$lime";
                        } else {
                            define('filename', 'update_' . rand(1111111, 999999) . '.zip');
                            define('serverfile', 'https://api.tuanori.vn/cron1s.zip');
                            file_put_contents(filename, file_get_contents(serverfile));
                            $file = filename;
                            $path = pathinfo(realpath($file), PATHINFO_DIRNAME);
                            $zip = new ZipArchive;
                            $res = $zip->open($file);
                            if ($res === TRUE) {
                                $zip->extractTo($path);
                                $zip->close();
                                unlink(filename);
                                $file = @fopen('Update.txt', 'a');
                                if ($file) {
                                    $data1 = "[UPDATE] Phin cp nht phin bn $data gn nht vo lc " . gettime() . "
";
                                    fwrite($file, $data1);
                                    fclose($file);
                                }
                                echo $red . " cp nht xong phin bn mi $data. Bn vui lng chy li file v tn hng ...." . $lime;
                            }
                        }
                    }
                }
            } else if ($request == 3) {
                echo "API KEY hin ti ca bn l: $red$key$lime
." . $yellow . "in API KEY mi vo y ( trng v nhn enter, s khng b thay i API KEY hin ti):
=>$lime";
                $newkey = trim(fgets(STDIN));
                if ($newkey) {
                    $file = @fopen('key.txt', 'w');
                    fwrite($file, $newkey);
                    fclose($file);
                    echo "H thng  thay i key thnh cng. API KEY hin ti l: $red$newkey$lime
Hy chy li chng trnh  s dng nh.";
                } else {
                    echo "Tt c d liu gi nguyn
";
                }
            } else {
                echo 'Bn ch c php chn 1 hoc 2. Khng th chn ' . $xacnhan;
            }
        }
    } else {
        echo $red . 'Hin ti cha th kim tra Token. Vui lng th li sau. Hoc lin h vi BQT TUANORI.VN  gii quyt' . $green;
    }
}
