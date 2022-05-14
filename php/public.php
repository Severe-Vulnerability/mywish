<?php
include 'connect.php';
//通过查询记录的总数来得到页面的最大页数
function getMaxPage(){
    $countResult = mysqli_query($GLOBALS['link'],'select count(*) as count from wish');
    $count = mysqli_fetch_assoc($countResult)['count'];
    return $count == 0 ? 1 : ceil($count / 4);
}
//该函数渲染页面中公共部分
function preRender(){
    echo "<div class='header'>许愿墙</div>
    <div class='content'>
        <div class='btn-container'>
            <button data-toggle='modal' data-target='#myModal'>我要许愿</button>
        </div>
        <!-- 许愿模态框 -->
        <div class='modal fade' id='myModal'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <!-- 模态框头部 -->
                    <div class='modal-header'>
                        <h4 class='modal-title'>我要许愿</h4>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <!-- 模态框主体 -->
                    <div class='modal-body'>
                        <div class='body-top'>
                            <div class='top-first'>
                                <p>我的名字:</p>
                                <input type='text' name='name' value='匿名' id='my-name'>
                            </div>
                            <div class='top-second'>
                                <p>贴纸颜色</p>
                                <button style='background-color:green' class='p-color'></button>
                                <button style='background-color:blue' class='p-color'></button>
                                <button style='background-color:red' class='p-color'></button>
                                <button style='background-color:black' class='p-color'></button>
                            </div>
                        </div>
                        <div class='body-bottom'>
                            <p style='margin-top: 15px'>我的愿望</p>
                            <textarea id='my-info' name='wishInfo' cols='20' rows='4' style='width: 100%'
                                      placeholder='80个字符以内(中文占2个字符位)'></textarea>
                        </div>
                    </div>
                    <!-- 模态框底部 -->
                    <div class='modal-footer' style='justify-content: flex-start'>
                        <div>
                            <span>身份识别码： </span>
                            <input type='text' id='my-code' name='password' placeholder='6个字符以内'>
                        </div>
                        <div>
                            <button type='button' class='btn btn-primary' id='submit'
                            style='margin-left: 15px;margin-right: 15px;'>提交</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>取消</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 修改模态框 -->
        <div class='modal fade' id='myModal2'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <!-- 模态框头部 -->
                    <div class='modal-header'>
                        <h4 class='modal-title'>修改许愿</h4>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <!-- 模态框主体 -->
                    <div class='modal-body'>
                        <div class='body-top'>
                            <div class='top-first'>
                                <p>我的名字:</p>
                                <input type='text' id='new-name' name='name' value='匿名'>
                            </div>
                            <div class='top-second'>
                                <p>贴纸颜色</p>
                                <button style='background-color:green' class='new-color'></button>
                                <button style='background-color:blue' class='new-color'></button>
                                <button style='background-color:red' class='new-color'></button>
                                <button style='background-color:black' class='new-color'></button>
                            </div>
                        </div>
                        <div class='body-bottom'>
                            <p style='margin-top: 15px'>我的愿望</p>
                            <textarea id='new-info' name='wishInfo' cols='20' rows='4' style='width: 100%'
                                      placeholder='80个字符以内(中文占2个字符位)'></textarea>
                        </div>
                    </div>
                    <!-- 模态框底部 -->
                    <div class='modal-footer' style='justify-content: flex-start'>
                        <div>
                            <span>身份识别码： </span>
                            <input type='text' id='new-code' name='password' placeholder='6个字符以内'>
                        </div>
                        <div>
                            <button type='button' class='btn btn-primary' id='submit-edit'
                            style='margin-left: 15px;margin-right: 15px;'>提交</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>取消</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 删除模态框 -->
        <div class='modal fade' id='myModal3'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                    <div class='modal-footer' style='justify-content: flex-start'>
                        <div>
                            <span>身份识别码： </span>
                            <input type='text' id='v-code' name='password' placeholder='6个字符以内'>
                        </div>
                        <div>
                            <button type='button' class='btn btn-primary' id='submit-delete'
                                    style='margin-left: 15px;margin-right: 15px;'>提交</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>取消</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       ";
}
//该函数接收当前页数并根据其值渲染页面
function resolveCard($pageNum){
    $begin = ($pageNum - 1) * 4;    //分页初始位置参数为页数减去1再乘以4
    $sql = "select * from wish limit $begin,4";
    $result = mysqli_query($GLOBALS['link'],$sql);
    while($data = mysqli_fetch_assoc($result)){
        echo "
            <div class='card' style='background-color: ".$data['color']."'>
                <div>
                    <a data-toggle='modal' data-target='#myModal2'>✏</a>
                    <a data-toggle='modal' data-target='#myModal3'>❌</a>
                </div>
                <p>FROM: ".$data['name']."</p>
                <hr>
                <p class='card-info'>".$data['content']."</p>
                <p>"."(".resolveTime($data['time']).")"."</p>
            </div>
            ";
    }
}
//对许愿信息中的时间进行处理，使其转换为年月日时分秒的格式
function resolveTime($time){
    $timeList = getdate($time);
    if($timeList['minutes'] < 10) $timeList['minutes'] = "0".$timeList['minutes'];
    return $timeList['year']."-".$timeList['mon']."-".$timeList['mday']." ".$timeList['hours'].":".
        $timeList['minutes'];
}
//验证识别码是否正确
function verify($password){
    if($password == "") return false;
    //使用session来缓存识别码，并通过session中保存的值判断识别码是否正确
    if(isset($_SESSION)){
        return $_SESSION['password'] == $password;
    }
    //从数据库中查询识别码，如果存在则保存到session中并返回真代表识别码正确
    $sql = "select * from wish where password='$password'";
    $result = mysqli_query($GLOBALS['link'],$sql);
    if(mysqli_fetch_assoc($result)){
        session_start();
        $_SESSION['password'] = $password;
        return true;
    }
    return false;
}