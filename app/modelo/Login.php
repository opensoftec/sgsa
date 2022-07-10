<?php

class Login {
    public $usuId;
    public $nombre;
    public $tpuId;
    
    public function __construct($usuId = 0, $nombre = '',$tpuId=0) {
        $this->usuId = $usuId;
        $this->nombre = $nombre;
        $this->tpuId = $tpuId;
    }
    
    public function __get($k) {
        return $this->$k;
        
    }

    public function __set($k, $v) {
        return $this->$k = $v;
    }

    public function __toString() {
        return json_encode($this);
    }
}
