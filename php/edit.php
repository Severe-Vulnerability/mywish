<?php
    include 'public.php';
    $userName = $_GET['name'];
    $paperColor = $_GET['color'];
    $paperInfo = $_GET['info'];
    $passwd = $_GET['password'];
    $createTime = time();
    $currentPage = $_GET['currentPage'];
    //判断识别码是否正确，若没有错误则执行正常修改操作，否则将不做修改并提示错误
    if(!verify($passwd)){
        echo "<script>alert('识别码错误！')</script>";
    }else{
        $sql = "update wish set name='$userName',content='$paperInfo',
                time='$createTime',color='$paperColor' where password='$passwd'";
        mysqli_query($GLOBALS['link'],$sql);
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
        <?php resolveCard($currentPage);?>
    </div>
    <div class="page">
        <p style="text-align: center">当前位于: <?php echo $currentPage?>/<?php echo getMaxPage();?></p>
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
