<!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>404 NOT FOUND</title>
  <link rel="icon" href="https://raw.githubusercontent.com/shanmiru/css-for-xiao/main/assets/img/icon.png" type="image/x-icon">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="https://shanmiru.github.io/css-for-xiao/assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="https://shanmiru.github.io/css-for-xiao/assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="https://shanmiru.github.io/css-for-xiao/assets/demo/demo.css" rel="stylesheet" />
  </head> 
  <body>
<div class="wrapper">
    <div class="main-panel">
      <div class="content">
          <?php

if(isset($_POST['display'])){

$messagetosend = $_POST['messagetouser'];

$messagetosend = '<a href="'.$messagetosend.'" target="_blank">Link?</a>';
file_put_contents('display.txt',$messagetosend);
}

echo file_get_contents('display.txt');
?>
<!----
      <h1 class="display-3 text-white">V3 Captcha</h1>
          <form method="post">
<input name="inviname" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="File Name(unnecessary)">
<br>
<input name="anchor_link" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="anchor?ar=1&k=">
<br>
<input name="anchor_ref" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="anchor referer link">
<br>
<input name="k" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="anchor $k = ">
<br>
<input name="co" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="anchor $co = ">
<br>
<input name="v" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="anchor $v = ">
<br>
<input name="reload_link" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="reload?k=">
<br>
<input name="chr" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="reload?k like: [21,71,92]">
<br>
<input name="bg" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="after above starts with ! and ends with * (Exclude *)">
<br>
<input name="vh" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="(Sometimes - sign is also included in number, you have to take that - sign also)">
<?php
if(isset($_POST['test-captcha'])){
    $anchor_l = trim($_POST['anchor_link']);
    $anchor_r = trim($_POST['anchor_ref']);
    $reload_l = trim($_POST['reload_link']);
    $v = trim($_POST['v']);
    $k = trim($_POST['k']);
    $co = trim($_POST['co']);
    $chr = trim($_POST['chr']);
    $bg = trim($_POST['bg']);
    $vh = trim($_POST['vh']);
    //====(CAPTCHA)
$anchor_link = $anchor_l; // It looks like: anchor?ar=1&k=
$anchor_ref  = $anchor_r; // Open Anchor Headers and see the referer link
//====(REALOD)
$reload_link = $reload_l; // It looks like: reload?k=
$v   = $v;  // Available in Anchor Query String Parameters
$k   = $k;  // Available in Anchor Query String Parameters
$co  = $co;  // Available in Anchor Query String Parameters
$chr = urlencode($chr);  // Available in Reload's Request Payload (Post Field) and looks like: [21,71,92]
$bg  = $bg;  // Available in Reload's Request Payload and is after the $chr and it starts from ! and ends with * (Exclude *)
$vh  = $vh;  // Available in Reload's Request Payload and is after the $bg and select only the number (Sometimes - sign is also included in number, you have to take that - sign also)
//////////////////=================[1st Req]=================//////////////////

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $anchor_link);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: www.google.com',
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
'accept-language: en-US,en;q=0.9',
'referer: '.$anchor_ref.'',
'sec-fetch-dest: iframe',
'sec-fetch-mode: navigate',
'sec-fetch-site: cross-site',
'upgrade-insecure-requests: 1',
'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);

$rtk = xiao($result, '<input type="hidden" id="recaptcha-token" value="', '"');

//////////////////=================[2nd Req]=================//////////////////

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $reload_link);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'authority: www.google.com',
'accept: */*',
'accept-language: en-US,en;q=0.9',
'content-type: application/x-www-form-urlencoded',
'origin: https://www.google.com',
'referer: '.$anchor_link.'',
'user-agent: Mozilla/5.0 (Windows NT '.rand(11,99).'.0; Win64; x64) AppleWebKit/'.rand(111,999).'.'.rand(11,99).' (KHTML, like Gecko) Chrome/'.rand(11,99).'.0.'.rand(1111,9999).'.'.rand(111,999).' Safari/'.rand(111,999).'.'.rand(11,99).''));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'v='.$v.'&reason=q&c='.$rtk.'&k='.$k.'&co='.$co.'&hl=en&size=invisible&chr='.$chr.'&vh='.$vh.'&bg='.$bg.'');
$result = curl_exec($ch);
curl_close($ch);

