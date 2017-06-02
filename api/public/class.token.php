<?php
/*
 * This class is providing a permission access token
 */
class Token extends api {
    public $autoFunctions=false;

    public function __construct($server) {
        $this->dbinstance=$server->dbinstance;
        $this->sessionProcessor=$server->sessionProcessor;
        $this->out=$server->output;
        $this->table="token";
        parent::__construct($server);
    }
    public function generateToken($apartmentID) {
        $token = self::getToken();
        $values=array("token"=>$token,"apartmentID"=>$apartmentID);
        return parent::insert($values);
    }
    public function read($params) {
        $response=parent::read($params);
        $this->out->ok($response);
    }
    public static function getToken() {
        return md5(microtime().rand());
    }
}