<?php
/**
 * 加黑ＱＱ
**/
$mod='blank';
include("../includes/common.php");
$title='加黑ＱＱ';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
  <div class="container" style="padding-top:70px;">
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
if(isset($_POST['qq'])){
$qq = str_replace(array("\r\n", "\r", "\n"), "[br]", $_POST['qq']);
$match=explode("[br]",$qq);

$c=0;
foreach($match as $val)
{
	$qq=explode('----',$val);
	$qq=trim($qq[0]);
	if($qq=='')continue;
	$sql=$DB->query("update `shua_orders` set `status`='1' where `qq`='{$qq}'");
	$c++;
}
if($sql){
exit("<script language='javascript'>alert('成功将{$c}个QQ改变状态！');history.go(-1);</script>");
}else
exit("<script language='javascript'>alert('添加失败！');history.go(-1);</script>");
} ?>
      <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">添加已完成名单</h3></div>
        <div class="panel-body">
          <form action="./black.php" method="post" class="form-horizontal" role="form">
            <div class="input-group">
              <span class="input-group-addon">ＱＱ</span>
			  <textarea name="qq" class="form-control" rows="6" placeholder="每行一个QQ号" required><?=@$_POST['qq']?></textarea>
            </div><br/>
            <div class="form-group">
              <div class="col-sm-12"><input type="submit" name="submit" value="添加" class="btn btn-primary form-control"/></div>
            </div>
          </form>
        </div>
		<div class="panel-footer">
          <span class="glyphicon glyphicon-info-sign"></span> 在此页面添加的QQ可以改为已完成状态
        </div>
      </div>
    </div>
  </div>