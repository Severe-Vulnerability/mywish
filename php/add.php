<?php
    include './public.php';
    //获取页面传来的许愿信息
    $userName = $_GET['name'];
    $paperColor = $_GET['color'];
    $paperInfo = $_GET['info'];
    $passwd = $_GET['password'];
    $createTime = time();
    //判断用户识别码是否为空，如果为空则提示并返回主页
    if($passwd == ""){
        echo "<script>alert('识别码不能为空！');window.location.href='/index.php'</script>";
        return;
    }
    //判断识别码长度，如果大于6位则提示并返回主页
    if(mb_strlen($passwd) > 6){
        echo "<script>alert('识别码长度不能大于6位！');window.location.href='/index.php'</script>";
        return;
    }
    //通过识别码查询用户是否存在，如果已存在则提示并返回主页
    $sql = "select * from wish where password='$passwd'";
    $result = mysqli_query($GLOBALS['link'],$sql);
    if(mysqli_fetch_assoc($result)){
        echo "<script>alert('识别码已存在！');window.location.href='/index.php'</script>";
        return;
    }
    //如果用户名不存在将其对应字段设为匿名并执行插入数据操作，否则正常拼接sql语句并执行插入数据操作
    if($userName == ""){
        $sql = "insert into wish (name,content,time,color,password)
            values ('匿名','$paperInfo','$createTime','$paperColor','$passwd')";
    }else{
        $sql = "insert into wish (name,content,time,color,password)
            values ('$userName','$paperInfo','$createTime','$paperColor','$passwd')";
    }
    mysqli_query($GLOBALS['link'],$sql);
    $currentPage = getMaxPage();
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
    <title>新增</title>
</head>
<body>
    <?php preRender();?>
    <div class="card-container">
        <?php resolveCard($currentPage);?>
    </div>
    <div class="page">
        <p style="text-align: center">当前位于: <?php echo $currentPage?>/<?php echo $currentPage?></p>
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
