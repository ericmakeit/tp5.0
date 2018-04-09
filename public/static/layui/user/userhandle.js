layui.use(['table','layer'], function(){
    var $ = layui.$;
    var table = layui.table;
    var layer = layui.layer;

    //监听表格复选框选择
    table.on('checkbox(demo)', function(obj){
        console.log(obj);

    });
    //监听工具条
    table.on('tool(demo)', function(obj){
        var data = obj.data;
        if(obj.event === 'detail'){
            //layer.msg('ID：'+ data.id + ' 的查看操作');
            //layer.alert('ID:'+data + JSON.stringify(data));
            layer.open({
                type:2
                ,title:"用户信息浏览"
                ,maxmin:true
                ,shade:false
                ,area:['1000px','450px']
                ,content: "datacheck/" + JSON.stringify(data.id)
                ,success: function(layero){
                    layer.setTop(layero);
                }
            })

        } else if(obj.event === 'del'){
            layer.confirm('真的删除行么', function(index){
                obj.del();
                console.log(data);
                $.ajax({
                   url:"userDel/"+JSON.stringify(data.id)
                   ,type:'get'
                   ,async:false
                   ,success: function (res) {
                       if (res == 1){
                           layer.msg('数据删除成功！',{icon:1,time:1000})
                       }else{
                           layer.msg('数据删除失败',{icon:2,time:1000})
                       }
                    }

                });
                layer.close(index);
            });
        } else if(obj.event === 'edit'){
            //layer.alert('编辑行：<br>'+ JSON.stringify(data))
            console.log(data);
            layer.open({
                type:2
                ,title:'用户信息编辑'
                ,maxmin:true
                ,area:['1000px','450px']
                ,content:"dataedit/"+JSON.stringify(data.id)
                ,success:function(layero){
                    layer.setTop(layero);
                }
            })
        }
    });

    var $ = layui.$, active = {

        batDelData: function() { //批量删除
            //首生获取选中数目，判断是否可以批量删除
            var checkStatus = table.checkStatus('idTest')
                , data = checkStatus.data;

            if (data.length == 0) {

                layer.alert('没有选中任何数据！请确认您的选择！');
            } else {
                 //定义提示框名称
                var index =layer.open({
                    title: '数据删除确队'
                    , type: 1
                    , area: ['300px', '150px']
                    , content: "<div align='center' style='margin-top: 20px'>是否确定要对选中的数据进行删除?</div>"
                    , btn: ['确认','取消']
                    , yes:function(){
                        //循环删除模型数据，送回thinkphp地址栏
                        for (x in data){
                            //控制台输出数据
                            console.log(data[x].id);
                            var tid = data[x].id;
                            $.ajax({
                                type:"get"
                                ,url:"allDel/"+tid.toString()+"/"+"N"
                                ,async:false
                            });
                        }
                        //删除成功发送成功置位符，数据库ID号清理
                        $.ajax({
                            type:"get"
                            ,url:"allDel/"+"0"+"/"+"Y"
                            ,async:false
                        });
                        var indexmsg = layer.msg('数据删除成功！');

                        setTimeout(function(){
                            //500毫秒之后执行的操作
                            layer.close(indexmsg);
                            layer.close(index);
                        },2000);

                        //表格数据重载

                          table.reload('idTest',{
                              url:'usrecho'
                              ,height:380
                          });


                    }
                    , btn2:function () {
                        layer.close(index)
                    }
                    ,cancel: function(){
                    //右上角关闭回调
                        layer.close(index)
                    //return false 开启该代码可禁止点击该按钮关闭
                }

                })

            }
        }

    };





    $('.demoTable .layui-btn').on('click', function(){
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });


});

