<?php

include("../includes/common.php");

if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$tid=intval($_GET['tid']);
$sign=intval($_GET['sign']);
$orderby=($_GET['orderby']==1)?"desc":"asc";

$date=date("Y-m-d");
$data='';

if($sign == 1){
    $rs=$DB->query("SELECT * FROM shua_orders WHERE tid='{$tid}' and status=1 order by addtime {$orderby} limit 1000");
}else{
    $rs=$DB->query("SELECT * FROM shua_orders WHERE tid='{$tid}' and status=0 order by addtime {$orderby} limit 1000");
}

while($row = $DB->fetch($rs))
{
	$data.=$row['qq'].'----'.$row['tel']."\r\n";
}

$file_name='output_'.$tid.'_'.$date.'__'.time().'.txt';
$file_size=strlen($data);
header("Content-Description: File Transfer");
header("Content-Type:application/force-download");
header("Content-Length: {$file_size}");
header("Content-Disposition:attachment; filename={$file_name}");
echo $data;
?>