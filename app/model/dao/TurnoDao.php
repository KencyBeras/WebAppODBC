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
                $turno = new Turno($idTurno, $idFilial, $idCancha, $idSocio, $fechahora);

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
                $turno = new Turno($idTurno, $idFilial, $idCancha, $idSocio, $fechahora);

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

    public function selectTurnosByFilialAndFecha($idFilial, $fecha){
        $datasource = new DataSource();
        $listaTurno = array();
        $turno = null;

        $fechaBefore = $fecha . " 00:00:00";
        $fechaAfter = $fecha . " 23:59:59";

        try{
            $sql = "SELECT * FROM turno WHERE idfilial= " . $idFilial . " AND fechahora between '" . $fechaBefore . "' AND '" . $fechaAfter . "'";
            $result = $datasource->ejecutarQuery($sql);
            while($fila = odbc_fetch_array($result)){
                $idTurno = $fila['idturno'];
                $idFilial = $fila['idfilial'];
                $idCancha = $fila['idcancha'];
                $idSocio = $fila['idsocio'];
                $fechahora = $fila['fechahora'];
                $turno = new Turno($idTurno, $idFilial, $idCancha, $idSocio, $fechahora);

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

}


?>
