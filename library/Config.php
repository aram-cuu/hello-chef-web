<?php

class Config {
    public $appConfig = [];
    public $environment;
    public function __construct(){
        $appConfig = parse_ini_file(__DIR__ . "/../config/application.ini");
        $environment = parse_ini_file(__DIR__ . "/../config/environment.ini");
        $this->appConfig = $appConfig;
        $this->environment = $environment['environment'];
    }

    public  function isDevelopment(){
        if(strpos(strtolower($this->getEnvironment()), 'dev') !== false){
            return true;
        }
        return false;
    }

    public function getEnvironment(){
        if(!isset($this->environment)){
            $this->environment = 'production';
        }
        return $this->environment;
    }

    public function getTopicContext(){
        if($this->isDevelopment()){
            return 'boose';
        }
        return 'hobbies';
    }
}