<?php
    include './php/public.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <script src="./js/jQuery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <title>主页</title>
</head>
<body>
    <?php preRender();//调用preRender函数渲染相同的页面部分?>
        <div class="card-container">
            <?php resolveCard(1);//调用该函数实现根据页码动态渲染页面?>
        </div>
        <div class="page">
            <p style="text-align: center">当前位于: 1/<?php echo getMaxPage();//获取最大页数?></p>
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
    <script src="./js/public.js"></script>
</body>
</html>