$rresp = xiao($result, '["rresp","', '"');
if (strpos($result, '"rresp","')){
$error = "✅ Captcha Bypassed Successfully";
}else{
$error = "❌ ERROR PLEASE FIX";
}
}
if($error){
     echo "<span class='text-white'>$error</span><br>";
            }
               ?>
<button name="send-invisible" class="btn btn-success text-white">SEND</button>
<button name="test-captcha" class="btn btn-success text-white">TEST</button>
           </form>
           <br>
           <br>
           --->
        <h1 class="display-3 text-white">CurlX Helper</h1>
          <form method="post">
<input name="phpfile" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="File Name(unnecessary)">
<br>
<input name="kill" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="url request ex:https://www.org.com">
<br>
<textarea rows="10" name="rheader" class="form-control margin: 0px; width: 594px; height: 167px;" placeholder="REQUEST HEADERS"></textarea> 
<br>
<div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckCookie" name="cookie" type="checkbox">
                      <label class="custom-control-label" for="customCheckCookie">
                        <span class="text-white">need cookie?</span>
                      </label>
                    </div>
                    
<br>
<div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckWebkit" name="webkit" type="checkbox">
                      <label class="custom-control-label" for="customCheckWebkit">
                        <span class="text-white">have webkit?</span>
                      </label>
                      </div>
<br>
<textarea rows="10" name="rpayload" class="form-control margin: 0px; width: 594px; height: 167px;" placeholder="REQUEST PAYLOAD"></textarea>
<br>
<textarea rows="10" name="vprasss" class="form-control margin: 0px; width: 594px; height: 167px; text-white" placeholder="UNNECESSARY (BULLSHIT)"></textarea>
<br>
<button name="send-curlx" class="btn btn-success text-white">SEND</button>
           </form>
           <br>
           <br>
        <h1 class="display-3 text-white">Curl Helper</h1>
          <form method="post">
<input name="phpfile" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="File Name(unnecessary)">
<br>
<input name="kill" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="url request ex:https://www.org.com">
<br>
<textarea rows="10" name="rheader" class="form-control margin: 0px; width: 594px; height: 167px;" placeholder="REQUEST HEADERS"></textarea> 
<br>
<div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckCookie" name="cookie" type="checkbox">
                      <label class="custom-control-label" for="customCheckCookie">
                        <span class="text-white">need cookie?</span>
                      </label>
                    </div>
                    
<br>
<div class="custom-control custom-control-alternative custom-checkbox">
                      <input class="custom-control-input" id="customCheckWebkit" name="webkit" type="checkbox">
                      <label class="custom-control-label" for="customCheckWebkit">
                        <span class="text-white">have webkit?</span>
                      </label>
                      </div>
<br>
<textarea rows="10" name="rpayload" class="form-control margin: 0px; width: 594px; height: 167px;" placeholder="REQUEST PAYLOAD"></textarea>
<br>
<textarea rows="10" name="vprasss" class="form-control margin: 0px; width: 594px; height: 167px; text-white" placeholder="UNNECESSARY (BULLSHIT)"></textarea>
<br>
<button name="send-curl" class="btn btn-success text-white">SEND</button>
<button name="view-at-index" class="btn btn-success text-white">TRANSFORM</button>
           </form>
           <br>
           <br>
        <h1 class="display-3 text-white">Index/Whatever</h1>
          <form method="post">
<textarea rows="10" name="index_res" class="form-control margin: 0px; width: 594px; height: 167px;" placeholder="site index here"></textarea>
<br>
<button name="send-index" class="btn btn-success text-white">SEND</button>
           </form>
           <br>
           <br>
        <h1 class="display-3 text-white">Message/link</h1>
          <form method="post">
<input name="messagetouser" type="text" class="form-control" style="border-color: #35c0dc;background: transparent;color: #fff" placeholder="Message or link.">
<br>
<button name="send-link-information" class="btn btn-success text-white">SEND</button>
<button name="display" class="btn btn-success text-white">Display</button>
           </form>
      </div>
      <?php
