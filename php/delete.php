<?php
    include 'public.php';
    $passwd = $_GET['password'];
    $currentPage = $_GET['currentPage'];
    $maxPage = $_GET['maxPage'];
    ob_start();
    //验证识别码是否正确，若错误则提示并返回到之前的页面
    if(!verify($passwd)){
        echo "<script>alert('识别码错误！');window.location.href='/php/jump.php?method=&currentPage=' +
            $currentPage + '&maxPage=' + $maxPage</script>";
        return;
    }
    $sql = "delete from wish where password='$passwd'";
    mysqli_query($GLOBALS['link'],$sql);
    $maxPage = getMaxPage();
    //当当前页面页码数大于最大页码数时，删除当前愿望会导致该页面为空且位于最大页之后，此时需要自动跳转至首页
    if($currentPage > $maxPage) return header("location:/index.php");
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
        <?php resolveCard($currentPage);?>
    </div>
    <div class="page">
        <p style="text-align: center">当前位于: <?php echo $currentPage;?>/<?php echo $maxPage;?></p>
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