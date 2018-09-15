<?php

class Socio implements JsonSerializable {

    private $idsocio;
    private $num_afiliado;
    private $user;
    private $pass;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    private $email;

    public function __construct($user, $pass, $nombre,
        $apellido, $direccion, $telefono, $email) {
            $this->setUser($user);
            $this->setPass($pass);
            $this->setNombre($nombre);
            $this->setApellido($apellido);
            $this->setDireccion($direccion);
            $this->setTelefono($telefono);
            $this->setEmail($email);
    }

    public function getIdSocio(){
        return $this->idsocio;}
    public function setIdSocio($idsocio){
        $this->idsocio = $idsocio;}

    public function getNumAfiliado(){
        return $this->num_afiliado;}
    public function setNumAfiliado($num_afiliado){
        $this->num_afiliado = $num_afiliado;}

    public function getUser(){
        return $this->user;}
    public function setUser($user){
        $this->user = $user;}

    public function getPass(){
        return $this->pass;}
    public function setPass($pass){
        $this->pass = $pass;}

    public function getNombre(){
        return $this->nombre;}
    public function setNombre($nombre){
        $this->nombre = $nombre;}

    public function getApellido(){
        return $this->apellido;}
    public function setApellido($apellido){
        $this->apellido = $apellido;}

    public function getDireccion(){
        return $this->direccion;}
    public function setDireccion($direccion){
        $this->direccion = $direccion;}

    public function getTelefono(){
        return $this->telefono;}
    public function setTelefono($telefono){
        $this->telefono = $telefono;}

    public function getEmail(){
        return $this->email;}
    public function setEmail($email){
        $this->email = $email;}


    public function jsonSerialize() {
        return [
          'idsocio'=>$this->idsocio,
          'num_afiliado'=>$this->num_afiliado,
          'user' => $this->user,
          'nombre' => $this->nombre,
          'apellido' => $this->apellido,
          'email' => $this->email,
          'direccion' => $this->direccion,
          'telefono' => $this->telefono
        ];
    }

}


?>