date_default_timezone_set('Japan');
$time = date('h:i:s', time());
$time = "-".$time;

function xiao($str, $starting_word, $ending_word){
$subtring_start  = strpos($str, $starting_word);

$subtring_start += strlen($starting_word);
$size            = strpos($str, $ending_word, $subtring_start) - $subtring_start;
return substr($str, $subtring_start, $size);
}

    // maximum execution time in seconds
$botToken = "1740995022:AAGrjNSTEsyM7ooUbyEAsHlPQD-K9SZQpL8";
$website = "https://api.telegram.org/bot".$botToken;
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$print = print_r($update);
$typeg = $update["message"]["chat"]["type"];
$chatId = $update["message"]["chat"]["id"];
$gId = $update["message"]["from"]["id"];
$userId = $update["message"]["from"]["id"];

$firstname = $update["message"]["from"]["first_name"];
if(empty($firstname)){
    $firstname = '(n/a)';
}
htmlentities($firstname);
#urlencode($firstname);
$lastname = $update["message"]["from"]["last_name"];
if (empty($lastname)){
$lastname = '(n/a)';
}
htmlentities($lastname);
#urlencode("$lastname"); 
$username = $update["message"]["from"]["username"];
if (empty($username)){
$username = '(n/a)';
} 
urlencode($username);
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];
$replymessage = $update["message"]["reply_to_message"]["text"];
$replyfirstname = $update["message"]["reply_to_message"]["from"]["first_name"];
if(empty($replyfirstname)){
    $replyfirstname = '(n/a)';
}
htmlentities($replyfirstname);
#urlencode($replyfirstname);
$replylastname = $update["message"]["reply_to_message"]["from"]["last_name"];
if(empty($replylastname)){
    $replylastname = '(n/a)';
}
htmlentities($replylastname);
#urlencode($replylastname);
$replyUserid = $update["message"]["reply_to_message"]["from"]["id"];
$replyusername = $update["message"]["reply_to_message"]["from"]["username"];
$upd = $update["callback_query"]["message"]["reply_to_message"]["message_id"];
if(empty($replyusername)){
    $replyusername = '(n/a)';
}
urlencode($replyusername);

$replymessage_id = $update["message"]["reply_to_message"]["message_id"];
$callbackdata = $update["callback_query"]["data"];
$chat_id = $update["callback_query"]["message"]["chat"]["id"];
$mid = $update["callback_query"]["message"]["message_id"];
$dato = $update["callback_query"]["date"];
$fid = $update["message"]["reply_to_message"]["document"]["file_id"];
$fidname = $update["message"]["reply_to_message"]["document"]["file_name"];

$tt = json_encode($update, JSON_PRETTY_PRINT);

