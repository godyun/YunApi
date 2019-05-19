<?php
/*
/**
 * Created by god.
 * User: cnmobi
 * Date: 2019/5/18
 * Time: 16:44
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
        
        if ($app_id == '' || $app_secret == '' || $app_name == '') {  
            return $this->buildFailed ( ReturnCode::NOT_EXISTS, "参数有误" );
        }  
        else{
            
            $row = $count->where('app_id',$app_id)->count();
            if($row>0){  
                return $this->buildFailed ( ReturnCode::NOT_EXISTS, "用户已注册！" );
            } else {  
                $count-> app_id =$app_id;
                $count-> app_secret =$app_secret;
                $count-> app_name = $app_name;
                $count-> app_addTime = time();   
                $lastInsId = $count->save();
                $time = $count->where("app_id",$app_id)->value("app_addTime");
                $time = date("Y-m-d ", $time);
                if($lastInsId){
                    return $this->buildSuccess([
                        'app_id'    => $app_id,
                        'app_secret'    => $app_secret,
                        'app_name'    => $app_name,
                        'app_addTime'  => $time
                    ]);
                } else {
                    return $this->buildFailed ( ReturnCode::NOT_EXISTS, "数据写入错误！" );
                }
                
            }  
        }
    }


}