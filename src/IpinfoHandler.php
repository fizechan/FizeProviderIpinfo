<?php

namespace fize\provider\ipinfo;

/**
 * 定义IP库处理器方法接口
 */
abstract class IpinfoHandler
{

    /**
     * @var array 配置
     */
    protected $config;

    /**
     * 构造方法
     * @param array $config 配置
     */
    public function __construct(array $config = null)
    {
        $this->config = $config;
    }

    /**
     * 根据IP返回IP信息
     * @param string $ip IP
     * @return Ipinfo
     */
    abstract public function get($ip);
}
