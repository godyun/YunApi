<?php
/*
/**
 * Created by god.
 * User: god
 * Date: 2019/5/19
 * Time: 21:19
 */

namespace app\api\controller;
use app\util\ReturnCode;
use app\model\AdminApp;
class Reg  extends  Base 
{
    public function addUser(){
        $count = new AdminApp();
        //获取用户注册信息
        $app_id = $this->request->param ( "app_id" );
        $app_secret = $this->request->param ( "app_secret" );
        $app_name = $this->request->param ( "app_name" );
        $appsecret=$app_secret;
        if ($app_id == '' || $app_secret == '' || $app_name == '') {  
            return $this->buildFailed ( ReturnCode::NOT_EXISTS, "参数有误" );
        }  
        else{
            
            $row = $count->where('app_id',$app_id)->count();//判断是否已注册
            if($row>0){  
                return $this->buildFailed ( ReturnCode::NOT_EXISTS, "用户已注册！" );
            } else {  
                $count-> app_id =$app_id;
                $count-> app_secret =$app_secret;
                $count-> app_name = $app_name;
                $count-> app_addTime = time();   //对数据进行入库

                if($lastInsId = $count->save()){
					$time = $count->where("app_id",$app_id)->value("app_addTime");
					$time = date("Y-m-d ", $time);
					$appid  = $this->request->param ( "app_id" );
					$appname = $app_name = $this->request->param ( "app_name" );
                    return $this->buildSuccess([//接口返回参数
                        'app_id'    => $appid,
                        'app_secret'    => $appsecret,
                        'app_name'    => $appname,
                        'app_addTime'  => $time
                    ]);
                } else {
                    return $this->buildFailed ( ReturnCode::NOT_EXISTS, "数据写入错误！" );
                }
                
            }  
        }
    }


}