<?php
include("./includes/common.php");
include("./includes/txprotect.php");
$qq = isset($_GET['qq']) ? strip_tags($_GET['qq']) : null;

$rs = $DB->query("SELECT * FROM shua_tools WHERE 1 order by sort asc");
$select = '';
while ($res = $DB->fetch($rs)) {
    $shua_func[$res['tid']] = $res['name'];
    $select .= '<option value="' . $res['tid'] . '" price="' . $res['price'] . '">' . $res['name'] . '</option>';
}
@header('Content-Type: text/html; charset=UTF-8');
?>
<?php
$count1 = $DB->count("SELECT count(*) from shua_orders");
$count2 = $DB->count("SELECT count(*) from shua_orders where status=1");
$count3 = $DB->count("select count(*) from shua_orders where status=2");
$mysqlversion = $DB->count("select VERSION()");
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1"/>
    <title><?php echo $conf['sitename'] ?>
        - <?php echo $conf['title'] ?></title>
    <meta name="keywords" content="<?php echo $conf['keywords'] ?>">
    <meta name="description"
          content="<?php echo $conf['description'] ?>">
    <script src="/assets/js/jquery-1.11.1.min.js"></script>
    <script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/datepicker3.css" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="/assets/js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
    <style>
        div{
            /*background-color:rgba(255, 255, 255, 0.5);
            background-repeat: no-repeat;*/
        }
    </style>
</head>

<body>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>QQ业务</span>下单平台</a>
           <!-- <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="/admin" class="dropdown-toggle"
                       data-toggle="dropdown">
                        <svg class="glyph stroked male-user">
                            <use xlink:href="#stroked-male-user"></use>
                        </svg>
                        管理后台<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/admin">
                                <svg class="glyph stroked male-user">
                                    <use xlink:href="#stroked-male-user"></use>
                                </svg>
                                管理后台</a></li>
                    </ul>
                </li>
            </ul>-->
        </div>
    </div>

    </div><!-- /.container-fluid -->
</nav>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">

    <ul class="nav menu">
        <li class="active"><a href="index.php">
                <svg class="glyph stroked dashboard-dial">
                    <use xlink:href="#stroked-dashboard-dial"></use>
                </svg>
                在线下单</a></li>
        <!--<li><a href="kami.php">
                <svg class="glyph stroked calendar">
                    <use xlink:href="#stroked-calendar"></use>
                </svg>
                卡密下单</a></li>-->

        <li><a href="cxqq.php">
                <svg class="glyph stroked star">
                    <use xlink:href="#stroked-star"></use>
                </svg>
                订单查询</a></li>
        <li class="parent " style="display:none;">
            <a href="">
                <span data-toggle="collapse" href="#sub-item-1"><svg
                            class="glyph stroked chevron-down"><use
                                xlink:href="#stroked-chevron-down"></use></svg></span>
                搭建平台
            </a>
        </li>
        <li role="presentation" class="divider"></li>
        <!--<li><a href="/admin">
                <svg class="glyph stroked male-user">
                    <use xlink:href="#stroked-male-user"></use>
                </svg>
                管理后台</a></li>-->
    </ul>

</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a></li>
            <li class="active">在线下单</li>
        </ol>
    </div><!--/.row-->

    <!--<div class="row">
        <div class="col-xs-6 col-md-6 col-lg-3">
            <div class="panel panel-blue panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked bag">
                            <use xlink:href="#stroked-bag"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <?php /*echo $count1 */?>条</font></td>
                        <div class="text-muted">订单总数</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked empty-message">
                            <use xlink:href="#stroked-empty-message"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <?php /*echo $count2 */?>条</font></td>
                        <div class="text-muted">已处理订单</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked male-user">
                            <use xlink:href="#stroked-male-user"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <?php /*echo $count1 - $count2 */?>条</font></td>
                        <div class="text-muted">待处理订单</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <svg class="glyph stroked app-window-with-content">
                            <use xlink:href="#stroked-app-window-with-content"></use>
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <SCRIPT language=JavaScript>
                            var urodz = new Date("2017/5/10");
                            var now = new Date();
                            var ile = now.getTime() - urodz.getTime();
                            var dni = Math.floor(ile / (1000 * 60 * 60 * 24));
                            document.write(+dni)</script>
                        天</font></td>
                        <div class="text-muted">运营时间</div>
                    </div>
                </div>
            </div>
        </div>
    </div>--><!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading  panel-blue">平台公告</div>
                <div class="panel-body">
                    <?php echo $conf['anounce'] ?>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade in active" id="onlinebuy">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">选择商品：</div>
                        <select name="tid" id="tid"
                                class="form-control"
                                ><?php echo $select ?></select>
                    </div>
                </div>
                <!--<div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">商品价格</div>
                        <input type="text" name="need" id="need"
                               class="form-control" disabled/>
                    </div>
                </div>-->
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">要刷的QQ：</div>
                        <input type="text" name="qq" id="qq1"
                               value="<?php echo $qq ?>"
                               class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">卡密：</div>
                        <input type="text" name="km" id="km"
                               value=""
                               class="form-control" required
                               placeholder="请输入卡密"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">手机号：</div>
                        <input type="text" name="tel" id="tel"
                               value=""
                               class="form-control" required
                               placeholder="手机号用于开通后短信通知"/>
                    </div>
                </div>
                <!--<div id="pay_frame" class="form-group text-center"
                     style="display:none;">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">订单号</div>
                            <input class="form-control" name="orderid"
                                   id="orderid" value="" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">共需支付</div>
                            <input class="form-control" name="needs"
                                   id="needs" value="" disabled>
                        </div>
                    </div>
                    <div class="alert alert-success">
                        订单保存成功，请点击以下链接支付！
                    </div>
                    <?php
