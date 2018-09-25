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
}

?>
