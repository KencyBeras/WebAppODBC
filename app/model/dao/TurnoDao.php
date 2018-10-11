<?php

//$data_source = new DataSource();
//$result = array();
//$result = $data_source->ejecutarQuery("SELECT COUNT(*) AS cantidad FROM turno");
//echo odbc_result($result, "cantidad"); PARA UNA UNICA FILA RETORNADA
/* PARA MUCHAS FILAS RETORNADAS
if($fila = odbc_fetch_array($result)){ //Itera sobre cada una de las filas
    echo $fila['cantidad'];
}
odbc_close_all();
*/

class TurnoDao {

    public function selectTurnos(){
        $datasource = new DataSource();
        $listaTurno = array();
        $turno = null;
        try{
            $sql = "SELECT * FROM turno";
            $result = $datasource->ejecutarQuery($sql);
            while($fila = odbc_fetch_array($result)){
                $idTurno = $fila['idturno'];
                $idFilial = $fila['idfilial'];
                $idCancha = $fila['idcancha'];
                $idSocio = $fila['idsocio'];
                $fechahora = $fila['fechahora'];
                $estado = $fila['estado'];
                $turno = new Turno($idTurno, $idFilial, $idCancha, $idSocio, $fechahora, $estado);

                array_push($listaTurno, $turno);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $listaTurno;
    }

    public function selectTurnosBetween($fechaDesde, $fechaHasta){
        $datasource = new DataSource();
        $listaTurno = array();
        $turno = null;
        try{
            $sql = "SELECT * FROM turno WHERE fechahora between '" . $fechaDesde . "' AND '" . $fechaHasta . "'";
            $result = $datasource->ejecutarQuery($sql);
            while($fila = odbc_fetch_array($result)){
                $idTurno = $fila['idturno'];
                $idFilial = $fila['idfilial'];
                $idCancha = $fila['idcancha'];
                $idSocio = $fila['idsocio'];
                $fechahora = $fila['fechahora'];
                $estado = $fila['estado'];
                $turno = new Turno($idTurno, $idFilial, $idCancha, $idSocio, $fechahora, $estado);

                array_push($listaTurno, $turno);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $listaTurno;
    }


    public function selectTurnosByFilial($idFilial){
        $datasource = new DataSource();
        $listaTurno = array();
        $turno = null;
        try{
            $sql = "SELECT * FROM turno WHERE idfilial= " . $idFilial;
            $result = $datasource->ejecutarQuery($sql);
            while($fila = odbc_fetch_array($result)){
                $idTurno = $fila['idturno'];
                $idFilial = $fila['idfilial'];
                $idCancha = $fila['idcancha'];
                $idSocio = $fila['idsocio'];
                $fechahora = $fila['fechahora'];
                $estado = $fila['estado'];
                $turno = new Turno($idTurno, $idFilial, $idCancha, $idSocio, $fechahora, $estado);

                array_push($listaTurno, $turno);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $listaTurno;
    }

    public function selectTurnosBySocio($idSocio){
        $datasource = new DataSource();
        $listaTurno = array();
        $turno = null;
        try{
            $sql = "SELECT * FROM turno WHERE idSocio= " . $idSocio;
            $result = $datasource->ejecutarQuery($sql);
            while($fila = odbc_fetch_array($result)){
                $idTurno = $fila['idturno'];
                $idFilial = $fila['idfilial'];
                $idCancha = $fila['idcancha'];
                $idSocio = $fila['idsocio'];
                $fechahora = $fila['fechahora'];
                $estado = $fila['estado'];
                $turno = new Turno($idTurno, $idFilial, $idCancha, $idSocio, $fechahora, $estado);

                array_push($listaTurno, $turno);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $listaTurno;
    }

    public function selectTurnosByFilialAndFecha($idFilial, $numcancha, $deporte, $fecha, $horario_apertura, $horario_cierre){
        $datasource = new DataSource();
        $listaTurno = array();
        $turno = null;

        $fechaApertura = $fecha . " " . $horario_apertura;
        $fechaCierre = $fecha . " " . $horario_cierre;
        try{
            $sql = "SELECT * FROM turno t
            JOIN cancha c ON t.idcancha=c.idcancha
            WHERE t.idfilial=".$idFilial." AND (t.fechahora between '" . $fechaApertura . "' AND '" . $fechaCierre . "')
            AND c.deporte='".$deporte."' AND c.num_cancha=".$numcancha;
            $result = $datasource->ejecutarQuery($sql);
            while($fila = odbc_fetch_array($result)){
                $idTurno = $fila['idturno'];
                $idFilial = $fila['idfilial'];
                $idCancha = $fila['idcancha'];
                $idSocio = $fila['idsocio'];
                $fechahora = $fila['fechahora'];
                $estado = $fila['estado'];
                $turno = new Turno($idTurno, $idFilial, $idCancha, $idSocio, $fechahora, $estado);

                array_push($listaTurno, $turno);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $listaTurno;
    }

    public function insertReserva($idfilial, $numcancha, $deporte, $numafiliado, $fechaHora){
        $datasource = new DataSource();
        $resultado = null;
        try{
            $sql = "CALL RESERVAR_CANCHA('".$idfilial."', '".$numcancha."', '".$deporte."', '".$numafiliado."', '".$fechaHora."', @resultado)";
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

    public function updateReserva($idturno, $fechahora){
        $datasource = new DataSource();
        $resultado = null;
        try{
            $sql = "UPDATE turno SET fechahora='" .$fechahora. "' WHERE idturno=" .$idturno;
            $resultado = $datasource->ejecutarQuery($sql);
            $resultado = odbc_num_rows($resultado); //Cantidad de filas afectadas (si es correcto devuelve un 1)
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $resultado;
    }

    public function cancelarReserva($idturno){
        $datasource = new DataSource();
        $resultado = null;
        try{
            $sql = "CALL CANCELAR_CANCHA('".$idturno."', @resultado)";
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


?>
