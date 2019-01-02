<?php
include("./includes/common.php");
include("./includes/txprotect.php");
$qq=isset($_GET['qq'])?strip_tags($_GET['qq']):null;

$rs=$DB->query("SELECT * FROM shua_tools WHERE 1 order by sort asc");
$select='';
while($res = $DB->fetch($rs)){
	$shua_func[$res['tid']]=$res['name'];
	$select.='<option value="'.$res['tid'].'" price="'.$res['price'].'">'.$res['name'].'</option>';
}
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo $conf['sitename']?> - <?php echo $conf['title']?></title>
  <meta name="keywords" content="<?php echo $conf['keywords']?>">
  <meta name="description" content="<?php echo $conf['description']?>">
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/datepicker3.css" rel="stylesheet">
<link href="/assets/css/styles.css" rel="stylesheet">
<script src="//cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<!--Icons-->
<script src="/assets/js/lumino.glyphs.js"></script>
<!--[if lt IE 9]>
<script src="/assets/js/html5shiv.js"></script>
<script src="/assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>QQ业务</span>下单平台</a>
				<!--<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="/admin" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>管理后台<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/admin"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> 管理后台</a></li>
						</ul>
					</li>
				</ul>-->
			</div>
	</div><!-- /.container-fluid -->

	</nav>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">订单查询</li>
			</ol>
		</div><!--/.row-->
<div class="row">
<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading  panel-blue">平台公告</div>
					<div class="panel-body">
						<?php echo $conf['anounce']?>
					</div>
				</div>
			</div></div>
<div class="list-group-item">
<div id="myTabContent" class="tab-content">
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

		<ul class="nav menu">
			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> 在线下单</a></li>
			<!--<li ><a href="kami.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> 卡密下单</a></li>-->

			<li class="active"><a href="cxqq.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> 订单查询</a></li>
			<!--<li class="parent ">
				<a href="http://wpa.qq.com/msgrd?v=3&uin=306063314&site=qq&menu=yes">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 搭建平台
				</a>
			</li>-->
			<li role="presentation" class="divider"></li>
			<!--<li><a href="/admin"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>管理后台</a></li>-->
		</ul>

	</div><!--/.sidebar-->

<div class="" style="float: none;">

			<div class="tab-pane fade in" id="query">
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">请输入QQ</div>
					<input type="text" name="qq" id="qq3" value="<?php echo $qq?>" class="form-control" required/>
				</div></div>
				<input type="submit" id="submit_query" class="btn btn-primary btn-block" value="立即查询">
				<div id="result2" class="form-group text-center" style="display:none;">
					<table class="table table-striped">
					<thead><tr><th>ＱＱ</th><th>商品名称</th><th>购买时间</th><th>状态</th></tr></thead>
					<tbody id="list">
					</tbody>
					</table>
                </div>
               </div>
</div>
</div>
</div></div>
<script type="text/javascript">
function getPoint() {
	var price = $('#tid option:selected').attr('price');
	$('#need').val('￥'+price);
}
getPoint();
$(document).ready(function(){
	$("#submit_query").click(function(){
		var qq=$("#qq3").val();
		if(qq==''){alert('请确保每项不能为空！');return false;}
		$('#submit_query').val('Loading');
		$('#result2').hide();
		$('#list').html('');
		$.ajax({
			type : "POST",
			url : "ajax.php?act=query",
			data : {qq:qq},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					$.each(data.data, function(i, item){
						status=item.status==1?'<font color=green>已完成</font>':'<font color=blue>待处理</font>';
						$('#list').append('<tr tid='+item.tid+'><td>'+item.qq+'</td><td>'+item.name+'</td><td>'+item.addtime+'</td><td>'+status+'</td></tr>');
					});
					$("#result2").slideDown();
				}else{
					alert(data.msg);
				}
				$('#submit_query').val('立即查询');
			}
		});
	});
$("#buy_alipay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=alipay&orderid='+orderid;
});
$("#buy_qqpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=qqpay&orderid='+orderid;
});
$("#buy_wxpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=wxpay&orderid='+orderid;
});
$("#buy_tenpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=tenpay&orderid='+orderid;
});
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
if( !$.cookie('op') && isModal==true){
	$('#myModal').modal({
		keyboard: true
	});
	var cookietime = new Date();
	cookietime.setTime(cookietime.getTime() + (10*60*1000));
	$.cookie('op', false, { expires: cookietime });
}
});
</script>
</div>
</div>
</body>
</html>