<?php
/**
 * Created by PhpStorm.
 * User: cnmobi
 * Date: 2017/5/31
 * Time: 16:44
 */
namespace app\api\controller;
class Weather extends Base 
{
    /**
     * 获取城市天气预报
     * @return bool|string
     */
    public function get_weather()
    {
		$city = $this->request->param ( "city" );
        $res = file_get_contents("http://api.map.baidu.com/telematics/v3/weather?location={[$city}&output=json&ak=32da004455c52b48d84a3a484c0dbc99");
		 
		 
		 return json_decode($res, true);
		/* if ($res) {
            return $this->buildSuccess ( $res->toArray () );
        } else {
            return $this->buildFailed ( ReturnCode::NOT_EXISTS, "当前用户不存在" );
        } */
        
    }

}