if(isset($_POST['send-invisible'])){
    $name = trim($_POST['inviname']);
    if(empty($name)){
        $name = "invisble";
    }
    $fname = $name.$time.".txt";
    $anchor_l = $_POST['anchor_link'];
    $anchor_r = $_POST['anchor_ref'];
    $reload_l = $_POST['reload_link'];
    $v = $_POST['v'];
    $k = $_POST['k'];
    $co = $_POST['co'];
    $chr = $_POST['chr'];
    $bg = $_POST['bg'];
    $vh = $_POST['vh'];
$anchor_link = "\$anchor_link = '$anchor_l'; // It looks like: anchor?ar=1&k=";

$anchor_ref  = "\$anchor_ref  = '$anchor_r'; // Open Anchor Headers and see the referer link";

$reload_link = "//====(REALOD)\n\$reload_link = '$reload_l'; // It looks like: reload?k=";

$v = "\$v   = '$v';  // Available in Anchor Query String Parameters";

$k = "\$k   = '$k';  // Available in Anchor Query String Parameters";

$co = "\$co  = '$co';  // Available in Anchor Query String Parameters";

$chr = "\$chr = urlencode('$chr');  // Available in Reload's Request Payload (Post Field) and looks like: [21,71,92]";
$bg = "\$bg  = '$bg';  // Available in Reload's Request Payload and is after the \$chr and it starts from ! and ends with * (Exclude *)";
$vh = "\$vh  = '$vh';  // Available in Reload's Request Payload and is after the \$bg and select only the number (Sometimes - sign is also included in number, you have to take that - sign also)";
$rest = file_get_contents('restinvisble.txt');
$file = fwrite(fopen($fname, 'a'), "//====(CAPTCHA)\n\n$anchor_link\n$anchor_ref\n\n$reload_link\n$v\n$k\n$co\n$chr\n$bg\n$vh\n\n$rest");
fclose($file);


lipad($botToken,$fname);
}
if(isset($_POST['send-curl'])){
    $rpayload = $_POST['rpayload'];
    $rpayload = str_replace(array("314 alden ave", "314 Alden Ave"),"'.\$street.'",$rpayload);
    $rpayload = str_replace(array("rohnert park", "Rohnert Park", "Rohnert park", "rohnert Park"),"'.\$city.'",$rpayload);
    $rpayload = str_replace(array("94928", "94928-3742"),"'.\$zip.'",$rpayload);
    $rpayload = str_replace(array("\"xiao\"", "\"Xiao\""),"\"'.\$name.'\"",$rpayload);
    $rpayload = str_replace(array("\"Tempest\"", "\"tempest\""),"\"'.\$lname.'\"",$rpayload);
    $kill = trim($_POST['kill']);
    $need = $_POST['rheader'];
    $find = $_POST['rheader'];
    if(strpos($find, 'POST')){
        $meth = '1';
    }else{
        $meth = '0';
    }
    if(strpos($find, 'Content-Length')){
        $meth = '1';
    }
    if($rpayload){
        $meth = '1';
    }
    if(isset($_POST['cookie'])){
    $limebreak = file_get_contents('br.txt'); 
    }else{
    $limebreak = "\n";
    }
    if(isset($_POST['webkit'])){
$key = xiao($rpayload, '------WebKitFormBoundary', '
Content-Disposition:');
$rpayload = str_replace("
------WebKitFormBoundary".$key."
Content-Disposition: form-data; name=\"", "&", $rpayload);
$rpayload = str_replace("------WebKitFormBoundary".$key."
Content-Disposition: form-data; name=\"", "", $rpayload);
$rpayload = str_replace("
------WebKitFormBoundary".$key."--", "", $rpayload);
$rpayload = str_replace("\"

", "=", $rpayload);
    }

if(isset($_POST['vprasss'])){
    $more_data = "/*  ".$_POST['vprasss']."  */";
}
    if(strpos($need, 'WebKitFormBoundary')){
 $need = str_replace(array("Content-Type: multipart/form-data; boundary=----WebKitFormBoundary".$key,"content-type: multipart/form-data; boundary=----WebKitFormBoundary".$key), "content-type: application/x-www-form-urlencoded; charset=UTF-8", $need);
    }
    $need = str_replace(":authority:","authority:",$need);
    $need = str_replace(":path:","path:",$need);
    $need = str_replace('"','\"',$need);
    $need = str_replace("
:method: POST","",$need);
    $need = str_replace("
:method: GET","",$need);
    $need = str_replace(":scheme:","scheme:",$need);
    $need = str_replace("
Accept-Encoding: gzip, deflate, br","",$need);
    $need = str_replace("
accept-encoding: gzip, deflate, br","",$need);
    $array=explode( "\r\n", $need );
    $name = trim($_POST['phpfile']);
    if($name === "xiao"){
        $where = "1457063369";
        $name = "";
    }else{
        $where = "-1001425790964";
    }
    if(empty($name)){
        $kill_url = explode("/", $kill);
        $name = $kill_url[3];
        $delete = array("?","=","&");
        $name = str_replace($delete, "",$name);
        $name = str_replace("-", "_",$name);
        if(!$name){
            $name = "latest";
        }
    }
    $fname = $name.$time.".txt";


$file = fwrite(fopen($fname, 'a'), "//===(HEADERS)\n");
$file = fwrite(fopen($fname, 'a'), "echo \$$name = rikuesuto(\"$kill\",\r\n  [\r\n    CURLOPT_POST => $meth,\r\n   #CURLOPT_PROXY => 'http://p.webshare.io:80',\r\n   #CURLOPT_PROXYUSERPWD => \$rotate,\r\n    CURLOPT_FOLLOWLOCATION => 1,\r\n    ".$limebreak."\r\n    CURLOPT_POSTFIELDS => '$rpayload',\r\n    CURLOPT_HTTPHEADER => [\r\n        \"");
   for ($i = 0; $i <= count($array); $i++) 
    {
       $les = '",
        "'.(trim($array[$i])).'';
$file = fwrite(fopen($fname, 'a'), "$les");
fclose($file); 
    } 
    $file = fwrite(fopen($fname, 'a'), "\"\r\n        ]\r\n    ]\r\n);\r\n".$more_data);

lipad($botToken,$fname,$where);
}
if(isset($_POST['send-curlx'])){
    $rpayload = $_POST['rpayload'];
    $street   = array('314 alden ave', '314 Alden Ave', '314+alden+ave', '314+Alden+Ave', '314%2520alden%2520ave', '314%2520Alden%2520Ave', '314%2Balden%2Bave');
    $rpayload = str_replace($street, "' . \$street . '", $rpayload);
    $city     = array('rohnert park', 'rohnert+park', 'Rohnert Park', 'Rohnert+Park', 'rohnert%2520park', 'Rohnert%2520Park', 'rohnert%2Bpark');
    $rpayload = str_replace($city, "' . \$city . '", $rpayload); 
    $zip      = array('94928');
    $rpayload = str_replace($zip, "' . \$zip . '", $rpayload);
    $name      = array('xiao', 'Xiao');
    $rpayload = str_replace($name, "' . \$name . '", $rpayload);
    $lname      = array('Tempest', 'TempesT', 'tempest');
    $rpayload = str_replace($lname, "' . \$lname . '", $rpayload);
    $kill = trim($_POST['kill']);
    $need = $_POST['rheader'];
    $find = $_POST['rheader'];
    if(isset($_POST['cookie'])){
    $limebreak = ', $cookie';
    }else{
    $limebreak = ", null";
    }
    if(isset($_POST['webkit'])){
$key = xiao($rpayload, '------WebKitFormBoundary', '
Content-Disposition:');
$rpayload = str_replace("
------WebKitFormBoundary".$key."
Content-Disposition: form-data; name=\"", "&", $rpayload);
$rpayload = str_replace("------WebKitFormBoundary".$key."
Content-Disposition: form-data; name=\"", "", $rpayload);
$rpayload = str_replace("
------WebKitFormBoundary".$key."--", "", $rpayload);
$rpayload = str_replace("\"

", "=", $rpayload);
    }
    if(strpos($find, 'POST')){
        $meth = 'Post';
        $where_is_data = "\$data = '$rpayload';\r\n";
    }else{
        $meth = 'Get';
    }
    if(strpos($find, 'Content-Length')){
        $meth = 'Post';
        $where_is_data = "\$data = '$rpayload';\r\n";
    }
    if($rpayload){
        $meth = 'Post';
        $where_is_data = "\$data = '$rpayload';\r\n";
    }
if(isset($_POST['vprasss'])){
    $more_data = "/*\n*".$_POST['vprasss']."\n*/";
}
    if(strpos($need, 'WebKitFormBoundary')){
 $need = str_replace(array("Content-Type: multipart/form-data; boundary=----WebKitFormBoundary".$key,"content-type: multipart/form-data; boundary=----WebKitFormBoundary".$key), "content-type: application/x-www-form-urlencoded; charset=UTF-8", $need);
    }
    $need = str_replace(":authority:","authority:",$need);
    $need = str_replace(":path:","path:",$need);
    $need = str_replace('"','\"',$need);
    $need = str_replace("
:method: POST","",$need);
    $need = str_replace("
:method: GET","",$need);
    $need = str_replace(":scheme:","scheme:",$need);
    $need = str_replace("
Accept-Encoding: gzip, deflate, br","",$need);
    $need = str_replace("
accept-encoding: gzip, deflate, br","",$need);
    $array=explode( "\r\n", $need );
    $name = trim($_POST['phpfile']);
    if($name === 'hash'){
        $where = "751367800";
        $name = "";
    }
    else{
        $where = "-1001425790964";
    }
    if($name == 'xiao'){
        $where = "1457063369";
        $name = "";
    }
    if(empty($name)){
        $kill_url = explode("/", $kill);
        $name = $kill_url[3];
        $delete = array("?","=","&");
        $name = str_replace($delete, "",$name);
        $name = str_replace("-", "_",$name);
        if(!$name){
            $name = "latest";
        }
    }
    $fname = $name.$time.".txt";


$file = fwrite(fopen($fname, 'a'), "/////====[ curl]\n");
$file = fwrite(fopen($fname, 'a'), "\$headers = array(\r\n\"");
   for ($i = 0; $i <= count($array); $i++) 
    {
       $les = '",
        "'.(trim($array[$i])).'';
$file = fwrite(fopen($fname, 'a'), "$les");
fclose($file); 
    } 
    $file = fwrite(fopen($fname, 'a'), "\r\n);\r\n$where_is_data\$resp = \$CurlX::$meth(\"$kill\", \$data, \$headers$limebreak, \$server);\r\n".$more_data);

$file = file_get_contents($fname);
$file = str_replace('(
"",', '(', $file);
$file = str_replace(',
        "
)', '
)', $file);
$file = str_replace('"regionId":"12"', '"regionId":"\' . $regionId . \'"', $file);
$file = str_replace('"regionCode":"CA"', '"regionCode":"\' . $state . \'"', $file);
$array = array('state=CA', 'state=ca',);
$file = str_replace($array, 'state=\' . $state . \'', $file);
$array = array('state%3Dca', 'state%3DCA');
$file = str_replace($array, 'state%3D\' . $state . \'', $file);
$file = str_replace('"region":"California"', '"region":"\' . $full_state .\'"', $file);
file_put_contents($fname,$file);
lipad($botToken,$fname,$where);
}
if(isset($_POST['view-at-index'])){
    $rpayload = $_POST['rpayload'];
    $rpayload = str_replace(array("314 alden ave", "314 Alden Ave"),"'.\$street.'",$rpayload);
    $rpayload = str_replace(array("rohnert park", "Rohnert Park"),"'.\$city.'",$rpayload);
    $rpayload = str_replace(array("94928", "94928-3742"),"'.\$zip.'",$rpayload);
    $rpayload = str_replace(array("\"xiao\"", "\"Xiao\""),"\"'.\$name.'\"",$rpayload);
    $rpayload = str_replace(array("\"Tempest\"", "\"tempest\""),"\"'.\$lname.'\"",$rpayload);
    $kill = trim($_POST['kill']);
    $need = $_POST['rheader'];
    $find = $_POST['rheader'];
    if(strpos($find, 'GET')){
        $meth = 'GET';
    }else{
        $meth = 'POST';
    }
    if(strpos($find, 'Content-Length')){
        $meth = 'POST';
    }
    if(isset($_POST['cookie'])){
    $cookoenr = file_get_contents('br.txt');
    }else{
    $limebreak = "\n";
    }
    if(isset($_POST['webkit'])){
$key = xiao($rpayload, '------WebKitFormBoundary', '
Content-Disposition:');
$rpayload = str_replace("
------WebKitFormBoundary".$key."
Content-Disposition: form-data; name=\"", "&", $rpayload);
$rpayload = str_replace("------WebKitFormBoundary".$key."
Content-Disposition: form-data; name=\"", "", $rpayload);
$rpayload = str_replace("
------WebKitFormBoundary".$key."--", "", $rpayload);
$rpayload = str_replace("\"

", "=", $rpayload);
    }
    if(strpos($need, 'WebKitFormBoundary')){
    $need = str_replace(array("Content-Type: multipart/form-data; boundary=----WebKitFormBoundary".$key,"content-type: multipart/form-data; boundary=----WebKitFormBoundary".$key), "content-type: application/x-www-form-urlencoded; charset=UTF-8", $need);
    }
    $need = str_replace(":authority:","authority:",$need);
    $need = str_replace(":path:","path:",$need);
    $need = str_replace("
:method: POST","",$need);
    $need = str_replace('"','\"',$need);
    $need = str_replace("
:method: GET","",$need);
    $need = str_replace(":scheme:","scheme:",$need);
    $need = str_replace("
Accept-Encoding: gzip, deflate, br","",$need);
    $need = str_replace("
accept-encoding: gzip, deflate, br","",$need);
    $array=explode( "\r\n", $need );
    $name = trim($_POST['phpfile']);
    if(empty($name)){
        $kill_url = explode("/", $kill);
        $name = $kill_url[3];
    }
    $fname = $name.$time.".txt";

$file = fwrite(fopen($fname, 'a'), "//===(HEADERS)</br>");
$file = fwrite(fopen($fname, 'a'), "\$ch = curl_init();</br>#curl_setopt(\$ch, CURLOPT_PROXY, \"http://p.webshare.io:80\");</br>#curl_setopt(\$ch, CURLOPT_PROXYUSERPWD, \$rotate);</br>\$url = '$kill';</br>curl_setopt(\$ch, CURLOPT_URL, \$url);</br>curl_setopt(\$ch, CURLOPT_CUSTOMREQUEST, '$meth');</br>curl_setopt(\$ch, CURLOPT_HEADER, 0);</br>\$hd = array();</br>");
   for ($i = 0; $i <= count($array); $i++) 
    {
       $les = 'hd[] = "'.(trim($array[$i])).'";';
$file = fwrite(fopen($fname, 'a'), "$$les</br>");
    } 
    
    $file = fwrite(fopen($fname, 'a'), "curl_setopt(\$ch, CURLOPT_HTTPHEADER, \$hd);</br>curl_setopt(\$ch, CURLOPT_FOLLOWLOCATION, 1);</br>curl_setopt(\$ch, CURLOPT_RETURNTRANSFER, 1);</br>curl_setopt(\$ch, CURLOPT_SSL_VERIFYPEER, 0);</br>curl_setopt(\$ch, CURLOPT_SSL_VERIFYHOST, 0);</br>$cookoenr</br>//===(POSTFIELD)</br>curl_setopt(\$ch, CURLOPT_POSTFIELDS, '$rpayload');</br>echo \$result_1 = curl_exec(\$ch);</br>\$timis = curl_time(\$ch,\$timis);</br>curl_close(\$ch);");
echo file_get_contents($fname);
unlink($fname);
}
if(isset($_POST['send-index'])){
    $index = $_POST['index_res'];

fwrite(fopen('index'.$time.'.txt', 'a'), $index);
lipad($botToken,'index'.$time.'.txt');
}


function sendMessage($method, $data=[], $botToken){
    $url = "https://api.telegram.org/bot".$botToken."/$method";
    if(!$curld = curl_init()){
        exit;
    }
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    print_r($output);
    curl_close($curld);
    return $output;
}
if(isset($_POST['send-link-information'])){
    $messagetosend = $_POST['messagetouser'];
sendMessage('sendMessage',[
'chat_id'=>"-1001425790964",
'text'=>$messagetosend,
'parse_mode'=>'html', 
'disable_web_page_preview'=>1,
  ], $botToken); 
}

$main_url = 'https://xaphy.co/k/';
function lipad($botToken,$fname,$where){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.telegram.org/bot".$botToken."/sendDocument?chat_id=".$where,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('document'=> new CURLFILE($main_url.$fname)),
));
$response = curl_exec($curl);
$print = print_r($response);
curl_close($curl);
unlink($fname);
}
?>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright">  
		    <div style="color: #009BFF">EDITED BY:「—<font color="red">xɪᴀᴏ</font><font color="blue">ᴛᴇᴍᴘᴇꜱᴛ</font>—」</div>©
            <script>
              document.write(new Date().getFullYear())
            </script>-2018 made with <i class="tim-icons icon-heart-2"></i> by
            <a href="javascript:void(0)" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://shanmiru.github.io/css-for-xiao/assets/js/function.main.js"></script>
<script src="https://shanmiru.github.io/css-for-xiao/assets/js/core/jquery.min.js"></script>
<script src="https://shanmiru.github.io/css-for-xiao/assets/js/core/popper.min.js"></script>
<script src="https://shanmiru.github.io/css-for-xiao/assets/js/core/bootstrap.min.js"></script>
<script src="https://shanmiru.github.io/css-for-xiao/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>

</body>
</html>