<?php


namespace fize\provider\ipinfo\handler;

use fize\net\Http;
use fize\crypt\Json;
use fize\provider\ipinfo\IpinfoHandler;
use fize\provider\ipinfo\IpInfo;

/**
 * 淘宝提供的IPinfo服务
 */
class TaoBao extends IpinfoHandler
{

    /**
     * 根据IP返回IP信息
     * @param string $ip IP
     * @return Ipinfo 失败时返回null
     */
    public function get($ip)
    {
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip={$ip}";
        $response = Http::get($url);
        if(!$response) {
            $this->errCode = Http::getLastErrCode();
            $this->errMsg = Http::getLastErrMsg();
            return null;
        }
        $json = Json::decode($response);
        if(!$json) {
            $this->errCode = Json::lastError();
            $this->errMsg = Json::lastErrorMsg();
            return null;
        }
        if(!isset($json['code']) || !isset($json['data'])) {
            $this->errCode = -1;
            $this->errMsg = '未找到预期的值';
            return null;
        }

        if($json['code']) {
            $this->errCode = $json['code'];
            $this->errMsg = '接口错误代码:' . $json['code'];
            return null;
        }
        $data = $json['data'];

        $ipinfo = new IpInfo();
        $ipinfo->ip = $data['ip'];
        $ipinfo->country = $data['country'];
        $ipinfo->region = $data['region'];
        $ipinfo->city = $data['city'];
        $ipinfo->county = $data['county'];
        $ipinfo->area = $data['area'];
        $ipinfo->isp = $data['isp'];
        $ipinfo->countryId = $data['country_id'];
        $ipinfo->regionId = $data['region_id'];
        $ipinfo->cityId = $data['city_id'];
        $ipinfo->countyId = $data['county_id'];
        $ipinfo->areaId = $data['area_id'];
        $ipinfo->ispId = $data['isp_id'];
        return $ipinfo;
    }
}
