<?php
require 'inc.php';

@header('Content-Type: text/html; charset=UTF-8');

$trade_no=daddslashes($_GET['trade_no']);
$sitename=daddslashes($_GET['sitename']);
$row=$DB->get_row("SELECT * FROM shua_pay WHERE trade_no='{$trade_no}' limit 1");
if(!$row)exit('该订单号不存在，请返回来源地重新发起请求！');

require_once(SYSTEM_ROOT."tenpay/RequestHandler.class.php");

/* 创建支付请求对象 */
$reqHandler = new RequestHandler();
$reqHandler->init();
$reqHandler->setKey($conf['qqpay_key']);
$reqHandler->setGateUrl("https://myun.tenpay.com/cgi-bin/wappayv2.0/wappay_init.cgi");

//----------------------------------------
//设置支付参数 
//----------------------------------------
$reqHandler->setParameter("ver", "2.0"); //版本号，ver默认值是1.0
$reqHandler->setParameter("charset", "1"); //1 UTF-8, 2 GB2312
$reqHandler->setParameter("bank_type", "0"); //银行类型
$reqHandler->setParameter("desc", $row['name']); //商品描述，32个字符以内
$reqHandler->setParameter("pay_channel", "1"); //描述支付渠道
$reqHandler->setParameter("bargainor_id", trim($conf['qqpay_pid']));
$reqHandler->setParameter("sp_billno", $trade_no);
$reqHandler->setParameter("total_fee", $row['money']*100);  //总金额
$reqHandler->setParameter("fee_type", "1");               //币种
$reqHandler->setParameter("notify_url", $siteurl.'qqpay_notify.php');

//请求的URL
$reqUrl = $reqHandler->getRequestURL();
$data = get_curl($reqUrl);
if(preg_match("!<token_id>(.*?)</token_id>!",$data,$match)){
	$code_url='https://myun.tenpay.com/mqq/pay/qrcode.html?_wv=1027&_bid=2183&t='.$match[1];
}else{
	preg_match("!<err_info>(.*?)</err_info>!",$data,$match);
	echo '<table class="table"><tobdy><tr><td>QQ钱包支付下单失败！</td></tr><tr><td>'.$match[1].'</td></tr></tbody></table>';
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Language" content="zh-cn">
<meta name="renderer" content="webkit">
<title>QQ钱包安全支付 - <?php echo $sitename?></title>
<link href="css/wechat_pay.css" rel="stylesheet" media="screen">
</head>
<body>
<div class="body">
<h1 class="mod-title">
<span class="text"><img style="width:181px;height:33px;" alt="QQ钱包支付" src="https://img.tenpay.com/v2.0/qr_pay/img/mqq_logo.png"></span>
</h1>
<div class="mod-ct">
<div class="order">
</div>
<div class="amount">￥<?php echo $row['money']?></div>
<div class="qr-image" id="qrcode">
</div>
 
<div class="detail" id="orderDetail">
<dl class="detail-ct" style="display: none;">
<dt>商家</dt>
<dd id="storeName"><?php echo $sitename?></dd>
<dt>购买物品</dt>
<dd id="productName"><?php echo $row['name']?></dd>
<dt>商户订单号</dt>
<dd id="billId"><?php echo $row['trade_no']?></dd>
<dt>创建时间</dt>
<dd id="createTime"><?php echo $row['addtime']?></dd>
</dl>
<a href="javascript:void(0)" class="arrow"><i class="ico-arrow"></i></a>
</div>
<div class="tip">
<span class="dec dec-left"></span>
<span class="dec dec-right"></span>
<div class="ico-scan"></div>
<div class="tip-text">
<p>请使用手机QQ扫一扫</p>
<p>扫描二维码完成支付</p>
</div>
</div>
<div class="tip-text">
</div>
</div>
<div class="foot">
<div class="inner">
<p>手机用户可保存上方二维码到手机中</p>
<p>在手机QQ扫一扫中选择“相册”即可</p>
</div>
</div>
</div>
<script src="js/qrcode.min.js"></script>
<script src="js/qcloud_util.js"></script>
<script>
    var code_url = '<?php echo $code_url?>';
    var qrcode = new QRCode("qrcode", {
        text: code_url,
        width: 230,
        height: 230,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    var	tencentSeries = 'mqqapi://forward/url?src_type=web&style=default&=1&version=1&url_prefix='+window.btoa(code_url);
    var iframe = document.createElement("iframe");
        iframe.setAttribute('frameborder', '0', 0);
        iframe.src = tencentSeries;
        document.body.appendChild(iframe);
    // 订单详情
    $('#orderDetail .arrow').click(function (event) {
        if ($('#orderDetail').hasClass('detail-open')) {
            $('#orderDetail .detail-ct').slideUp(500, function () {
                $('#orderDetail').removeClass('detail-open');
            });
        } else {
            $('#orderDetail .detail-ct').slideDown(500, function () {
                $('#orderDetail').addClass('detail-open');
            });
        }
    });
    // 检查是否支付完成
    function loadmsg() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "getshop.php",
            timeout: 10000, //ajax请求超时时间10s
            data: {type: "qqpay", trade_no: "<?php echo $row['trade_no']?>"}, //post数据
            success: function (data, textStatus) {
                //从服务器得到数据，显示数据并继续查询
                if (data.code == 1) {
					if (confirm("您已支付完成，需要跳转到订单页面吗？")) {
                        window.location.href=data.backurl;
                    } else {
                        // 用户取消
                    }
                }else{
                    setTimeout("loadmsg()", 4000);
                }
            },
            //Ajax请求超时，继续查询
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                if (textStatus == "timeout") {
                    setTimeout("loadmsg()", 1000);
                } else { //异常
                    alert('创建连接失败！');
                }
            }
        });
    }
    window.onload = loadmsg();
</script>
</body>
</html>