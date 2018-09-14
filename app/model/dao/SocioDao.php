<?php

//$data_source = new DataSource();
//$result = array();
//$result = $data_source->ejecutarQuery("SELECT COUNT(*) AS cantidad FROM socio");
//echo odbc_result($result, "cantidad"); PARA UNA UNICA FILA RETORNADA
/* PARA MUCHAS FILAS RETORNADAS
if($fila = odbc_fetch_array($result)){ //Itera sobre cada una de las filas
    echo $fila['cantidad'];
}
odbc_close_all();
*/

class SocioDao {

    public function selectSocio($idsocio){
        $datasource = new DataSource();
        $socio = null;
        try{
            $sql = "SELECT * FROM socio WHERE idsocio=" . $idsocio;
            $result = $datasource->ejecutarQuery($sql);
            if($fila = odbc_fetch_array($result)){
                $user = $fila['user'];
                $pass = $fila['pass'];
                $nombre = $fila['nombre'];
                $apellido = $fila['apellido'];
                $direccion = $fila['direccion'];
                $telefono = $fila['telefono'];
                $email = $fila['email'];
                $socio = new Socio($user, $pass, $nombre, $apellido,
                                    $direccion, $telefono, $email);
                $socio->setIdSocio($fila['idsocio']);
                $socio->setNumAfiliado($fila['num_afiliado']);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $socio;
    }

    public function selectSocios(){
        $datasource = new DataSource();
        $listaSocio = array();
        $socio = null;
        try{
            $sql = "SELECT * FROM socio";
            $result = $datasource->ejecutarQuery($sql);
            while($fila = odbc_fetch_array($result)){
                $user = $fila['user'];
                $pass = $fila['pass'];
                $nombre = $fila['nombre'];
                $apellido = $fila['apellido'];
                $direccion = $fila['direccion'];
                $telefono = $fila['telefono'];
                $email = $fila['email'];
                $socio = new Socio($user, $pass, $nombre, $apellido,
                                    $direccion, $telefono, $email);
                $socio->setIdSocio($fila['idsocio']);
                $socio->setNumAfiliado($fila['num_afiliado']);
                array_push($listaSocio, $socio);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $listaSocio;
    }

    public function loginSocio($user, $pass){
        $datasource = new DataSource();
        $socio = null;
        try{
            $sql = "SELECT * FROM socio WHERE user='" . $user . "' AND pass='" . $pass . "'";
            $result = $datasource->ejecutarQuery($sql);
            if($fila = odbc_fetch_array($result)){
                $user = $fila['user'];
                $pass = ""; //Por seguridad la envía en blanco
                $nombre = $fila['nombre'];
                $apellido = $fila['apellido'];
                $direccion = $fila['direccion'];
                $telefono = $fila['telefono'];
                $email = $fila['email'];
                $socio = new Socio($user, $pass, $nombre, $apellido,
                                    $direccion, $telefono, $email);
                $socio->setIdSocio($fila['idsocio']);
                $socio->setNumAfiliado($fila['num_afiliado']);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $socio;
    }

    public function registroSocio($user, $pass, $nombre, $apellido, $direccion, $telefono, $email){
        $datasource = new DataSource();
        $resultado = null;
        try{
            $sql = "CALL REGISTRAR_SOCIO('".$user."', '".$pass."', '".$nombre."', '".$apellido."', '".$direccion."', '"
            .$telefono."', '".$email."', @resultado)";
            $respuesta = $datasource->ejecutarQuery($sql);
            if($respuesta!=null){
                //Nos aseguramos que en la BD la consulta haya impactado correctamente
                $respuesta = $datasource->ejecutarQuery("SELECT @resultado AS ok");
                if($fila = odbc_fetch_array($respuesta)) $resultado = $fila['ok'];
            }
            
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $resultado;
    }

}

class ColectivoDao {

    public function traerColectivoLinea($linea){
        $data_source = new DataSource();
        $data_table = $data_source->ejecutarConsulta("SELECT * FROM colectivo WHERE linea = :linea",array(':linea'=>$linea));
        $colectivo = null;

        if(count($data_table) == 1){
            foreach ($data_table as $clave => $valor) {
                $colectivo = new Colectivo( $data_table[$clave]["linea"], $data_table[$clave]["empresa"]);
            }
            return $colectivo;
        }else{
            throw new Exception('linea de colectivo invalida');
        }
    }

    public function traerColectivo($linea){
        $data_source = new DataSource();
        $data_table = $data_source->ejecutarConsulta("SELECT * FROM colectivo WHERE linea = :linea",array(':linea'=>$linea));
        $colectivo = null;

        if(count($data_table) == 1){
            foreach ($data_table as $clave => $valor) {
                $colectivo = new Colectivo( $data_table[$clave]["linea"], $data_table[$clave]["empresa"]);
            }
        }
            return $colectivo;
    }

}

?>
