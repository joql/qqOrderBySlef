<?php
/**
 * 商品管理
**/
include("../includes/common.php");
$title='商品管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-sm-12 col-md-10 center-block" style="float: none;">
<?php
$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">添加一个商品</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./clist.php?my=add_submit" method="POST">
<div class="form-group">
<label>商品名称:</label><br>
<input type="text" class="form-control" name="name" value="" required>
</div>
<div class="form-group">
<label>排序(数字越小越靠前):</label><br>
<input type="number" class="form-control" name="sort" value="10" required>
</div>
<div class="form-group">
<label>是否上架:</label><br>
<select class="form-control" name="active"><option value="1">1_是</option><option value="0">0_否</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定添加"></form>';
echo '<br/><a href="./clist.php">>>返回类别列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$tid=$_GET['tid'];
$row=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
echo '<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title">修改类别商品</h3></div>';
echo '<div class="panel-body">';
echo '<form action="./clist.php?my=edit_submit&tid='.$tid.'" method="POST">
<div class="form-group">
<label>商品名称:</label><br>
<input type="text" class="form-control" name="name" value="'.$row['name'].'" required>
</div>
<div class="form-group">
<label>排序(数字越小越靠前):</label><br>
<input type="number" class="form-control" name="sort" value="'.$row['sort'].'" required>
</div>
<div class="form-group">
<label>是否上架:</label><br>
<select class="form-control" name="active" default="'.$row['active'].'"><option value="1">1_是</option><option value="0">0_否</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block"
value="确定修改"></form>
';
echo '<br/><a href="./clist.php">>>返回类别列表</a>';
echo '</div></div>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>';
}
elseif($my=='add_submit')
{
$name=$_POST['name'];
$price='111';
$sort=$_POST['sort'];
$active=$_POST['active'];
if($name==NULL or $price==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
$sql="insert into `shua_tools` (`name`,`price`,`sort`,`active`) values ('".$name."','".$price."','".$sort."','".$active."')";
if($DB->query($sql)){
	showmsg('添加类别成功！<br/><br/><a href="./clist.php">>>返回类别列表</a>',1);
}else
	showmsg('添加类别失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$tid=$_GET['tid'];
$rows=$DB->get_row("select * from shua_tools where tid='$tid' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$name=$_POST['name'];
$price='1';
$sort=$_POST['sort'];
$active=$_POST['active'];
if($name==NULL or $price==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
if($DB->query("update shua_tools set name='$name',price='$price',sort='$sort',active='$active' where tid='{$tid}'"))
	showmsg('修改类别成功！<br/><br/><a href="./clist.php">>>返回类别列表</a>',1);
else
	showmsg('修改类别失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$tid=$_GET['tid'];
$sql="DELETE FROM shua_tools WHERE tid='$tid'";
if($DB->query($sql))
	showmsg('删除成功！<br/><br/><a href="./clist.php">>>返回类别列表</a>',1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

$numrows=$DB->count("SELECT count(*) from shua_tools");
$sql=" 1";
$con='系统共有 <b>'.$numrows.'</b> 个类别<br/><a href="./clist.php?my=add" class="btn btn-primary">添加类别</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>名称</th><th>状态</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM shua_tools WHERE{$sql} order by sort asc");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['tid'].'</b></td><td>'.$res['name'].'</td><td>'.($res['active']==1?'<font color=green>上架中</font>':'<font color=red>已下架</font>').'</td><td><a href="./clist.php?my=edit&tid='.$res['tid'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./clist.php?my=delete&tid='.$res['tid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此商品吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php }?>
    </div>
  </div>