<?php
//声明命名空间
namespace app\index\controller;

//引入控制器
use think\Controller;

use think\Db;

use think\facade\Session;

//声明控制器
class Login extends Controller{

    public function index(){

        //加载登录页面

        return view();
    }

    //处理登录的提交页面

    public function check(){

        //接受表单传来数据
        $username  = $_POST['name'];
        $password  = md5($_POST['password']);
        //设置全局会话用户名
        session('user',$username);
        session('lsuccess',0);
        //判断是否满足登录条件
        if ($username == "admin" && $password == "7488e331b8b64e5794da3fa4eb10ad5d"){
            //默认系统管理员（库用户表中无此管理员，内置）
            //页面跳转格式 $this->success(提示信息,跳转地址,用户自定义,跳转时间,header信息）
            session('lsuccess',1);
            $this->success('管理员登录成功！',url('/Index/Index/loginSuc'));
        }else{
            //判断是否为数据库合法用户
            $logindata = Db::table('zk_user')->where('name',$username)->where('password',$password)->select();
            if($logindata == null){
                //非合法用户，给出登录错误页面
                $this->error('用户名或密码错误！',url('/Index/Login/index'));
            }else{
                //合法用户，跳转至二级权限普通用户操作页面
                session('lsuccess',1);
                $this->success('普通用户登录成功！',url('Index/User/index'));
            }


        }
    }

}

