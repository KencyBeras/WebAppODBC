<?php

class Filial implements JsonSerializable {

    private $idfilial;
    private $localidad;
    private $horario_apertura;
    private $horario_cierre;
    private $diames_mantenimiento;

/*
    public function __construct($localidad, $horario_apertura, $horario_cierre,
        $diames_mantenimiento) {
            $this->setLocalidad($localidad);
            $this->setHorario_apertura($horario_apertura);
            $this->setHorario_cierre($horario_cierre);
            $this->setDiames_mantenimiento($diames_mantenimiento);
    }
*/
		public function __construct($idFilial, $localidad, $horario_apertura, $horario_cierre,
        $diames_mantenimiento) {
					  $this->setIdFilial($idFilial);
            $this->setLocalidad($localidad);
            $this->setHorario_apertura($horario_apertura);
            $this->setHorario_cierre($horario_cierre);
            $this->setDiames_mantenimiento($diames_mantenimiento);
    }

    public function getIdfilial(){
        return $this->idfilial;}
    public function setIdfilial($idfilial){
        $this->idfilial = $idfilial;}

    public function getLocalidad(){
        return $this->localidad;}
    public function setLocalidad($localidad){
        $this->localidad = $localidad;}

		public function getHorario_apertura(){
				return $this->horario_apertura;}
		public function setHorario_apertura($horario_apertura){
				$this->horario_apertura = $horario_apertura;}

    public function getHorario_cierre(){
        return $this->horario_cierre;}
    public function setHorario_cierre($horario_cierre){
        $this->horario_cierre = $horario_cierre;}

    public function getDiames_mantenimiento(){
        return $this->diames_mantenimiento;}
    public function setDiames_mantenimiento($diames_mantenimiento){
        $this->diames_mantenimiento = $diames_mantenimiento;}

    public function jsonSerialize() {
        return [
          'idfilial'=>$this->idfilial,
          'localidad' => $this->localidad,
          'horario_apertura' => $this->horario_apertura,
					'horario_cierre' => $this->horario_cierre,
          'diames_mantenimiento' => $this->diames_mantenimiento,
        ];
    }

}


?>
