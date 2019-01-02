<?php
/**
 * QQ代刷管理中心
**/
include("../includes/common.php");
$title='QQ代刷网后台管理中心';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<?php
	$data=get_curl($payapi.'api.php?act=query&pid='.$conf['epay_pid'].'&key='.$conf['epay_key'].'&url='.$_SERVER['HTTP_HOST']);
$wcl=count1-count2;
	$arr=json_decode($data,true);
$count1=$DB->count("SELECT count(*) from shua_orders");
$count2=$DB->count("SELECT count(*) from shua_orders where status=1");
$mysqlversion=$DB->count("select VERSION()");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
      <div class="panel panel-success">
        <div class="panel-heading"><h3 class="panel-title">后台管理首页</h3></div>
          <ul class="list-group">
		
<table class="table table-bordered">
<tbody>





<tr height="25">
	<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-tint"></span>订单总数</b></br><?php echo $count1?>条</font></td>
    <td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>已处理订单</b></br></span><?php echo $count2?>条</font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-exclamation-sign"></i>待处理订单</b></span></br><?php echo $count1-$count2?>条</font></td>
</tr>

<!--<tr height="25">
	<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-time"></i>运营天数</b></br>


<SCRIPT language=JavaScript>
var urodz= new Date("2017/5/10");
var now = new Date();
var ile = now.getTime() - urodz.getTime();
var dni = Math.floor(ile / (1000 * 60 * 60 * 24));
document.write(+dni)</script>天</font></td>
    <td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>收款支付宝</b></br></span><?php /*echo $arr['account']; */?></font></td>
<td align="center"><font color="#808080"><b><i class="glyphicon glyphico个n-exclamation-sign"></i>后台资金</b></span></br><?php /*echo $arr['money']; */?>元</font></td>
</tr>
<tr height="25">

	<td align="center"><a href="http://92lic.cn"class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-globe"></span>网站首页</a></td>
	<td align="center"><a href="list.php"class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-calendar"></span>订单管理</a></td>
<td align="center"><a href="kmlist.php"class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list"></span>卡密管理</a></td></tr>

<tr height="25">
<td align="center"><a href="clist.php"class="btn btn-xs btn-success"><span class="glyphicon glyphicon-globe"></span>商品管理</a></td>
<td align="center"><a href="set.php?mod=site"class="btn btn-xs btn-success"><span class="glyphicon glyphicon-globe"></span>网站信息</a></td>

<td align="center"><a href="/cxqq.php"class="btn btn-xs btn-success"><span class="glyphicon glyphicon-globe"></span>订单查询</a></td>

</tr>

<tr height="25">
<td align="center"><a href="set.php?mod=pay"class="btn btn-info btn-xs"><span class="glyphicon glyphicon-globe"></span>支付配置</a></td>
<td align="center"><a href="set.php?mod=epay_order"class="btn btn-info btn-xs"><span class="glyphicon glyphicon-globe"></span>订单记录</a></td>

<td align="center"><a href="set.php?mod=epay_settle"class="btn btn-info btn-xs"><span class="glyphicon glyphicon-globe"></span>结算记录</a></td>

</tr>-->
</table>
</tbody>
          </ul>
      </div>
<div class="panel panel-success">
	<div class="panel-heading">
		<h3 class="panel-title">QQ代刷网-服务器信息</h3>

</div>
	<ul class="list-group">
		<li class="list-group-item">
			<b>PHP 版本：</b><?php echo phpversion() ?>
			<?php if(ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?>
		</li>
		<li class="list-group-item">
			<b>MySQL 版本：</b><?php echo $mysqlversion ?>
		</li>

	<li class="list-group-item">
			<b>当前文件路径为：</b><?php echo $_SERVER['SCRIPT_FILENAME'] ?>
		</li>

		<li class="list-group-item">
			<b>服务器软件：</b><?php echo $_SERVER['SERVER_SOFTWARE'] ?>
		</li>
		
		<li class="list-group-item">
			<b>程序最大运行时间：</b><?php echo ini_get('max_execution_time') ?>s
		</li>
		<li class="list-group-item">
			<b>POST许可：</b><?php echo ini_get('post_max_size'); ?>
		</li>
		<li class="list-group-item">
			<b>文件上传许可：</b><?php echo ini_get('upload_max_filesize'); ?>
		</li>
</div>
	<ul class="list-group">
		<li class="list-group-item">
			<b>当前版本：</b><font STYLE="color: green;"><?php echo VERSION;?></font>
		</li>
		<li class="list-group-item">
			<b>检测更新：</b><font style="color: green;">最新版本：3.5</font>
		</li>
	
			<li class="list-group-item">
			<b>发卡网：</b><font style="color: green;"></font>
		</li>
	</ul>
</div>
    </div>
  </div>
<style type="text/css"> <!-- body { background-image: url(/bj1.jpg); background-size:cover-repeat;background-attachment:fixed; } --> </style> 