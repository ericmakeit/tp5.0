layui.use('table', function(){

    var table = layui.table;

    //第一个实例
    table.render({
        elem: '#idTest'
        ,url: 'usrecho' //数据接口
        ,height:380
        ,cols: [[ //表头
            {type:'checkbox', width:40}
            ,{field:'id', title: 'ID', width:50, sort: true}
            ,{field:'name', title: '用户名', width:100,sort: true}
            ,{field:'department', title: '部门', width:100, sort: true}
            ,{field:'email', title: '邮箱', width:150}
            ,{field:'tel', title: '电话', width:100, sort: true}
            ,{field:'qq', title: 'QQ号', width:80}
            ,{field:'address', title: '地址', width:120}
            ,{field:'note', title: '备注', width: 145}
            ,{fixed: 'right', width:180, align:'center', toolbar: '#barDemo'} //这里的toolbar值是模板元素的选择器
        ]]
        ,page: true
        ,done:function(res, curr, count){
            //如果是异步请求数据方式，res即为你接口返回的信息。
            //如果是直接赋值的方式，res即为：{data: [], count: 99} data为当前页数据、count为数据总长度
            //console.log(res);

            //得到当前页码
            //console.log(curr);

            //得到数据总量
            //console.log(count);
        }
    });


});
