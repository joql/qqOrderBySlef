<?php

include("./includes/common.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;
$url=daddslashes($_GET['url']);
$authcode=daddslashes($_GET['authcode']);

@header('Content-Type: application/json; charset=UTF-8');

if($url){
	if(strlen($authcode)!=32)exit('您可能是盗版软件的受害者。购买正版请联系QQ：306063314');
	if($auth=get_curl('http://auth.odata.cc/apicheck.php?v=2&url='.$url.'&authcode='.$authcode)){
		if ($auth==1) {
		} else {
			exit('您可能是盗版软件的受害者。购买正版请联系QQ：306063314');
		}
	}
}

if($act=='shop')
{
	$rs=$DB->query("SELECT * FROM shua_tools WHERE active=1 order by sort asc");
	while($res = $DB->fetch($rs)){
		$data[]=array('tid'=>$res['tid'],'name'=>$res['name'],'price'=>$res['price']);
	}
	$result=array("code"=>1,"msg"=>$conf['anounce'],"data"=>$data,"kaurl"=>$conf['kaurl']);
}
elseif($act=='add')
{
	$tid=intval($_GET['tid']);
	$km=daddslashes($_GET['km']);
	$qq=daddslashes($_GET['qq']);

	if(!$qq||!$km||!$tid)exit('{"code":-4,"msg":"确保各项不能为空"}');

	$tool=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
	if($tool && $tool['active']==1){

	$myrow=$DB->get_row("select * from shua_kms where km='$km' and tid='$tid' limit 1");

	if(!$myrow)
	{
		$result=array("code"=>-1,"msg"=>"此卡密不存在，不同代刷功能的卡密不能通用！");
	}
	elseif($myrow['user']!=0){
		$result=array("code"=>-1,"msg"=>"此卡密已被使用！");
	}
	else
	{
		$thtime=date("Y-m-d").' 00:00:00';
		$row=$DB->get_row("select * from shua_orders where tid='$tid' and qq='$qq' order by id desc limit 1");
		if($row['qq'] && $row['status']==0)
			$result=array("code"=>1,"msg"=>"您今天添加的".$tool['name']."代刷任务正在排队中，请勿重复提交！","qq"=>$qq);
		elseif($row['addtime']>$thtime)
			$result=array("code"=>1,"msg"=>"您今天已添加过".$tool['name']."代刷任务，请勿重复提交！","qq"=>$qq);
		else
		{
			$value=$myrow['value']?$myrow['value']:'1000';
			$sql="insert into `shua_orders` (`tid`,`qq`,`value`,`addtime`,`status`,`url`) values ('".$tid."','".$qq."','".$value."','".$date."','0','".$url."')";
			if($DB->query($sql)){
				$DB->query("update `shua_kms` set `user` ='$qq',`usetime` ='".$date."' where `kid`='{$myrow['kid']}'");
				$result=array("code"=>1,"msg"=>"添加".$tool['name']."代刷任务成功！","qq"=>$qq);
			}else{
				$result=array("code"=>-2,"msg"=>"添加".$tool['name']."代刷任务失败！".$DB->error(),"qq"=>$qq);
			}
		}
	}
	}else{
		$result=array("code"=>-4,"msg"=>"该商品不存在");
	}
}
elseif($act=='delete')
{
	$tid=intval($_GET['tid']);
	$qq=daddslashes($_GET['qq']);

	if(!$tid||!$qq)exit('确保各项不能为空');

	$row=$DB->get_row("SELECT * FROM shua_orders WHERE qq='{$qq}' and tid='{$tid}' order by id desc limit 1");
	if($id=$row['id']) {
		$sql="delete `shua_orders` where `id`='{$id}' limit 1";

		if($DB->query($sql)){
			$result=array("code"=>1,"msg"=>"删除任务成功","id"=>$id,"uin"=>$uin);
		}else{
			$result=array("code"=>-2,"msg"=>"删除任务失败","id"=>$id,"uin"=>$uin);
		}
	}
	else
	{
		$result=array("code"=>-1,"msg"=>"没有此记录");
	}
}
elseif($act=='list')
{
	$qq=daddslashes($_GET['qq']);
	$limit=isset($_GET['limit'])?intval($_GET['limit']):10;
	if(!$qq)exit('确保各项不能为空');
	$rs=$DB->query("SELECT * FROM shua_tools WHERE active=1 order by sort asc");
	while($res = $DB->fetch($rs)){
		$shop[]=array('tid'=>$res['tid'],'name'=>$res['name'],'price'=>$res['price']);
		$shua_func[$res['tid']]=$res['name'];
	}
	$rs=$DB->query("SELECT * FROM shua_orders WHERE qq='{$qq}' order by id desc limit $limit");
	while($res = $DB->fetch($rs)){
		$data[]=array('id'=>$res['id'],'tid'=>$res['tid'],'qq'=>$res['qq'],'name'=>$shua_func[$res['tid']],'addtime'=>$res['addtime'],'endtime'=>$res['endtime'],'status'=>$res['status']);
	}
	$result=array("code"=>1,"msg"=>$conf['anounce'],"data"=>$data,"shop"=>$shop,"kaurl"=>$conf['kaurl']);
}
else
{
	$result=array("code"=>-5,"msg"=>"No Act!");
}

echo json_encode($result);
$DB->close();
?>