<?php
/**
 * Created by god.
 * User: cnmobi
 * Date: 2019/5/18
 * Time: 16:44
 */
namespace app\api\controller;
use app\util\ReturnCode;

class Weather extends  Base {
    public function getWeatherinfo(){
        $city = $this->request->param ( "city" );
        $weatherinfo = file_get_contents("http://api.map.baidu.com/telematics/v3/weather?location=$city&output=json&ak=32da004455c52b48d84a3a484c0dbc99");
        $weatherinfo =str_replace( "error\":0,\"","",$weatherinfo);
        $weatherinfo =str_replace( "\"status\":\"success\",","",$weatherinfo);
        $weatherinfo =json_decode($weatherinfo , true);
        if ($weatherinfo) {
            return $this->buildSuccess ( $weatherinfo);
	        } else {
            return $this->buildFailed ( ReturnCode::NOT_EXISTS, "查询出错" );
        }
    }
}



?>