/*                    if ($conf['alipay_api']) echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img src="assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
                    if ($conf['qqpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img src="assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
                    if ($conf['wxpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
                    if ($conf['tenpay_api']) echo '<button type="submit" class="btn btn-default" id="buy_tenpay"><img src="assets/icon/tenpay.ico" class="logo">财付通</button>&nbsp;';
                    */?>
                </div>-->
                <input type="submit" id="submit_buy"
                       class="btn btn-primary btn-block" value="立即下单">
            </div>

        </div>
    </div>

</div>
</div>    <!--/.main-->
<script type="text/javascript">
//    function getPoint() {
//        var price = $('#tid option:selected').attr('price');
//        $('#need').val('￥' + price);
//    }
    //getPoint();

    function checkPhone(phone){
        if(!(/^1[34578]\d{9}$/.test(phone))){
            return false;
        }
        return true;
    }
    function checkqq(qq){
        if(!(/[1-9][0-9]{4,}/.test(qq))){
            return false;
        }
        return true;
    }
    $(document).ready(function () {
        $("#submit_buy").click(function () {
            var tid = $("#tid").val();
            var qq = $("#qq1").val();
            var km = $("#km").val();
            var tel = $("#tel").val();
            if (qq == '' || tid == '' || km == '' || tel == '') {
                alert('请确保每项不能为空！');
                return false;
            }
            if (checkqq(qq) === false) {
                alert('请输入正确的QQ号！');
                return false;
            }
            if (checkPhone(tel) === false) {
                alert('请输入正确的手机号！');
                return false;
            }
            $('#pay_frame').hide();
            $('#submit_buy').val('Loading');
            $.ajax({
                type: "POST",
                url: "ajax.php?act=submit",
                data: {tid: tid, qq: qq, km: km, tel: tel},
                dataType: 'json',
                success: function (data) {
                    if (data.code == 0) {
                        $('#tid').attr("disabled", true);
                        $('#qq1').attr("disabled", true);
                        //$('#submit_buy').hide();
                        //$('#orderid').val(data.trade_no);
                        //$('#needs').val("￥" + data.need);
                        //$("#pay_frame").slideDown();
                        alert(data.msg);
                    } else {
                        alert(data.msg);
                    }
                    $('#submit_buy').val('立即购买');
                }
            });
        })
        $("#buy_alipay").click(function () {
            var orderid = $("#orderid").val();
            window.location.href = 'other/submit.php?type=alipay&orderid=' + orderid;
        });
        $("#buy_qqpay").click(function () {
            var orderid = $("#orderid").val();
            window.location.href = 'other/submit.php?type=qqpay&orderid=' + orderid;
        });
        $("#buy_wxpay").click(function () {
            var orderid = $("#orderid").val();
            window.location.href = 'other/submit.php?type=wxpay&orderid=' + orderid;
        });
        $("#buy_tenpay").click(function () {
            var orderid = $("#orderid").val();
            window.location.href = 'other/submit.php?type=tenpay&orderid=' + orderid;
        });
        var isModal =<?php echo empty($conf['modal']) ? 'false' : 'true';?>;
        if (!$.cookie('op') && isModal == true) {
            $('#myModal').modal({
                keyboard: true
            });
            var cookietime = new Date();
            cookietime.setTime(cookietime.getTime() + (10 * 60 * 1000));
            $.cookie('op', false, {expires: cookietime});
        }
    });
</script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/chart-data.js"></script>
<script src="assets/js/easypiechart.js"></script>
<script src="assets/js/easypiechart-data.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
</div>


</div>
</body>
</html>