<?php

class DataSource {

	private $dsn;
	private $user;
	private $pass;

	/**
	 * Metodo contructor para iniciar nuestra conexion con la base de datos.
	 **/
	public function __construct(){
            $this->dsn = "bdsistemaclub";
            $this->user= "";
            $this->pass= "";
	}

	public function ejecutarQuery($sql){
		$result = null;
		try{
			//$conn=odbc_connect($this->dsn,$this->user,$this->pass);
      $conn=odbc_connect($this->dsn,'','');
			if(!$conn) throw new Exception("error al conectarse al origen de datos");
			$result=odbc_exec($conn, $sql);
			if(!$result) throw new Exception("error al realizar la consulta: " . $sql);
		}
		catch(Exception $e){
			echo $e->getMessage();
			odbc_close_all();
		}
		finally{
			return $result;
		}
	}

	/**
	 * Metodo que nos permitira traer un registro de nuestra base de datos.
	 * Usamos PDO en PHP.
	 * @param $sql Sentencia SQL.
	 * @param $values Arreglo de bindValues de PDO para la consulta SQL.
	 * @return $tabla_datos Registros de nuestra base de datos de 0 a N.
	 * */
	public function ejecutarConsulta($sql = "",$values = array()){
		if($sql != ""){
			$consulta = $this->conexion->prepare($sql);
			$consulta->execute($values);
			$tabla_datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
			return $tabla_datos;
		}else{
			return 0;
		}
	}

	/**
	 * Metodo que nos permitira obtener un entero de las tablas afectadas, 0 indica que no
	 * paso nada.
	 * Usamos PDO en PHP.
	 * @param $sql Sentencia SQL.
	 * @param $values Arreglo de bindValues de PDO para la consulta SQL.
	 * @return $numero_tablas_afectadas Numero entero de las tablas afectadas de 0 a N.
	 * */
	public function ejecutarActualizacion($sql = "",$values = array()){
		if($sql != ""){
			$consulta = $this->conexion->prepare($sql);
			$consulta->execute($values);
			$numero_tablas_afectadas = $consulta->rowCount();
			return $numero_tablas_afectadas;
		}else{
			return 0;
		}
	}
}

?>
