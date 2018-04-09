<?php

//声明命令空间
namespace app\index\model;
//导入系统的数据模型
use think\Model;

use think\model\concern\SoftDelete;


class Info extends Model{

    // 设置当前模型对应的完整数据表名称
    protected $table = 'zk_webinfo';

}