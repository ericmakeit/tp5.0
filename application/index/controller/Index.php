<?php
namespace app\index\controller;

use app\index\model\Info;
use function MongoDB\BSON\toJSON;

use think\Controller;

use app\index\model\User;

use think\Db;

use think\Request;

use think\facade\Session;

use think\Image;

class Index extends Controller
{
    public function index(){
       //return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) 2018新年快乐</h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
        return $this->fetch('/login/index');

    }

    public function loginSuc(){
        //管理员登录成功
        //预先赋个图片文件名
        return $this->fetch();
    }

    public function info(){

        $webInfo = new Info;

        $id = $webInfo->max('id');

        $list = $webInfo::where('id','=',$id)->select();

        //取图片路径
        $img = '/uploads/'.$list['0']['s_logo'];

        if ($list !=""){
            $this->assign('list',$list);

            $this->assign('img',$img);

            return $this->fetch();
        }else{//数据表为空，赋空值给$list，用于表单出首页空单
            $list=array(
                0=>array(
                    'id'=>0,
                    's_maintitle' => '',
                    's_logo' => '',
                    's_url'  => '',
                    's_subtitle' => '',
                    's_keywords' => '',
                    's_description' => '',
                    's_name' => '',
                    's_phone' => '',
                    's_tel' => '',
                    's_400' => '',
                    's_fax' => '',
                    's_qq' => '',
                    's_qqu' => '',
                    's_email' => '',
                    's_address' => '',
                    's_copyright' => ''
                )
            );

            $this -> assign('list',$list);

            return $this->fetch();

        }


    }

    public function addInfo(Request $request){

        $res = 0;

        if ($request->isAjax()){
            //取ID最大值
            $webInfo = new Info;

            //取文件名，没有上传图片赋值为空
            if (!Session::has('picfile')) {
                $picfile = Session::set('picfile',0);
            }else{
                $picfile = Session::get('picfile');
            }

            $infoData = [
                's_maintitle' => $_POST['mtitle'],
                's_logo'      => $picfile,
                's_url'       => $_POST['surl'],
                's_subtitle'  => $_POST['sentitle'],
                's_keywords'  => $_POST['skeywords'],
                's_description' => $_POST['sdescription'],
                's_name'      => $_POST['s_name'],
                's_phone'     => $_POST['s_phone'],
                's_tel'       => $_POST['s_tel'],
                's_400'       => $_POST['s_400'],
                's_fax'       => $_POST['s_fax'],
                's_qq'        => $_POST['s_qq'],
                's_qqu'       => $_POST['s_qqu'],
                's_email'     => $_POST['s_email'],
                's_address'   => $_POST['s_address'],
                's_copyright' => $_POST['scopyright']
            ];

            $result =$webInfo::create($infoData);

            //数据添加成功，返回成功标识符
            $res =1;

            return $res;
        }

    }


    public function chadminpass(){
        //管理员权限更改用户密码，可更改任一用户密码
        $user      =  new User;
        //接收表单数据
        $username  = $_POST['username'];
        $mpass     = $_POST['mpass'];
        $password1 = $_POST['newpass1'];
        $password2 = $_POST['newpass2'];
        if ($username == 'admin'){
            //管理员帐户不可由用户修改
            $this->error('超级管理员帐户，不可修改，请联系管理员！');
            return $this->fetch('index/adminpass');
        }

        $sdata = $user::where('name',$username)->select();

        if ($sdata <> null){
            if ($sdata['0']['password'] <> md5($mpass)){
                //判断原密码输入错误与否
                $this->error('原密码输入错误，请核实后重新输入！');
                return $this->fetch('index/adminpass');
            }
            if ($password1 == $password2){
                $data=[
                    'password' => md5($password1)
                ];
                $user::update($data,['name' => $username]);
                $this->success('用户密码修改成功！');
                $this->fetch('index/adminpass');
            }else{
                //两次密码不一致
                $this->error('两次密码输入不一致！请检查后重新输入');
                $this->fetch('index/adminpass');
            }
        }else{
            //判断无此用户
            $this->error('用户名不存在！请检查后重新输入');
            return $this->fetch('index/adminpass');
        }

    }

    public function adduser(){
        return $this->fetch();
    }

    public function uAdd(Request $request){
        $res = 0;
        if ($request->isAjax()){
            //查数据库最大值，取ID+1后进行数据存储
            //取user表最大ID值
            $id = Db::table('zk_user')->max('id');
            $id = ++$id;
            //取文件名，没有上传图片赋值为空
            if (!Session::has('picfile')) {
               $picfile = Session::set('picfile',0);
            }else{
               $picfile = Session::get('picfile');
            }
            //接收前台$.ajax传来JSON数据对象
            //赋值数组
            $userdata=[
                'id'         => $id,
                'name'       => $_POST['username'],
                'password'   => md5($_POST['password2']),
                'email'      => $_POST['email'],
                'tel'        => $_POST['tel'],
                'qq'         => $_POST['qq'],
                'department' => $_POST['dep'],
                'pic'        => $picfile,
                'address'    => $_POST['add'],
                'note'       => $_POST['note'],
                'delete_time'=> date('0000-00-00 00:00:00')
            ];

            $user = new User;

            $result = $user->save($userdata);

            //数据添加成功，返回成功标识符
            $res =1;

            return $res;

        };

        return $res;

    }


    public function adminpass(){
        //更改管理员账号密码
        return $this->fetch();
    }



