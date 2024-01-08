<?php

namespace Nazmul\Mail\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;


class Data extends \Magento\Framework\App\Helper\AbstractHelper {

    const SECTION_GROUP  = 'smtp_failover_config/general/';

    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
         ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function get_smtp_coll(){
       $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
       $smtp_coll = $this->scopeConfig->getValue(self::SECTION_GROUP .'smtp_field',$storeScope);
        $smtp_coll= json_decode($smtp_coll, true);
        $smtpResult = [];
        if(is_array($smtp_coll)){
            foreach ($smtp_coll as $smtp) {
                $data = array(
                    'smtp'    => $smtp['smtp'],
                    'port'    => $smtp['port'],
                    'auth'    => $smtp['auth'],
                    'user'    => $smtp['user'],
                    'password'  => $smtp['password'],
                    'ssl'    => $smtp['ssl']
                );

                $smtpResult[] = $this->process_smtp($data);

            }
        }
        return $smtpResult;
    }





    public function get_conn_name(){
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::SECTION_GROUP .'conn_name',$storeScope);
    }

    public function allowExtension(){
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        return $this->scopeConfig->getValue(self::SECTION_GROUP .'enable_smtp',$storeScope);
    }

    private function process_smtp($data){
        $name = trim($this->get_conn_name());

        if($data['auth']==''||$data['auth']==null||$data['auth']=='0' ){
           return[
                'name'              => $name,
                'host'              => $data['smtp'],
                'port'              => $data['port'],
            ];
        }

        else{
           return [
                'name' =>$name,
                'host' => $data['smtp'],
                'port'=>(int)$data['port'],
                'connection_class' => $data['auth'],
                'connection_config' => [
                    'username' => $data['user'],
                    'password' => $data['password'],
                    'ssl' =>  $data['ssl']
                ]
            ];
        }
    }
}
