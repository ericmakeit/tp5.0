<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Session;

class User extends Controller
{
    public function index(){

        return $this->fetch();
    }

    public function userpass(){

        return $this->fetch();
    }

    public function chuserpass(){
        //普通用户权限更改用户密码，仅任一用户密码
        //接收表单数据
        $username              = session('user');
        $mpass                 = $_POST['mpass'];
        $password1             = $_POST['newpass1'];
        $password2             = $_POST['newpass2'];
        $sdata = Db::table('zk_user')->where('name',$username)->select();

        if ($sdata[0]['password']<> md5($mpass)){
            //原始密码不符
            $this->error('原始密码不符，请核实后重新输入！');
            $this->fetch('user/userpass');
        }else{
            if ($password1 <> $password2){
                //两次密码输入不一致
                $this->error('两次密码输入不一致，请核实后重新输入');
                $this->fetch('user/userpass');
            }else{
                //密码一致后更改密码
                $data=[
                    'password' => md5($password1)
                ];
                Db::table('zk_user')
                    ->where('name',$username)
                    ->data($data)
                    ->update();
                $this->success('密码更改成功！请重新登录');
                $this->fetch('user/userpass');
            }

        }
    }
}
