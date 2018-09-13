<?php

//$data_source = new DataSource();
//$result = array();
//$result = $data_source->ejecutarQuery("SELECT COUNT(*) AS cantidad FROM filial");
//echo odbc_result($result, "cantidad"); PARA UNA UNICA FILA RETORNADA
/* PARA MUCHAS FILAS RETORNADAS
if($fila = odbc_fetch_array($result)){ //Itera sobre cada una de las filas
    echo $fila['cantidad'];
}
odbc_close_all();
*/

class FilialDao {

    public function selectFilial($idFilial){
        $datasource = new DataSource();
        $filial = null;
        try{
            $sql = "SELECT * FROM filial WHERE idFilial=" . $idFilial;
            $result = $datasource->ejecutarQuery($sql);
            if($fila = odbc_fetch_array($result)){
                $idFilial = $fila['idfilial'];
                $localidad = $fila['localidad'];
                $horario_apertura = $fila['horario_apertura'];
                $horario_apertura = substr($horario_apertura, 0, 5);
                $horario_cierre = $fila['horario_cierre'];
                $horario_cierre = substr($horario_cierre, 0, 5);

                $diames_mantenimiento = $fila['diames_mantenimiento'];
                $filial = new Filial($idFilial, $localidad, $horario_apertura, $horario_cierre, $diames_mantenimiento);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $filial;
    }


    /* EL ERROR ESTA ACA >>>>>> */

    public function selectFiliales(){
        $datasource = new DataSource();
        $filial = null;
        try{
            $sql = "SELECT * FROM filial";
            $result = $datasource->ejecutarQuery($sql);

            $filiales = array();

        /* obtener array asociativo */
            while($fila = odbc_fetch_array($result)){
            $idfilial = $fila['idfilial'];
            $localidad = $fila['localidad'];
            $horario_apertura = $fila['horario_apertura'];
            $horario_apertura = substr($horario_apertura, 0, 5);
            $horario_cierre = $fila['horario_cierre'];
            $horario_cierre = substr($horario_cierre, 0, 5);
            $diames_mantenimiento = $fila['diames_mantenimiento'];
            $filial = new Filial($idfilial, $localidad, $horario_apertura, $horario_cierre, $diames_mantenimiento);
            
            array_push($filiales, $filial);
            }

            }
            catch(Exception $e){
                echo $e->getMessage();
            }
            finally{
                odbc_close_all();
            }
            return $filiales;
      }


}



?>
