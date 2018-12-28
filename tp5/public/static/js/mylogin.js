/**
 * Created by tanlie on 2018-07-26.
 */

$(function(){
    window.alert = function(name){
        var iframe = document.createElement("IFRAME");
        iframe.style.display="none";
        iframe.setAttribute("src", 'data:text/plain,');
        document.documentElement.appendChild(iframe);
        window.frames[0].window.alert(name);
        iframe.parentNode.removeChild(iframe);
    };
    window.confirm = function (message) {
        var iframe = document.createElement("IFRAME");
        iframe.style.display = "none";
        iframe.setAttribute("src", 'data:text/plain,');
        document.documentElement.appendChild(iframe);
        var alertFrame = window.frames[0];
        var result = alertFrame.window.confirm(message);
        iframe.parentNode.removeChild(iframe);
        return result;
    };

    $('#admin_user').focus();
    $('#submit').on('click',function(e){
        e.preventDefault();
        var admin_user = $("input[name='admin_user']").val();
        var admin_pass = $("input[name='admin_pass']").val();
        if(admin_user == ""){
            $('#admin_user').focus();
            alert('管理员账号不能为空');
            return false;
        }
        if(admin_pass == ""){
            $('#admin_pass').focus();
            alert('密码不能为空');
            return false;
        }

        $.ajax({
            url : "checkAdmin",
            type : 'POST',
            data : $('form').serialize(),
            success : function(data){
                if(data.code == 200){
                    //alert('gogogog');
                    window.location.href='../Index/index';
                    //window.location.href='super/Index/index';
                } else if(data.code == 300){      //超超级管理员路径
                    window.location.href='../../super/Index/index';
                }   else {
                    alert(data.msg);
                    return false;
                }
            },
            error : function(err){
                console.log(err);
            }
        });



    });

    $(document).keyup(function(event){
        if(event.keyCode ==13){
            var admin_user = $("input[name='admin_user']").val();
            var admin_pass = $("input[name='admin_pass']").val();
            if(admin_user == ""){
                $('#admin_user').focus();
                alert('管理员账号不能为空');
                return false;
            }
            if(admin_pass == ""){
                $('#admin_pass').focus();
                alert('密码不能为空');
                return false;
            }
            $("#submit").trigger("click");
        }
    });



});