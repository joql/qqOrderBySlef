<?php
/**
 * 系统设置
**/
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
$mod=isset($_GET['mod'])?$_GET['mod']:null;
if($mod=='site_n'){
	$sitename=$_POST['sitename'];
	$title=$_POST['title'];
	$keywords=$_POST['keywords'];
	$description=$_POST['description'];
	$kfqq=$_POST['kfqq'];
	$kaurl=$_POST['kaurl'];
	$anounce=$_POST['anounce'];
	$modal=$_POST['modal'];
	$pwd=$_POST['pwd'];
	saveSetting('sitename',$sitename);
	saveSetting('title',$title);
	saveSetting('keywords',$keywords);
	saveSetting('description',$description);
	saveSetting('kfqq',$kfqq);
	saveSetting('kaurl',$kaurl);
	saveSetting('anounce',$anounce);
	saveSetting('modal',$modal);
	if(!empty($pwd))saveSetting('admin_pwd',$pwd);
	$ad=$CACHE->clear();
	if($ad)showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}elseif($mod=='site'){
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">网站信息配置</h3></div>
<div class="panel-body">
  <form action="./set.php?mod=site_n" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站名称</label>
	  <div class="col-sm-10"><input type="text" name="sitename" value="<?php echo $conf['sitename']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">标题栏后缀</label>
	  <div class="col-sm-10"><input type="text" name="title" value="<?php echo $conf['title']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">关键字</label>
	  <div class="col-sm-10"><input type="text" name="keywords" value="<?php echo $conf['keywords']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站描述</label>
	  <div class="col-sm-10"><input type="text" name="description" value="<?php echo $conf['description']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">客服ＱＱ</label>
	  <div class="col-sm-10"><input type="text" name="kfqq" value="<?php echo $conf['kfqq']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">卡密购买地址</label>
	  <div class="col-sm-10"><input type="text" name="kaurl" value="<?php echo $conf['kaurl']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">首页公告</label>
	  <div class="col-sm-10"><textarea class="form-control" name="anounce" rows="5"><?php echo htmlspecialchars($conf['anounce']);?></textarea></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">首页弹出公告</label>
	  <div class="col-sm-10"><textarea class="form-control" name="modal" rows="5"><?php echo htmlspecialchars($conf['modal']);?></textarea></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">密码重置</label>
	  <div class="col-sm-10"><input type="text" name="pwd" value="" class="form-control" placeholder="不修改请留空"/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<?php
}elseif($mod=='shop_n'){
	$shopname=$_POST['shopname'];
	$shop_price=$_POST['shop_price'];
	$shop_content=$_POST['shop_content'];
	$shop_city=$_POST['shop_city'];
	$footer=$_POST['footer'];
	saveSetting('shopname',$shopname);
	saveSetting('shop_price',$shop_price);
	saveSetting('shop_content',$shop_content);
	saveSetting('shop_city',$shop_city);
	saveSetting('footer',$footer);
	$ad=$CACHE->clear();
	if($ad)showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}elseif($mod=='shop'){
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">商品信息配置</h3></div>
<div class="panel-body">
  <form action="./set.php?mod=shop_n" method="post" class="form-horizontal" role="form">
	<div class="form-group">
	  <label class="col-sm-2 control-label">商品名称</label>
	  <div class="col-sm-10"><input type="text" name="shopname" value="<?php echo $conf['shopname']; ?>" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">发货地点显示</label>
	  <div class="col-sm-10"><input type="text" name="shop_city" value="<?php echo $conf['shop_city']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">默认显示价格</label>
	  <div class="col-sm-10"><input type="text" name="shop_price" value="<?php echo $conf['shop_price']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">商品简介</label>
	  <div class="col-sm-10"><textarea class="form-control" name="shop_content" rows="6"><?php echo htmlspecialchars($conf['shop_content']);?></textarea></div>
	  <pre><font color="green">首页商品图片地址/assets/img/shop.jpg</font></pre>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">全局底部</label>
	  <div class="col-sm-10"><textarea class="form-control" name="footer" rows="3"><?php echo htmlspecialchars($conf['footer']);?></textarea></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<?php
}elseif($mod=='pay_n'){
	saveSetting('alipay_api',$_POST['alipay_api']);
	saveSetting('alipay_pid',$_POST['alipay_pid']);
	saveSetting('alipay_key',$_POST['alipay_key']);
	saveSetting('alipay_account',$_POST['alipay_account']);
	saveSetting('alipay2_api',$_POST['alipay2_api']);
	saveSetting('tenpay_api',$_POST['tenpay_api']);
	saveSetting('tenpay_pid',$_POST['tenpay_pid']);
	saveSetting('tenpay_key',$_POST['tenpay_key']);
	saveSetting('qqpay_api',$_POST['qqpay_api']);
	saveSetting('qqpay_pid',$_POST['qqpay_pid']);
	saveSetting('qqpay_key',$_POST['qqpay_key']);
	saveSetting('wxpay_api',$_POST['wxpay_api']);
	saveSetting('epay_pid',$_POST['epay_pid']);
	saveSetting('epay_key',$_POST['epay_key']);
	$ad=$CACHE->clear();
	if($ad)showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}elseif($mod=='pay'){
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">支付接口配置</h3></div>
<div class="panel-body">
  <form action="./set.php?mod=pay_n" method="post" class="form-horizontal" role="form">
	<div class="form-group">
		<label class="col-lg-3 control-label">支付宝即时到账</label>
		<div class="col-lg-8">
			<select class="form-control" name="alipay_api" default="<?php echo $conf['alipay_api']?>"><option value="0">关闭</option><option value="1">支付宝官方即时到账接口</option><option value="2">彩虹易支付免签约接口</option></select>
		</div>
	</div>
	<div id="payapi_01" style="<?php if($conf['alipay_api']!=1){?>display:none;<?php }?>">
	<div class="form-group">
		<label class="col-lg-3 control-label">收款人支付宝账号</label>
		<div class="col-lg-8">
			<input type="text" name="alipay_account" class="form-control"
				   value="<?php echo $conf['alipay_account']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">合作者身份(PID)</label>
		<div class="col-lg-8">
			<input type="text" name="alipay_pid" class="form-control" value="<?php echo $conf['alipay_pid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">安全校验码(Key)</label>
		<div class="col-lg-8">
			<input type="text" name="alipay_key" class="form-control" value="<?php echo $conf['alipay_key']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">支付宝手机网站支付</label>
		<div class="col-lg-8">
			<select class="form-control" name="alipay2_api" default="<?php echo $conf['alipay2_api']?>"><option value="0">关闭</option><option value="1">支付宝官方手机网站支付接口</option></select>
			<pre id="payapi_02"  style="<?php if($conf['alipay2_api']!=1){?>display:none;<?php }?>">相关信息与以上支付宝即时到账接口一致，开启前请确保已开通支付宝手机支付，否则会导致手机用户无法支付！</pre>
		</div>
	</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">财付通即时到账</label>
		<div class="col-lg-8">
			<select class="form-control" name="tenpay_api" default="<?php echo $conf['tenpay_api']?>"><option value="0">关闭</option><option value="1">财付通官方即时到账接口</option><option value="2">彩虹易支付免签约接口</option></select>
		</div>
	</div>
	<div id="payapi_03" style="<?php if($conf['tenpay_api']!=1){?>display:none;<?php }?>">
	<div class="form-group">
		<label class="col-lg-3 control-label">财付通商户号</label>
		<div class="col-lg-8">
			<input type="text" name="tenpay_pid" class="form-control"
				   value="<?php echo $conf['tenpay_pid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">财付通密钥</label>
		<div class="col-lg-8">
			<input type="text" name="tenpay_key" class="form-control" value="<?php echo $conf['tenpay_key']?>">
		</div>
	</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">QQ钱包支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="qqpay_api" default="<?php echo $conf['qqpay_api']?>"><option value="0">关闭</option><option value="1">QQ钱包官方即时到账接口</option><option value="2">彩虹支付免签约接口</option></select>
		</div>
	</div>
	<div id="payapi_05" style="<?php if($conf['qqpay_api']!=1){?>display:none;<?php }?>">
	<div class="form-group">
		<label class="col-lg-3 control-label">QQ钱包商户号</label>
		<div class="col-lg-8">
			<input type="text" name="qqpay_pid" class="form-control"
				   value="<?php echo $conf['qqpay_pid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">QQ钱包密钥</label>
		<div class="col-lg-8">
			<input type="text" name="qqpay_key" class="form-control" value="<?php echo $conf['qqpay_key']?>">
		</div>
	</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">微信支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="wxpay_api" default="<?php echo $conf['wxpay_api']?>"><option value="0">关闭</option><option value="1">微信官方即时到账接口</option><option value="2">彩虹免签约接口</option></select>
			<pre id="payapi_04"  style="<?php if($conf['wxpay_api']!=1){?>display:none;<?php }?>"><font color="green">*微信即时到账相关信息配置请修改includes/wxpay/WxPay.Config.php</font></pre>
		</div>
	</div>
	<?php if($conf['alipay_api']==2 || $conf['tenpay_api']==2 || $conf['tenpay_api']==2 || $conf['wxpay_api']==2){?>
	<div class="form-group">
		<label class="col-lg-3 control-label">彩虹易支付商户ID</label>
		<div class="col-lg-8">
			<input type="text" name="epay_pid" class="form-control"
				   value="<?php echo $conf['epay_pid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">彩虹易支付商户密钥</label>
		<div class="col-lg-8">
			<input type="text" name="epay_key" class="form-control" value="<?php echo $conf['epay_key']?>">
		</div>
	</div>
	<a href="set.php?mod=epay">彩虹易支付设置</a>
	<?php }?>
	<div class="form-group">
	  <div class="col-sm-offset-3 col-sm-8"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<script>
$("select[name=\'alipay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_01").css("display","inherit");
	}else{
		$("#payapi_01").css("display","none");
	}
});
$("select[name=\'tenpay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_03").css("display","inherit");
	}else{
		$("#payapi_03").css("display","none");
	}
});
$("select[name=\'wxpay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_04").css("display","inherit");
	}else{
		$("#payapi_04").css("display","none");
	}
});
$("select[name=\'qqpay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_05").css("display","inherit");
	}else{
		$("#payapi_05").css("display","none");
	}
});
$("select[name=\'alipay2_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_02").css("display","inherit");
	}else{
		$("#payapi_02").css("display","none");
	}
});
</script>
<?php
}elseif($mod=='epay_n'){
	$account=$_POST['account'];
	$username=$_POST['username'];
	if($account==NULL || $username==NULL){
		showmsg('保存错误,请确保每项都不为空!',3);
	} else {
	$data=get_curl($payapi.'api.php?act=change&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&account='.$account.'&username='.$username.'&url='.$_SERVER['HTTP_HOST']);
	$arr=json_decode($data,true);
	if($arr['code']==1) {
		showmsg('修改成功!',1);
	}else{
		showmsg($arr['msg']);
	}
	}
}elseif($mod=='epay'){
if(isset($conf['epay_pid']) && isset($conf['epay_key'])){
	$data=get_curl($payapi.'api.php?act=query&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&url='.$_SERVER['HTTP_HOST']);
	$arr=json_decode($data,true);
	if($arr['code']==-2) {
		showmsg('QQ代刷吧KEY校验失败！');
	}elseif(!$data){
		showmsg('获取失败，请刷新重试！');
	}
}else{
	showmsg('你还未填写QQ代刷吧支付商户ID和密钥，请返回填写！');
}
if($arr['active']==0)showmsg('该商户已被封禁');
$key=substr($arr['key'],0,8).'****************'.substr($arr['key'],24,32);
?>
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">QQ代刷吧支付设置</h3></div>
<div class="panel-body">
<ul class="nav nav-tabs"><li class="active"><a href="#">QQ代刷吧支付设置</a></li><li><a href="./set.php?mod=epay_order">订单记录</a></li><li><a href="./set.php?mod=epay_settle">结算记录</a></li></ul>
  <form action="./set.php?mod=epay_n" method="post" class="form-horizontal" role="form">
    <h4>商户信息查看：</h4>
	<div class="form-group">
	  <label class="col-sm-2 control-label">商户ID</label>
	  <div class="col-sm-10"><input type="text" name="pid" value="<?php echo $arr['pid']; ?>" class="form-control" disabled/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">商户KEY</label>
	  <div class="col-sm-10"><input type="text" name="key" value="<?php echo $key; ?>" class="form-control" disabled/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">商户余额</label>
	  <div class="col-sm-10"><input type="text" name="money" value="<?php echo $arr['money']; ?>" class="form-control" disabled/></div>
	</div><br/>
	<h4>收款账号设置：</h4>
	<div class="form-group">
	  <label class="col-sm-2 control-label">支付宝账号</label>
	  <div class="col-sm-10"><input type="text" name="account" value="<?php echo $arr['account']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">支付宝姓名</label>
	  <div class="col-sm-10"><input type="text" name="username" value="<?php echo $arr['username']; ?>" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="确定修改" class="btn btn-primary form-control"/><br/>
	 </div>
	 </div>
	 <h4><span class="glyphicon glyphicon-info-sign"></span> 注意事项</h4>
1.支付宝账户和支付宝真实姓名请仔细核对，一旦错误将无法结算到账！<br/>2.每笔交易会有<?php echo (100-$arr['money_rate'])?>%的手续费，这个手续费是支付宝、微信和财付通收取的，非本接口收取。<br/>
  </form>
</div>
</div>
<?php
}elseif($mod=='epay_settle')
{
	$data=get_curl($payapi.'api.php?act=settle&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&limit=20&url='.$_SERVER['HTTP_HOST']);
	$arr=json_decode($data,true);
	if($arr['code']==-2) {
		showmsg('QQ代刷吧KEY校验失败！');
	}
echo '<div class="panel panel-primary"><div class="panel-heading w h"><h3 class="panel-title">QQ代刷吧支付结算记录</h3></div>
	<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>结算账号</th><th>结算金额</th><th>手续费</th><th>结算时间</th></tr></thead>
          <tbody>';
foreach($arr['data'] as $res){
	echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['account'].'</td><td><b>'.$res['money'].'</b></td><td><b>'.$res['fee'].'</b></td><td>'.$res['time'].'</td></tr>';
}
		  echo '</tbody>
        </table>
      </div>
	  </div>';
}
elseif($mod=='epay_order')
{
	$data=get_curl($payapi.'api.php?act=orders&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&limit=30&url='.$_SERVER['HTTP_HOST']);
	$arr=json_decode($data,true);
	if($arr['code']==-2) {
		showmsg('QQ代刷吧KEY校验失败！');
	}
echo '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">QQ代刷吧支付订单记录</h3></div>订单只展示前30条[<a href="set.php?mod=epay">返回</a>]
	<div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>交易号/商户订单号</th><th>付款方式</th><th>商品名称/金额</th><th>创建时间/完成时间</th><th>状态</th></tr></thead>
          <tbody>';
foreach($arr['data'] as $res){
	echo '<tr><td>'.$res['trade_no'].'<br/>'.$res['out_trade_no'].'</td><td>'.$res['type'].'</td><td>'.$res['name'].'<br/>￥ <b>'.$res['money'].'</b></td><td>'.$res['addtime'].'<br/>'.$res['endtime'].'</td><td>'.($res['status']==1?'<font color=green>已完成</font>':'<font color=red>未完成</font>').'</td></tr>';
}
		  echo '</tbody>
        </table>
      </div>
	  </div>';
}
elseif($mod=='upimg'){
echo '<div class="panel panel-primary"><div class="panel-heading"><h3 class="panel-title">更改首页LOGO</h3></div><div class="panel-body">';
if($_POST['s']==1){
$extension=explode('.',$_FILES['file']['name']);
if (($length = count($extension)) > 1) {
$ext = strtolower($extension[$length - 1]);
}
if($ext=='png'||$ext=='gif'||$ext=='jpg'||$ext=='jpeg'||$ext=='bmp')$ext='png';
copy($_FILES['file']['tmp_name'], ROOT.'logo.'.$ext);
echo "成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）";
}
echo '<form action="set.php?mod=upimg" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary btn-block" value="确认上传" /></form><br>现在的图片：<br><img src="../logo.png?r='.rand(10000,99999).'" style="max-width:100%">';
echo '</div></div>';
}?>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>
    </div>
  </div>