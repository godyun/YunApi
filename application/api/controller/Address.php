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
class Address  extends  Base 
{
    public function getAddress(){
       	$getIp = $this->request->param ( "ip" );
        $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=enYCQ2yaIIjL8IZfYdA1gi6hK2eqqI2T&ip={$getIp}&coor=bd09ll");
        $json = json_decode($content, true);
        $latitude_longitude=$json['content']['point']['y'].",".$json['content']['point']['x'];
        $address = file_get_contents("http://api.map.baidu.com/geocoder/v2/?ak=enYCQ2yaIIjL8IZfYdA1gi6hK2eqqI2T&location={$latitude_longitude}&output=json&pois=0");
        $Adressinfo= json_decode($address, true);
	 if ($Adressinfo) {
            return $this->buildSuccess ( $Adressinfo);
	        } else {
            return $this->buildFailed ( ReturnCode::NOT_EXISTS, "查询出错" );
        }
    }


}