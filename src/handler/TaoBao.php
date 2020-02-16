<?php


namespace fize\provider\ipinfo\handler;

use RuntimeException;
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
     * @return Ipinfo
     */
    public function get($ip)
    {
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip={$ip}";
        $response = Http::get($url);
        if (!$response) {
            throw new RuntimeException(Http::getLastErrMsg(), Http::getLastErrCode());
        }
        $json = Json::decode($response);
        if (!$json) {
            throw new RuntimeException(Json::lastErrorMsg(), Json::lastError());
        }
        if (!isset($json['code']) || !isset($json['data'])) {
            throw new RuntimeException('未找到预期的值');
        }

        if ($json['code']) {
            throw new RuntimeException('接口错误代码:' . $json['code'], $json['code']);
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
