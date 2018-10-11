<?php

//$data_source = new DataSource();
//$result = array();
//$result = $data_source->ejecutarQuery("SELECT COUNT(*) AS cantidad FROM cancha");
//echo odbc_result($result, "cantidad"); PARA UNA UNICA FILA RETORNADA
/* PARA MUCHAS FILAS RETORNADAS
if($fila = odbc_fetch_array($result)){ //Itera sobre cada una de las filas
    echo $fila['cantidad'];
}
odbc_close_all();
*/

class CanchaDao {

  public function selectCanchaById($idcancha){
      $datasource = new DataSource();
      $cancha = null;
      try{
          $sql = "SELECT * FROM cancha WHERE idcancha=".$idcancha;
          $result = $datasource->ejecutarQuery($sql);
          if($fila = odbc_fetch_array($result)){
              $idCancha = $fila['idcancha'];
              $idFilial = $fila['idfilial'];
              $numcancha = $fila['num_cancha'];
              $deporte = $fila['deporte'];
              $categoria = $fila['categoria'];
              $cancha = new Cancha($idCancha, $idFilial, $numcancha, $deporte, $categoria);
          }
      }
      catch(Exception $e){
          echo $e->getMessage();
      }
      finally{
          odbc_close_all();
      }
      return $cancha;
  }

  public function selectCanchasByFilialAndDeporte($idfilial, $deporte){
      $datasource = new DataSource();
      $listaCancha = array();
      $cancha = null;
      try{
          $sql = "SELECT * FROM cancha WHERE idfilial=".$idfilial." AND deporte='".$deporte."'";
          $result = $datasource->ejecutarQuery($sql);
          while($fila = odbc_fetch_array($result)){
              $idCancha = $fila['idcancha'];
              $idFilial = $fila['idfilial'];
              $numcancha = $fila['num_cancha'];
              $deporte = $fila['deporte'];
              $categoria = $fila['categoria'];
              $cancha = new Cancha($idCancha, $idFilial, $numcancha, $deporte, $categoria);
              array_push($listaCancha, $cancha);
          }
      }
      catch(Exception $e){
          echo $e->getMessage();
      }
      finally{
          odbc_close_all();
      }
      return $listaCancha;
  }

  public function selectCanchasByFilial($idFilial){
      $datasource = new DataSource();
      $listaCancha = array();
      $cancha = null;
      try{
          $sql = "SELECT * FROM cancha WHERE idfilial= " . $idFilial;
          $result = $datasource->ejecutarQuery($sql);
          while($fila = odbc_fetch_array($result)){
              $idCancha = $fila['idcancha'];
              $idFilial = $fila['idfilial'];
              $numcancha = $fila['num_cancha'];
              $deporte = $fila['deporte'];
              $categoria = $fila['categoria'];
              $cancha = new Cancha($idCancha, $idFilial, $numcancha, $deporte, $categoria);

              array_push($listaCancha, $cancha);
          }
      }
      catch(Exception $e){
          echo $e->getMessage();
      }
      finally{
          odbc_close_all();
      }
      return $listaCancha;
  }

  public function selectDeportes($idFilial){
      $datasource = new DataSource();
      $listaDeportes = array();
      try{
          $sql = "SELECT DISTINCT deporte FROM cancha WHERE idfilial= " . $idFilial;
          $result = $datasource->ejecutarQuery($sql);
          while($fila = odbc_fetch_array($result)){
              $deporte = $fila['deporte'];

              array_push($listaDeportes, $deporte);
          }
      }
      catch(Exception $e){
          echo $e->getMessage();
      }
      finally{
          odbc_close_all();
      }
      return $listaDeportes;
  }

    public function selectCanchas(){
        $datasource = new DataSource();
        $listaCancha = array();
        $cancha = null;
        try{
            $sql = "SELECT * FROM cancha";
            $result = $datasource->ejecutarQuery($sql);
            while($fila = odbc_fetch_array($result)){
                $idCancha = $fila['idcancha'];
                $idFilial = $fila['idfilial'];
                $numcancha = $fila['num_cancha'];
                $deporte = $fila['deporte'];
                $categoria = $fila['categoria'];
                $cancha = new Cancha($idCancha, $idFilial, $numcancha, $deporte, $categoria);

                array_push($listaCancha, $cancha);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
        finally{
            odbc_close_all();
        }
        return $listaCancha;
    }

}


?>
