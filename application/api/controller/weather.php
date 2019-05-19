<?php
/**
 * Created by 贾守彬.
 * User: cnmobi
 * Date: 2019/5/18
 * Time: 16:44
 */
namespace app\api\controller;
use app\util\ReturnCode;

class User weather Base {
    public function getWeatherinfo(){
        $city = $this->request->param ( "city" );
			
        $weatherinfo = file_get_contents("http://api.map.baidu.com/telematics/v3/weather?location=$city&output=json&ak=32da004455c52b48d84a3a484c0dbc99");
		
        if ($weatherinfo) {
            return $this->buildSuccess ( $weatherinfo ->toArray ());
	$this->debug($weatherinfo);
        } else {
            return $this->buildFailed ( ReturnCode::NOT_EXISTS, "查询出错" );
        }
    }
}



?>