<?php

class Cancha implements JsonSerializable {

    private $idCancha;
    private $idFilial;
    private $numcancha;
    private $deporte;
    private $categoria;

    public function __construct($idCancha, $idFilial,
     $numcancha, $deporte, $categoria ) {
            $this->setIdCancha($idCancha);
            $this->setIdFilial($idFilial);
            $this->setNumCancha($numcancha);
            $this->setDeporte($deporte);
            $this->setCategoria($categoria);
    }

    public function getIdCancha(){
        return $this->idCancha;}
    public function setIdCancha($idCancha){
        $this->idCancha = $idCancha;}

    public function getIdFilial(){
        return $this->idFilial;}
    public function setIdFilial($idFilial){
        $this->idFilial = $idFilial;}

    public function getNumCancha(){
        return $this->numcancha;}
    public function setNumCancha($numcancha){
        $this->numcancha = $numcancha;}

    public function getDeporte(){
        return $this->deporte;}
    public function setDeporte($deporte){
        $this->deporte = $deporte;}

    public function getCategoria(){
        return $this->categoria;}
    public function setCategoria($categoria){
        $this->categoria = $categoria;}


    public function jsonSerialize() {
        return [
          'idCancha'=>$this->idCancha,
          'idFilial' => $this->idFilial,
          'numcancha'=>$this->numcancha,
          'deporte'=>$this->deporte,
          'categoria' => $this->categoria,

        ];
    }

}


?>
