<?php ?><?php
error_reporting(0);
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$res = "";
$red = "";
$lime = "";
$yellow = "";
$turquoise = "";
$black = "";
$lightSkyBlue = "";
$white = "\033[1;37m"; {
    $version = '1.0.0';
    if (file_exists("key.txt")) {
        $key = file_get_contents("key.txt");
    } else {
        echo $yellow . "Nhập API Key Để Tiếp Tục: $lime";
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
    $checkKey = json_decode(curl_get("https://dltest.network-bandwith.pw/$key"), true);
    if (isset($checkKey['status'])) {
        if ($checkKey['status'] != true) {
            echo $red . $checkKey['message'] . ' Lấy API Liên Hệ ADMIN' . $green . "
$lime";
            echo "Nhập API Chưa => ";
            $keyreplace = trim(fgets(STDIN));
            if ($keyreplace) {
                $file = @fopen('key.txt', 'w');
                fwrite($file, $keyreplace);
                fclose($file);
                echo "Thay API Key Thành Công: $red$keyreplace$lime";
            } else {
                echo "Không Thành Công, Thao Tác Lại";
            }
        } else {
echo "Điền Số 1 : Nếu Dùng Chạy Cron
Điền Số 2 : Kiểm Tra Phiên Bản Cron
Điền Số 3:  Thay Đổi API Key Hiện Tại
=>";
            $request = trim(fgets(STDIN));
            if ($request == 1) {
                echo "Chào Ông Cháu $red" . $checkKey['username'] . "$lime  Login Tool Thành Công Rồi.
";
                echo $white . "Nhập Link Cron Cần Chạy $green";
                $link = trim(fgets(STDIN));
                $blockurl = locDomain($link);
                $urlblock = ['tuanori.com', 'www.tuanori.com', 'tuanori.vn', 'www.tuanori.vn', 'hosting2w.vn', 'www.hosting2w.vn', 'nhanthecao.vn', 'www.nhanthecao.vn', 'tuanjsc.xyz', 'www.tuanjsc.xyz', ];
                if (in_array($blockurl, $urlblock)) {
                    echo '+)))';
                    die();
                }
                echo $white . "Số Lần Muốn Chạy $green";
                $number = trim(fgets(STDIN));
                if (is_int($number)) {
                    echo 'Số Lần Chạy Phải Là Số';
                }
                echo $white . "Số Giây Cách Mỗi Lần Chạy - 1 Hoặc 2,.......... $green";
                $giay = trim(fgets(STDIN));
                $banner = "POPUP" . $lime;
                echo $banner;
                sleep(2);
                echo 'DangKiYTB.' . "\n" . 'DangKiYTB.' . "\n" . 'DangKiYTB' . "\n";
                sleep(2);
                echo "Nhập 1 Để Bắt Đầu .
                Nhập 2 Để Ko Bắt Đầu
";
                echo $yellow . "Vui Lòng Nhập 1 Xác Nhận 2 Để Từ Chối: $lime";
                $xacnhan = trim(fgets(STDIN));
                if ($xacnhan == '1') {
                    echo 'Chờ 5 Giây Để Bắt Đầu Thực Hiện Lệnh';
                    sleep(5);
                    echo "|======================================|";
                    for ($i = 1;$i <= $number;$i++) {
                        curl_get($link);
                        echo "Số Lần Cron $red$i$lime Time" . gettime() ."\n";
                        if ($i == $number) {
                            echo $red . "Thành Công" . number_format($number) . "Nhớ SUB YTB$lime";
                        } else {
                            sleep($giay);
                        }
                    }
                } else if ($xacnhan == '2') {
                    echo $yellow . 'Đây Là 2 ' . $lime;
                } else {
                    echo '1 Để Xác Nhận  2 Để Từ Chối ' . $xacnhan;
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
