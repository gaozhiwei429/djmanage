<?php
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
//header('Access-Control-Allow-Headers:x-requested-with,content-type');
//header("Location: http://www.baidu.com");
?>
<?php
$html = file_get_contents('http://www.baidu.com/');
echo $html;
?>
