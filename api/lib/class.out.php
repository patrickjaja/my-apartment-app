<?php

class output
{
    //default output format
    public $format="";
    public $formats=array("json");
    public $starttime=0;

    public function __construct($format) {
        if (!empty($format)) {
            if (in_array($format,$this->formats)) {
                $this->format=$format;
            } else {
                $this->plainError("I dont understand $format.
                                Please use one of this ".json_encode($this->formats));
            }
        } else {
            $this->format=$this->formats[0];
        }
        $this->starttime=microtime(true);
    }

    public function ok($content) {
        $msg=array("status"=>"OK"
                ,"content"=>$content
                ,"performance"=>microtime(true)-$this->starttime);
        if (isset($GLOBALS["_CONFIG"])) {
            $msg=array_merge($GLOBALS["_CONFIG"], $msg);
        }
        $this->sendOutput($msg);
    }
    public function error($content) {
//        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

        $msg=array("status"=>"ERROR"
        ,"content"=>$content
        ,"performance"=>microtime(true)-$this->starttime);
        if (isset($GLOBALS["_CONFIG"])) {
            $msg=array_merge($GLOBALS["_CONFIG"], $msg);
        }
        $this->sendOutput($msg);
    }
    public function plainError($content) {
        die($content);
    }
    private function sendOutput($msg) {
        if ($this->format=="json") {
            echo json_encode($msg);
            //Stop rest, only one output possible atm
            die();
        }
    }
}