    public function brouser(){
        //用户浏览模块
        return $this->fetch();
    }

    public function usrecho(){

        $page = $_GET['page'];
        $limit = $_GET['limit'];

        //user表输出json格式为brouser中的layui表格处理准备\
        $user = model('User');
        $data = $user::where('id','>',0)->page($page)->limit($limit)->select();

        //记得还要取得数据表所有记录的行数
        $count = $user::where('id','>',0)->count();

        //注意需将JSON码转为字符串格式，应使用assoc:false参数转为对象而非数组
        //$data=json_decode($data,false);

        //注意了，返回数据必须加下面
        $res['code']  = 0;
        $res['msg']   = '';
        $res['count'] = $count;
        $res['data']  = $data;

        return json($res);
    }

    public function allDel($id,$done){
        $user = model ('User');
        if (isset($id) && $id <> 0){
            $user::destroy($id,true);
        };

        if ($id == '0' && $done == 'Y') {
            //记得前面还有个delete_time日期时间格式不对，只好每次执行一下
            DB::query("SET GLOBAL sql_mode='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'");
            //重新整理记录ID号顺序
            Db::query('ALTER  TABLE  `zk_user` DROP `id`');
            Db::query('ALTER  TABLE  `zk_user` ADD `id` int(3) PRIMARY KEY NOT NULL AUTO_INCREMENT FIRST;');
        };
        $this->redirect('index/brouser');
    }



    public function upload(){

        $file = $this->request->file('file');

        $info = $file->move('../public/uploads');
        if ($info) {

            $fname = $info->getSaveName();

            //赋值文件名到session会话，以便提交整体表单存入数据库
            Session::set('picfile',$fname);

            //进行图像处理，裁剪为130*168缩略图格式
            $imagefname = '../public/uploads/'.$fname;
            $image = \think\Image::open($imagefname);
            $image->thumb(130,168,\think\Image::THUMB_CENTER)->save($imagefname);

            $result = [
                'code'     => 0,
                'msg'      => '上传成功',
                'filename' => '/public/uploads/' . str_replace('\\', '/', $info->getSaveName()),
                'filepath' => $info->getFilename()
            ];
        } else {
            $result = [
                'code' => -1,
                'msg'  => $file->getError()
            ];
        }

        return json($result);
    }

    public function datacheck($id){

        $user = model('User');
        //查询数据

        $list = $user::where('id',$id)->select();

        //取图片路径
        $img = '/uploads/'.$list['0']['pic'];

        $this->assign('list',$list);

        $this->assign('img',$img);

        return $this->fetch('datacheck',[],['__PUBLIC__'=>'/public/']);

    }

    public function dataedit($id){
        $user = model('User');
        //查询数据

        $list = $user::where('id',$id)->select();

        //取图片路径
        $img = '/uploads/'.$list['0']['pic'];

        //取记录id赋值于会话
        Session::set('usrid',$id);

        $this->assign('list',$list);

        $this->assign('img',$img);

        return $this->fetch('dataedit',[],['__PUBLIC__'=>'/public/']);
    }

    public function usrDataEdit(Request $request){
        $result =[];
        $res = 0;
        $usrid = Session::get('usrid');

        if ($request->isAjax()){

            //取文件名，没有上传图片赋值为空
            if (!Session::has('picfile')) {
                $picfile = Session::set('picfile',0);
            }else{
                $picfile = Session::get('picfile');
            }

            $userdata=[
                'id'         => $usrid,
                'name'       => $_POST['username'],
                'email'      => $_POST['email'],
                'tel'        => $_POST['tel'],
                'qq'         => $_POST['qq'],
                'department' => $_POST['dep'],
                'pic'        => $picfile,
                'address'    => $_POST['add'],
                'note'       => $_POST['note'],
                'delete_time'=> date('0000-00-00 00:00:00')
            ];


            $user = new User;
            //查询数据

            $user = User::where('id',$usrid)->find();

            //更新数据

            $list= $user->save($userdata);

            $res = 1;

        }

        return $res;
    }

    public function userDel($id){
        $res = 0;

        $user = new User;
        //查询数据

        $user::destroy($id);

        $res = 1;

        return $res;

    }


    public function uploadLogo(){

        $file = $this->request->file('file');

        $info = $file->move('../public/uploads');
        if ($info) {

            $fname = $info->getSaveName();

            //赋值文件名到session会话，以便提交整体表单存入数据库
            Session::set('picfile',$fname);

            //进行图像处理，裁剪为130*168缩略图格式
            $imagefname = '../public/uploads/'.$fname;
            $image = \think\Image::open($imagefname);
            $image->thumb(50,55,\think\Image::THUMB_CENTER)->save($imagefname);

            $result = [
                'code'     => 0,
                'msg'      => '上传成功',
                'filename' => '/public/uploads/' . str_replace('\\', '/', $info->getSaveName()),
                'filepath' => $info->getFilename()
            ];
        } else {
            $result = [
                'code' => -1,
                'msg'  => $file->getError()
            ];
        }

        return json($result);
    }


    public function batAddUser(){

        return $this->fetch();

    }

    public function hello() {

        //实例化数据模型

        $user = new \app\index\model\User;

        $list = $user::where('id','>',0)->select();

        echo  json_encode($user,JSON_UNESCAPED_UNICODE);
    }

    public function testupl() {


        return $this->fetch();
    }

}
