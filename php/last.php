<?php
    include 'public.php';
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
    <title>尾页</title>
</head>
<body>
    <?php preRender();?>
    <div class="card-container">
        <?php resolveCard($currentPage);?>
    </div>
    <div class="page">
        <p style="text-align: center">当前位于: <?php echo $currentPage;?>/<?php echo $currentPage;?></p>
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
