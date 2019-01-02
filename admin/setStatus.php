<?php
/**
 * 设置补领状态
**/
include("../includes/common.php");
if($islogin==1){}else exit('{"code":301,"msg":"未登录"}');

$id=intval($_GET['name']);
$status=intval($_GET['status']);
if($status==4){
	if($DB->query("DELETE FROM shua_orders WHERE id='$id'"))
		exit('{"code":200}');
	else
		exit('{"code":400,"msg":"删除订单失败！'.$DB->error().'"}');
}elseif($status==6){
    //发送短信
}
else{
	if($DB->query("update shua_orders set status='$status' where id='{$id}'"))
		exit('{"code":200}');
	else
		exit('{"code":400,"msg":"修改订单失败！'.$DB->error().'"}');
}


function curl($url,array $array ,$type = 'post') {
    $ch = curl_init();
    if($type == 'get'){
        if(is_array($array)) {
            $query = http_build_query($array);
            $url = $url . '?' . $query;
        }
    }
    if(stripos($url, "https://") !== false) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    if($type == 'post'){
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
    }
    $content = curl_exec($ch);
    $status = curl_getinfo($ch);
    curl_close($ch);
    if(intval($status["http_code"]) == 200) {
        return $content;
    } else {
        echo $status["http_code"];
        return false;
    }
}