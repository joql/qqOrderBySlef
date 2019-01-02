<?php
/**
 * 订单管理
**/
include("../includes/common.php");
$title='订单管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索订单</h4>
      </div>
      <div class="modal-body">
      <form action="kmlist.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入QQ"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
function display_zt($zt){
	if($zt==1)
		return '<font color=green>已完成</font>';
	else
		return '<font color=blue>待处理</font>';
}

$rs=$DB->query("SELECT * FROM shua_tools WHERE 1 order by sort asc");
$select='';
while($res = $DB->fetch($rs)){
	$shua_func[$res['tid']]=$res['name'];
	$select.='<option value="'.$res['tid'].'">'.$res['name'].'</option>';
}

if(isset($_GET['kw'])) {
	$sql=" `qq`='{$_GET['kw']}'";
	$numrows=$DB->count("SELECT count(*) from shua_orders WHERE{$sql}");
	$con='包含 '.$_GET['kw'].' 的共有 <b>'.$numrows.'</b> 个订单';
}else{
	$numrows=$DB->count("SELECT count(*) from shua_orders");
	$ondate=$DB->count("select count(*) from shua_orders where status=2");
	$sql=" 1";
	$con='系统共有 <b>'.$numrows.'</b> 个订单，其中已完成的有 <b>'.$ondate.'</b> 个。';
}

echo '<form action="download.php" method="GET" class="form-inline">
  <div class="form-group">
    <label>导出列表</label>
    <select name="tid" class="form-control">'.$select.'</select>
  </div>
  <div class="form-group">
    <select class="form-control" name="sign"><option value="0">是否标记为已完成</option><option value="0">0_否</option><option value="1">1_是</option></select>
  </div>
  <button type="submit" class="btn btn-primary">下载</button>
  <a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>
</form>';
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>类型</th><th>ＱＱ</th><th>添加时间</th><th>状态</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM shua_orders WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td>'.$shua_func[$res['tid']].'</td><td>'.$res['qq'].'</td><td>'.$res['addtime'].'</td><td>'.display_zt($res['status']).'</td><td><select onChange="javascript:setStatus(\''.$res['id'].'\',this.value)" class="form-control"><option selected>操作订单</option><option value="0">待处理</option><option value="1">已完成</option><option value="6">发送短信</option><option value="4">删除订单</option></select></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="list.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="list.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="list.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="list.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="list.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>
<script>
function setStatus(name, status) {
	$.ajax({
		type : 'get',
		url : 'setStatus.php',
		data : 'name=' + name + '&status=' + status,
		dataType : 'json',
		success : function(ret) {
			if (ret['code'] != 200) {
				return alert(ret['msg'] ? ret['msg'] : '操作失败');
			}
			window.location.reload();
		}
	});
}
</script>