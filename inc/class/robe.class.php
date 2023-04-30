<?php
class Robe{
    /*Propriété */
    private string $lib_rob;
    
    public function __construct(string $lib)
    {
        $this->lib_rob = $lib;   
    }

    /*Setter */
    public function setLibelle($lib){
        $this->lib_rob = $lib;
    }

    /*Getter */   
    public function getLibelle(){
        return $this->lib_rob;
    }
    
}