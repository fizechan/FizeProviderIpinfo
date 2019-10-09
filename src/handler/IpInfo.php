<?php
namespace ThinkMU\Tool;
/**
 * IP信息类
 */
class IpInfo{
	
	private $_driver;
	
	public $errCode = 0;
	public $errMsg = "";
	
	/**
	 * 构造函数
	 * @param string $p_driver 指定要使用的接口
	 */
	public function __construct($p_driver = "taobao"){
		$this->_driver = $p_driver;
	}
	
	/**
	 * 使用淘宝接口获取IP信息
	 * @param string $p_ip IP地址
	 * @return mixed
	 */
	private function _taobao($p_ip){
		$url = "http://ip.taobao.com/service/getIpInfo.php?ip=" . $p_ip;
		$json = file_get_contents($url);
		if($json){
			$arr = json_decode($json, true);
			if($arr && isset($arr['code']) && $arr['code'] == 0){
				$out = $arr['data'];
			}else{
				$this->errCode = -1;
				$this->errMsg = "淘宝接口错误代码";
				$out = false;
			}
		}else{
			$out = false;
		}
		return $out;
	}
	
	/**
	 * 获取IP信息
	 * @param string $p_ip IP地址
	 * @return mixed
	 */
	public function get($p_ip){
		switch ($this->_driver){
			case 'taobao' :
				return $this->_taobao($p_ip);
			default :
				$this->errCode = 2;
				$this->errMsg = "接口驱动错误";
				return false;
		}
	}
}