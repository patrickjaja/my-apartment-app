<?php

class Users extends api {
    public $autoFunctions=false;

    public function __construct($server) {
        $this->dbinstance=$server->dbinstance;
        $this->sessionProcessor=$server->sessionProcessor;
        $this->out=$server->output;
        parent::__construct($server);
    }
    public function login($params) {
        $sessionID=0;
        $query="SELECT * FROM users WHERE useremail=%s_email AND userpassword=PASSWORD(%s_pass)";
        $validUser = $this->dbinstance->query($query,array("email"=>$params["email"]
                                                    ,"pass"=>$params["pass"]));
        if (isset($validUser[0]["userID"])) {
            $userID=$validUser[0]["userID"];
            $sessionID=$this->sessionProcessor->startSession($userID);
        }
        $this->out->ok($sessionID);
    }
    public function update($params) {
      parent::update($params);
      $response=parent::load($params);
      $this->out->ok($response);
    }
}