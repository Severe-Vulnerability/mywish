<?php
    include 'public.php';
    $method = $_GET['method'];
    $currentPage = $_GET['currentPage'];
    $maxPage = $_GET['maxPage'];
    $GLOBALS['current'] = $currentPage;
    $GLOBALS['max'] = $maxPage;
    //开启output buffering,防止在使用header重定向时出错
    ob_start();
    //根据点击按钮的类型选择不同的处理方法
    switch ($method){
        case '首页':
            return header("location:/index.php");
//            break;
        case '尾页':
            return header("location:/php/last.php");
//            break;
        case '上一页':
            $chPage = 'doPrev';
            break;
        case '下一页':
            $chPage = 'doNext';
            break;
        default: $chPage = 'doDefault';
    }

    function doPrev(){
        if($GLOBALS['current'] == 1) {         //判断当前页面是否为首页或既是首页又是尾页
            return header("location:/index.php");
        }
        resolveCard(--$GLOBALS['current']);
    }
    function doNext(){
        if($GLOBALS['current'] == $GLOBALS['max']) {       //判断当前页面是否是尾页或既是首页又是尾页
            return header("location:/php/last.php");
        }
        resolveCard(++$GLOBALS['current']);
    }
    function doDefault(){
        resolveCard($GLOBALS['current']);
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/jQuery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <title>wish</title>
</head>
<body>
    <?php preRender();?>
    <div class="card-container">
        <?php $chPage();?>
    </div>
    <div class="page">
        <p style="text-align: center">当前位于: <?php echo $GLOBALS['current']?>/<?php echo $maxPage;?></p>
        <div class="page-change">
            <button>首页</button>
            <button>上一页</button>
            <button>下一页</button>
            <button>尾页</button>
        </div>
    </div>
</div>
<div class="footer">
    <p style="text-align: center">Designed by Severe-Vulnerability</p>
    <p style="text-align: center">&copy;2022</p>
</div>
<script src="../js/public.js"></script>
</body>
</html>
