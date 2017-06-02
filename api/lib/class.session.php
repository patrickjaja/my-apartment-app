<?php

class session
{
    public $table="sessions";
    public $sesionObj=false;

    public function __construct($db) {
        $this->dbinstance=$db;
    }

    public function startSession($userID) {
        $key = md5(microtime().rand());
        $this->dbinstance->insert($this->table,array("userID"=>$userID,"sessionKey"=>$key));
        $insertedID=$this->dbinstance->insertId();
        $query="SELECT * FROM ".$this->table." WHERE sessionID=%i_id";
        $validUser = $this->dbinstance->query($query,array("id"=>$insertedID));
        return $validUser;
    }

    public function isValid($skey) {
        $valid=false;
        $query="SELECT * FROM ".$this->table." WHERE sessionKey=%s_skey";
        $row = $this->dbinstance->query($query,array("skey"=>$skey));
        if(isset($row[0]["sessionID"])) {
            $this->sesionObj=$row[0];
            $valid=true;
        }
        return $valid;
    }
    public function stopSession($userID) {

    }
}
