<?php

class Playa implements JsonSerializable {
    
    private $idplaya;
    private $playa;
    private $lstingresos = array();
    
    public function __construct($playa = "") {
        $this->playa = $playa;
    }
    
    public function getIdplaya(){
        return $this->idplaya;}
    public function setIdplaya($idplaya){
        $this->idplaya = $idplaya;}

    public function getPlaya(){
        return $this->playa;}
    public function setPlaya($playa){
        $this->playa = $playa;}

    public function getLstingresos(){
        return $this->lstingresos;}
    public function setLstingresos($lstingresos){
        $this->lstingresos = $lstingresos;}

    
    public function jsonSerialize() {
        return [
          'id'=>$this->idplaya,  
          'playa' => $this->playa  
        ];
    }
  
    public function unjsonSerialize($json) {
        if(isset($json)){
            $this->idplaya = $json->id;
            $this->playa= $json->playa;
        }
    }
    
}


?>