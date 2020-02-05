<?php

namespace fize\provider\ipinfo;

/**
 * IP信息库
 */
class IpInfo
{

    /**
     * @var string IP
     */
    public $ip = '';

    /**
     * @var string 国家
     */
    public $country = '';

    /**
     * @var string 省
     */
    public $region = '';

    /**
     * @var string 市
     */
    public $city = '';

    /**
     * @var string 县
     */
    public $county = '';

    /**
     * @var string 区
     */
    public $area = '';

    /**
     * @var string ISP运营商
     */
    public $isp = '';

    /**
     * @var string 国家ID
     */
    public $countryId = '';

    /**
     * @var string 省ID
     */
    public $regionId = '';

    /**
     * @var string 市ID
     */
    public $cityId = '';

    /**
     * @var string 县ID
     */
    public $countyId = '';

    /**
     * @var string 区ID
     */
    public $areaId = '';

    /**
     * @var string ISP运营商ID
     */
    public $ispId = '';

    /**
     * @var IpinfoHandler 接口处理器
     */
    protected static $handler;

    /**
     * 取得单例
     * @param string $handler 使用的实际接口名称
     * @param array $config 配置项
     * @return IpinfoHandler
     */
    public static function getInstance($handler = 'TaoBao', array $config = [])
    {
        if (empty(self::$handler)) {
            $class = '\\' . __NAMESPACE__ . '\\handler\\' . $handler;
            self::$handler = new $class($config);
        }
        return self::$handler;
    }
}
