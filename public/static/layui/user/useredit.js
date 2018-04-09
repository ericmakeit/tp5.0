layui.use(['form','layer','upload'], function(){
    var $ = layui.$;
    var form = layui.form
        ,layer = layui.layer
        ,upload = layui.upload;

    form.on('submit(submit3)', function(data){res
        var usrdata = data.field;

        console.log(usrdata);

        $.ajax({
            url:'/Index/Index/usrDataEdit'
            ,dataType: 'json'
            ,data: usrdata
            ,type:'POST'
            ,success:function (res) {
                if (res == 1){
                    layer.msg('数据更新成功！',{
                        icon: 1,
                        time: 1000 //2秒关闭（如果不配置，默认是3秒）
                    },function () {
                        window.parent.location.reload();
                        //var index = parent.layer.getFrameIndex(window.name);
                        //parent.layer.close(index);
                    });
                }else{
                    console.log(res);
                    layer.msg('数据更新失败，请检查后台服务器！',{
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
            }
            ,end: function () {
                location.reload();
            }
        });
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });

    form.on('submit(submit4)', function(data){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
        //return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });

    var uploadInst2 = upload.render({
        elem: '#image2' //绑定元素
        ,url: '/Index/Index/upload' //上传接口
        ,size: 100
        ,accecpt: 'images'
        ,auto: true
        ,before: function(obj){
            //预读本地文件，不支持ie8
            obj.preview(function(index, file, result){
                $('#demo2').attr('src', result); //图片链接（base64）
                //console.log(index);
                //console.log(result);
            });
        }
        ,done: function(res){

            console.log(res);

            //上传完毕回调
            //layer.msg(res,{icon:2,time:5000});

        }
        ,error: function(XMLHttpRequest,textStatus,errorThrown,msg){
            //请求异常回调
            //alert(XMLHttpRequest.status);
            //alert(XMLHttpRequest.readyState);
            //alert(textStatus);
            //alert(errorThrown);
            //alert(msg);
            layer.msg('图片上传失败！');
        }
    });


});