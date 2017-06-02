<?php
/*
 *
 */
class Apartments extends api {
    public function __construct($server) {
        $this->dbinstance=$server->dbinstance;
        $this->out=$server->output;
        $this->user=$server->sessionProcessor;
        $this->table="apartments";
        parent::__construct($server);
    }
    public function load($params) {
        $response=parent::load($params);
        $this->out->ok($response);
    }
    public function read($params) {
        $response=parent::read($params);
        $this->out->ok($response);
    }
    public function delete($params) {
        $response=parent::delete($params);
        $this->out->ok($response);
    }
    public function insert($params) {
        $lastID=parent::insert($params);
        $response=parent::load(array($this->primaryKey=>$lastID));

        if (isset($response[0]["contact"])) {
            $mailText="Mit diesem Link kannst du deine eben eingetragene Wohnung ".$response[0]["name"]." jederzeit anpassen oder entfernen.";
            $initConst=new stdClass();
            $initConst->dbinstance=$this->dbinstance;
            $initConst->output=$this->out;
            $initConst->sessionProcessor=$this->user;
            $tokenObj=new Token($initConst);
            $theToken=$tokenObj->generateToken($response[0]["apartmentID"]);

            $mailText.=" <a href='$theToken'>Link zur Wohnung</a>";
            //mail($response[0]["contact"], 'Token', $mailText);
        }
        $this->out->ok($response);
    }
    public function readAll($params) {
        return parent::loadAll();
    }
    //ToDo: Check token on Server!!
    public function update($params) {
      parent::update($params);
      $response=parent::load($params);
      $this->out->ok($response);
    }
}