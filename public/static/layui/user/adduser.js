layui.use(['form', 'layer','upload'], function(){
    var $ = layui.$;
    var form = layui.form
        ,layer  = layui.layer
        ,upload = layui.upload;

    //自定义验证规则
    form.verify({
        username: function(value){ //value：表单的值、item：表单的DOM对象
            if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                return '用户名不能有特殊字符';
            }
            if(/(^\_)|(\__)|(\_+$)/.test(value)){
                return '用户名首尾不能出现下划线\'_\'';
            }
            if(/^\d+\d+\d$/.test(value)){
                return '用户名不能全为数字';
            }
        }
        ,title: function(value){
            if(value.length < 5){
                return '输入的内容至少得5个字符啊';
            }
        }

        ,pass: [
            /(.+){6,12}$/, '密码必须6到12位'
        ]
        ,content: function(value) {
        layedit.sync(editIndex);
        }
        ,qq:[
            /[1-9][0-9]{4,14}/,'QQ号码必须4到14位'
        ]

        ,passvaild: function (value) {

             var passValue =  $('#pass1').val();

             if (value != passValue){
                 return '两次输入密码不一致，请检查后重新输入';
             }

        }

    });


    //监听提交
    form.on('submit(submit1)', function(data){
        //向uAdd方法传递JSON数组
        var usrdata = data.field;

        console.log(usrdata);
        $.ajax({
            url:"uAdd"
            ,dataType: 'json'
            ,data: usrdata
            ,type:'POST'
            ,success: function (res) {
                if (res == 1){
                    layer.msg('数据添加成功！',{
                        icon: 1,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    },function () {
                        window.parent.location.reload();
                       //var index = parent.layer.getFrameIndex(window.name);
                        //parent.layer.close(index);
                    });
                }else{
                    layer.msg('数据添加失败，请检查后台服务器！',{
                        icon: 5,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    });
                }
            }
            ,error: function(XMLHttpRequest, textStatus, errorThrown,msg) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);
                alert(errorThrown);
                alert(msg);
                alert("服务器出错了，请检查数据库服务器！");
            }
            ,end: function () {
                location.reload();
            }

        });

        return false;
    });



    var uploadInst1 = upload.render({
        elem: '#image1' //绑定元素
        ,url: 'upload' //上传接口
        ,size: 50
        ,accecpt: 'images'
        ,auto: true
        ,before: function(obj){
            //预读本地文件，不支持ie8
            obj.preview(function(index, file, result){
                $('#demo1').attr('src', result); //图片链接（base64）
                //console.log(index);
                //console.log(result);
            });
        }
        ,done: function(res){

            console.log(res);

            //上传完毕回调
            //layer.msg(res,{icon:2,time:5000});

        }
        ,error: function(XMLHttpRequest,textStatus,errorThrown,res){

            //请求异常回调
            //alert(XMLHttpRequest.status);
            //alert(XMLHttpRequest.readyState);
            //alert(textStatus);
            //alert(errorThrown);
            //alert(msg);
            layer.msg('图片上传失败，请检查服务运行状况！');
        }
    });

});