<?php

namespace fize\provider\ipinfo;

/**
 * 定义IP库处理器方法接口
 * @package fize\provider\ipinfo
 */
abstract class IpinfoHandler
{

    /**
     * @var array 配置
     */
    protected $config;

    /**
     * @var int 错误码
     */
    protected $errCode = 0;

    /**
     * @var string 错误信息
     */
    protected $errMsg = '';

    /**
     * 构造方法
     * @param array $config 配置
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * 获取最后的错误码
     * @return int
     */
    public function getErrCode()
    {
        return $this->errCode;
    }

    /**
     * 获取最后的错误信息
     * @return string
     */
    public function getErrMsg()
    {
        return $this->errMsg;
    }

    /**
     * 根据IP返回IP信息
     * @param string $ip IP
     * @return Ipinfo 失败时返回null
     */
    abstract public function get($ip);
}