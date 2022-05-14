//为许愿部分的模态框按钮添加单击事件，实现颜色获取
var color
$('.p-color').click(
    function (e){
        color = e.target.style.backgroundColor
        console.log(color)
    }
)
//为提交许愿的模态框的按钮添加单击事件，获取许愿信息并通过get请求发送给后台处理
$('#submit').click(
    function (){
        var name = $('#my-name').val()
        var info = $('#my-info').val()
        var password = $('#my-code').val()
        window.location.href = "/php/add.php?name=" + name + "&color=" + color + "&info=" +
            info + "&password=" + password
    }
)
//获取修改后的许愿卡片颜色
var newColor
$('.new-color').click(
    function (e){
        newColor = e.target.style.backgroundColor
        console.log(newColor)
    }
)
//给修改许愿模态框的提交按钮绑定单击事件，获取修改后的数据后发送给后端处理
$('#submit-edit').click(function (){
    var newName = $('#new-name').val()
    var newInfo = $('#new-info').val()
    var newPass = $('#new-code').val()
    var currentPage = $('.page p').text().split('/')[0].split(' ')[1]
    window.location.href = "/php/edit.php?name=" + newName + "&color=" + newColor + "&info=" + newInfo +
        "&password=" + newPass + "&currentPage=" + currentPage
})
//给跳转页面按钮（首页、上一页、下一页、尾页）添加单击事件，获取按钮信息和页数信息发送给后端处理
$('.page-change button').click(function (e){
    var method = e.target.innerText
    window.location.href = "/php/jump.php?method=" + method + "&currentPage=" +
        getCurrentPage() + "&maxPage=" + getMaxPage()
})
//给删除许愿模态框的提交按钮添加单击事件，获取用户身份识别码和页数信息后将数据发送后端处理
$('#submit-delete').click(function (){
    var vCdoe = $('#v-code').val()
    window.location.href = "/php/delete.php?password=" + vCdoe + "&currentPage=" + getCurrentPage() +
        "&maxPage=" + getMaxPage()
})
//通过对底部页数信息文字的处理获取当前页码数
function getCurrentPage(){
    return $('.page p').text().split('/')[0].split(' ')[1]
}
//通过对底部页数信息文字的处理获取最大页码数
function getMaxPage(){
    return $('.page p').text().split('/')[1]
}