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
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="/admin" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>管理后台<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/admin"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> 管理后台</a></li>
						</ul>
					</li>
				</ul>
			</div>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">卡密下单</li>
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
			<li class="active"><a href="kami.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> 卡密下单</a></li>

			<li><a href="cxqq.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> 订单查询</a></li>
			<li class="parent ">
				<a href="http://wpa.qq.com/msgrd?v=3&uin=306063314&site=qq&menu=yes">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> 搭建平台 
				</a>
			</li>
			<li role="presentation" class="divider"></li>
			<li><a href="/admin"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>管理后台</a></li>
		</ul>

	</div><!--/.sidebar-->
	
<div class="" style="float: none;">

<div class="tab-pane fade in" id="cardbuy">
				<div class="form-group">
					<a href="<?php echo $conf['kaurl']?>" class="btn btn-default btn-block" target="_blank"/>点击进入购买卡密</a>
				</div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">输入卡密</div>
					<input type="text" name="km" id="km" value="" class="form-control" required/>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">要刷的QQ</div>
					<input type="text" name="qq" id="qq2" value="<?php echo $qq?>" class="form-control" required/>
				</div></div>
				<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买">
				<div id="result1" class="form-group text-center" style="display:none;">
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

	$("#submit_card").click(function(){
		var km=$("#km").val();
		var qq=$("#qq2").val();
		if(qq=='' || km==''){alert('请确保每项不能为空！');return false;}
		if(qq.length<5 || qq.length>11){alert('请输入正确的QQ号！');return false;}
		$('#submit_card').val('Loading');
		$('#result1').hide();
		$.ajax({
			type : "POST",
			url : "ajax.php?act=card",
			data : {km:km,qq:qq},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					$('#result1').html('<div class="alert alert-success"><img src="assets/img/ico_success.png">&nbsp;'+data.msg+'</div>');
					$("#result1").slideDown();
				}else{
					alert(data.msg);
				}
				$('#submit_card').val('立即购买');
			} 
		});
	});


});
</script>
</div>
</div>
</body>
</html>