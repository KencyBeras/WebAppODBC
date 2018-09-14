<?php

class Turno implements JsonSerializable {

    private $idturno;
    private $idfilial;
    private $idcancha;
    private $idsocio;
    private $fechahora;

    public function __construct($idturno, $idfilial, $idcancha, $idsocio, $fechahora) {
            $this->setIdTurno($idturno);
            $this->setIdFilial($idfilial);
            $this->setIdCancha($idcancha);
            $this->setIdSocio($idsocio);
            $this->setFechahora($fechahora);
    }

    public function getIdTurno(){
        return $this->idturno;}
    public function setIdTurno($idturno){
        $this->idturno = $idturno;}

        public function getIdFilial(){
            return $this->idfilial;}
        public function setIdFilial($idfilial){
            $this->idfilial = $idfilial;}

    public function getIdCancha(){
        return $this->idcancha;}
    public function setIdCancha($idcancha){
        $this->idcancha = $idcancha;}

    public function getIdSocio(){
        return $this->idsocio;}
    public function setIdSocio($idsocio){
        $this->idsocio = $idsocio;}

    public function getFechahora(){
        return $this->fechahora;}
    public function setFechahora($fechahora){
        $this->fechahora = $fechahora;}



    public function jsonSerialize() {
        return [
          'idturno'=>$this->idturno,
          'idfilial'=>$this->idfilial,
          'idcancha' => $this->idcancha,
          'idsocio'=>$this->idsocio,
          'fechahora' => $this->fechahora,
        ];
    }

}


?>
