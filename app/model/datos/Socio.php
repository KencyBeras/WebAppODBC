<?php
	
class Socio implements JsonSerializable {
    
    private $idsocio;
    private $num_afiliado;
    private $user;
    private $password;
    private $nombre;
    private $apellido;
    private $direccion;
    private $telefono;
    private $email;
    
    public function __construct($user, $password, $nombre, 
        $apellido, $direccion, $telefono, $email) {
            $this->$user = $user;
            $this->$password = $password;
            $this->$nombre = $nombre;
            $this->$apellido = $apellido;
            $this->$direccion = $direccion;
            $this->$telefono = $telefono;
            $this->$email = $email;
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

    public function getPassword(){
        return $this->password;}
    public function setPassword($password){
        $this->password = $password;}

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
          'user' => $this->user  
        ];
    }

}


?>